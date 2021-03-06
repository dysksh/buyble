<?php

namespace App\Http\Controllers;

use App\Textbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class TextbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = \App\Textbook::select('id', 'title', 'author', 'classification_id', 'price', 'isbn_no', 'seller_id', 'purchased_at', 'file_name', 'file_path');
        if ($request->isbn_no) {
            $query->where('isbn_no', '=', $request->isbn_no);
        }
        if ($request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }
        if ($request->title) {
            $query->where('title', 'LIKE', '%'.$request->title.'%');
        }
        if ($request->author) {
            $query->where('author', 'LIKE', '%'.$request->author.'%');
        }
        if ($request->classification_id || $request->classification_id==='0') {
            $query->where('classification_id', $request->classification_id);
        }
        $textbooks = $query->orderBy('created_at', 'desc')->paginate(15);
        $classifications = \App\Classification::all();
        return view('textbooks/index' , ['textbooks' => $textbooks, 'classifications' => $classifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $textbook = new TextBook;
        $this->authorize($textbook);
        $this->validate($request, [
            'keyword' => 'nullable|size:10'
        ]);
        $classifications = \App\Classification::all();
        $conditions = \App\Condition::all();
        $data = [];

        $items = null;

        if (!empty($request->keyword) && mb_strlen($request->keyword) ===10)
        {
            // 検索キーワードあり

            // 日本語で検索するためにURLエンコードする
            $isbn = urlencode($request->keyword);

            // APIを発行するURLを生成
            // $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $title . '&country=JP&tbm=bks';
            $url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;
            $client = new Client();

            // GETでリクエスト実行
            $response = $client->request("GET", $url);

            $body = $response->getBody();

            // レスポンスのJSON形式を連想配列に変換
            $bodyArray = json_decode($body, true);

            // 書籍情報部分を取得
            if (!empty($bodyArray['items'])) {
                $items = $bodyArray['items'];
            }

            // レスポンスの中身を見る
            //dd($items);
        }

        // $data = [
        //     'items' => $items,
        //     'keyword' => $request->keyword,
        // ];
        return view('textbooks/create', ['textbook' => $textbook, 'classifications' => $classifications, 'conditions' => $conditions, 'items' => $items, 'keyword' => $request->keyword]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
		// 	'image' => 'required|file|image|mimes:png,jpeg'
		// ]);

        $this->validate($request, [
            'isbn_no' => 'required|size:10',
            'title' => 'required|max:50',
            'author' => 'required|max:50',
            'classification_id' => 'required|numeric|max:11|min:1',
            'condition_id' => 'required|numeric|max:3|min:1',
            'price' => 'required|numeric|min:50|max:9999999999',
            'file_name' => 'nullable',
            'file_path'=> 'nullable'
        ]);

        $textbook = new Textbook;

        if ($file = $request->file('image')) {
            // $fileName = time() . $file->getClientOriginalName();
            // $target_path = public_path('uploads/');
            // $file->move($target_path, $fileName);
            $fileName = Storage::disk('s3')->putFile('/', $file, 'public');
            $target_path = "https://".env('AWS_BUCKET').".s3-ap-northeast-1.amazonaws.com/";
        } elseif ($file = $request->google_image) {
            $fileName = $request->google_image;
            $target_path = "";
        } else {
            $fileName = "";
            $target_path = "";
        }

        $textbook->isbn_no = $request->isbn_no;
        $textbook->title = $request->title;
        $textbook->author = $request->author;
        $textbook->classification_id = $request->classification_id;
        $textbook->condition_id = $request->condition_id;
        $textbook->seller_id = $request->user()->id;
        $textbook->price = $request->price;
        if ($fileName) {
            $textbook->file_name = $fileName;
        }
        if ($target_path) {
            $textbook->file_path = $target_path;
        }
        $textbook->save();

        // $textbook = $request->user()->registered()->create($request->all());
        $this->authorize($textbook);
        return redirect(route('textbooks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function show(Textbook $textbook)
    {
        return view('textbooks.show', ['textbook' => $textbook]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Textbook $textbook)
    {
        $this->authorize($textbook);
        $classifications = \App\Classification::all();
        $conditions = \App\Condition::all();
        return view('textbooks.edit', ['textbook' => $textbook,'classifications' => $classifications, 'conditions' => $conditions ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Textbook $textbook)
    {
        $this->authorize($textbook);
        $this->validate($request, [
            'isbn_no' => 'required|size:10',
            'title' => 'required|max:50',
            'author' => 'required|max:50',
            'classification_id' => 'required|numeric|max:11|min:1',
            'condition_id' => 'required|numeric|max:3|min:1',
            'price' => 'required|numeric|min:50|max:9999999999',
            'file_name' => 'nullable',
            'file_path'=> 'nullable'
        ]);
        if ($file = $request->file('image')) {
            // \File::delete($textbook->file_path . $textbook->file_name);
            // $fileName = time() . $file->getClientOriginalName();
            // $target_path = public_path('uploads/');
            // $file->move($target_path, $fileName);

            $file_name = $textbook->file_name;
            $s3_delete = Storage::disk('s3')->delete($file_name);

            $fileName = Storage::disk('s3')->putFile('/', $file, 'public');
            $target_path = "https://".env('AWS_BUCKET').".s3-ap-northeast-1.amazonaws.com/";
        } else {
            $fileName = "";
        }

        $textbook->isbn_no = $request->isbn_no;
        $textbook->title = $request->title;
        $textbook->author = $request->author;
        $textbook->classification_id = $request->classification_id;
        $textbook->condition_id = $request->condition_id;
        $textbook->seller_id = $request->user()->id;
        $textbook->price = $request->price;
        if ($fileName && $target_path) {
            $textbook->file_name = $fileName;
            $textbook->file_path = $target_path;
        }
        $textbook->save();
        // $textbook->update($request->all());
        return redirect(route('textbooks.show', $textbook->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Textbook  $textbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Textbook $textbook)
    {
        $this->authorize($textbook);
        $file_name = $textbook->file_name;
        $s3_delete = Storage::disk('s3')->delete($file_name);
        $textbook->delete();
        return redirect(route('textbooks.index'));
    }
}
