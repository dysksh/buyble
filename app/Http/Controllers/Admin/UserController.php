<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; //追加

class UserController extends Controller
{
    //下記を追加

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

    public function delete(User $user)
    {
        $user = Auth::user();
        return view('user.delete', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return view('auth.login');
    }
}
