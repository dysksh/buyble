<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; //追加

class UserController extends Controller
{
    // 会員管理
    public function index(Request $request) {
        // 管理者でなければ教科書一覧に飛ばす
        if (Auth::id() === 1) {
            $query = \App\User::select('id', 'name', 'email');
            if ($request->id) {
                $query->where('id', '=', $request->id);
            }
            if ($request->name) {
                $query->where('name', 'LIKE', '%'.$request->name.'%');
            }
            if ($request->email) {
                $query->where('email', 'LIKE', '%'.$request->email.'%');
            }
            $users = $query->where('id', '<>', 1)->paginate(20);
            return view('user.index' , ['users' => $users]);
        } else {
            return redirect(route('textbooks.index'));
        }
    }

    //userデータの編集
    public function edit() {
        $user = Auth::user();
        // 管理者でなければ会員登録情報変更に飛ばす
        if (Auth::id() !== 1) {
            return view('user.edit', ['user' => $user]);
        } else {
            return redirect(route('users.show', $user));
        }
    }

    //admin用userデータの編集
    public function adedit($id) {
        $user = User::find($id);
        // 管理者でログインし、かつ管理者のidでなければ編集に飛ばす
        if (Auth::id() === 1 && $user->id !== 1) {
            return view('user.edit', ['user' => $user]);
        } else {
            return redirect(route('users.show', $user));
        }
    }

    //userデータの保存
    public function update(Request $request) {
        $user_form = $request->all();
        // 管理者でログインしていなければ更新
        if (Auth::id() !== 1) {
            $this->validate($request, [
                'name' => 'required|max:20',
                'postal' => 'required|digits:7',
                'address' => 'required|max:150',
                'phone' => 'required|digits_between:10, 15',
                'email' => 'required|email|max:50'
            ]);
            $user = Auth::user();
            //不要な「_token」の削除
            unset($user_form['_token']);
            //保存
            $user->fill($user_form)->save();
        }
        return redirect(route('users.edit', $user));
    }

    //admin用userデータの保存
    public function adupdate(Request $request) {
        $user = User::find($request->id);
        // 管理者でログインし、対象が管理者以外の場合、更新
        if (Auth::id() === 1 && $user->id !== 1) {
            $this->validate($request, [
                'name' => 'required|max:20',
                'postal' => 'required|digits:7',
                'address' => 'required|max:150',
                'phone' => 'required|digits_between:10, 15',
                'email' => 'required|email|max:50'
            ]);
            $user_form = $request->all();
            //不要な「_token」の削除
            unset($user_form['_token']);
            //保存
            $user->fill($user_form)->save();
        }
        return redirect(route('users.show', $user));
    }

    public function delete(User $user)
    {
        // 管理者でログインしていなければ削除画面に行く
        if (Auth::id() !== 1) {
            $user = Auth::user();
            return view('user.delete', ['user' => $user]);
        } else {
            return redirect(route('home'));
        }
    }

    public function destroy(User $user)
    {
        // 管理者でログインしていなければ削除
        if (Auth::id() !== 1) {
            $user = Auth::user();
            Auth::logout();
            $user->delete();

            return view('auth.login');
        } else {
            return redirect(route('home'));
        }
    }

    public function show($id)
    {
        // 管理者でなければ教科書一覧に飛ばす
        if (Auth::id() === 1) {
            $user = User::find($id);
            return view('user.show', ['user'=>$user]);
        } else {
            return redirect(route('textbooks.index'));
        }
    }

    public function admindestroy($id)
    {
        // 管理者でログインし、かつ対象が管理者以外の場合、削除
        $user = User::find($id);
        if (Auth::id() === 1 && $user->id !== 1) {
            $user->delete();

            return redirect(route('users.index'));
        } else {
            return redirect(route('users.show', $user));
        }
    }
}
