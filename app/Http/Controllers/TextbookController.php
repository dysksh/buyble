<?php

namespace App\Http\Controllers;

use App\Textbook;
use Illuminate\Http\Request;

class TextbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = \App\Textbook::select('id', 'title', 'author', 'classification_id', 'price', 'isbn_no', 'seller_id');
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
        $textbooks = $query->paginate(20);
        $classifications = \App\Classification::all();
        return view('textbooks/index' , ['textbooks' => $textbooks, 'classifications' => $classifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $textbook = new TextBook;
        $classifications = \App\Classification::all();
        $conditions = \App\Condition::all();
        return view('textbooks/create', ['textbook' => $textbook, 'classifications' => $classifications, 'conditions' => $conditions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $textbook = $request->user()->registered()->create($request->all());
        return redirect(route('home'));
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
        //$textbook = \App\Textbook::find($request->id);
        return view('textbooks.edit', ['textbook' => $textbook]);
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
        $textbook->update($request->all());
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
        $textbook->delete();
        return redirect(route('textbooks.index'));
    }
}
