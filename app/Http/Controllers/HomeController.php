<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Textbook;
use Stripe\Stripe;
use Stripe\Charge;

class HomeController extends Controller
{
    public function index()
    {
        //$user = \Auth::user();
        // 管理者でログインしていなければマイページへ
        if (\Auth::id() !== 1) {
            return view('home/index');
        } else {
            return redirect(route('textbooks.index'))->with('flash_message', '無効なURLです');
        }
    }
    public function admin()
    {
        // 管理者でなければ教科書一覧に飛ばす
        if (\Auth::id() === 1) {
            return view('home/admin');
        } else {
            return redirect(route('textbooks.index'))->with('flash_message', '無効なURLです');
        }
    }
    public function register_history()
    {
        // 管理者でログインしていなければ登録履歴へ
        if (\Auth::id() !== 1) {
            $textbooks = Textbook::where('seller_id', \Auth::id())->orderBy('created_at', 'desc')->paginate(20);
            return view('textbooks/register_history', ['textbooks' => $textbooks]);
        } else {
            return redirect(route('textbooks.index'))->with('flash_message', '無効なURLです');
        }
    }
    public function purchase($id)
    {
        $textbook = \App\Textbook::find($id);
        // 売り手idとログインユーザが異なり、かつ管理者でログインせず、かつ売れていなければ購入
        if (\Auth::id()!==$textbook->seller_id && \Auth::id()!==1 && !$textbook->purchased_at) {
            Stripe::setApiKey(env('STRIPE_SECRET'));//シークレットキー
            $charge = Charge::create(array(
                'amount' => $textbook->price,
                'currency' => 'jpy',
                'source'=> request()->stripeToken,
            ));
            $textbook->buyer_id = \Auth::id();
            $textbook->purchased_at = date('Y-m-d H:i:s');
            $textbook->save();
            return redirect(route('textbooks.show', $textbook->id));
        } else {
            return redirect(route('textbooks.show', $textbook->id))->with('flash_message', '無効なURLです');
        }
    }
    public function purchase_history()
    {
        // 管理者でログインしていなければ購入履歴へ
        if (\Auth::id() !== 1) {
            $textbooks = Textbook::where('buyer_id', \Auth::id())->orderBy('created_at', 'desc')->paginate(20);
            return view('textbooks/purchase_history', ['textbooks' => $textbooks]);
        } else {
            return redirect(route('textbooks.index'))->with('flash_message', '無効なURLです');
        }
    }
}
