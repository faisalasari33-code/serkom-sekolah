<?php

namespace App\Http\Controllers;  

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // 
    public function index()
    {
        $users = User::all();
        return view('admin.pengelola.index',compact('users'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'username' => 'required|string|max:255',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,operator',
        ]);

        user::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role'=> $request->role,
        ]);

        return redirect()->route('admin.index')->with('success', 'user berhasil di tambahkan!');  
        
    }

    public function edit($id) 
    {
        $data['user'] = User::find($id);
        if($data['user']){
            return view('admin.pengelola.edit', $data);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|min:8',
            'username' => 'required|string|max:255|unique:user,username,' .$id. ',id_user',
            'role' => 'required|in:admin,operator',
            'password' => 'nullable|min:6',
        ]);

        $user = User::find($id);
        if(!empty($request->password)){
            $password = bcrypt($request->password);
        }else{
            $password = $user->password;
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $password,
            'role' => $request->role
        ]);

        return redirect()->route('admin.index')->with('success', 'Data user berhasil di edit');
    }

    public function create()
    {
        return view('admin.pengelola.create');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);  
        if($user){
            $user->delete();
        }

        return redirect()->route('admin.index')->with('success', 'Data users berhasil di hapus');
    }
}
