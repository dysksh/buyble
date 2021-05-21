<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; //追加

class UserController extends Controller
{
    // 会員管理
    public function index() {
        $users = User::where('id', '<>', 1)->orderBy('created_at', 'desc')->paginate(20);;
        return view('user.index', ['users' => $users]);
    }

    //userデータの編集
    public function edit() {
        $user = Auth::user();
        return view('user.edit', ['user' => $user]);
    }

    //userデータの保存
    public function update(Request $request) {
        $user_form = $request->all();
        $user = Auth::user();
        //不要な「_token」の削除
        unset($user_form['_token']);
        //保存
        $user->fill($user_form)->save();
        //リダイレクト
        return redirect(route('users.edit', $user));
    }

}
