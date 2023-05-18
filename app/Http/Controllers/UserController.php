<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Tracking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::query()->withCount('tracking');
        if ($request->has('user')){
            if ($request->get('user') == 'manager')
                $users = $users->where('type', $request->get('user'));
            if ($request->get('user') == 'user')
                $users = $users->where('type', $request->get('user'));
        }

        $users = $users->get();

        return view('admin.users.index', compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(UserStoreRequest $request){
        User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'manager_location' => $request->get('manager_location'),
            'password' => Hash::make($request->get('password')),
            'type' => 'manager',
        ]);

        return redirect()->route('admin.users')->with('success', 'Менеджер добавлен!');
    }

    public function delete($user_id){
        $user = User::query()->find($user_id);
        if (!$user)
            return redirect()->route('admin.users')->with('error', 'Пользователь не найден!');

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Пользователь удален!');

    }
}
