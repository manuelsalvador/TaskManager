<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function PM() {

        return Role::where('role', "Project Manager")->pluck('id')[0];
    }

    public function __construct(){
        //$this->middleware('auth')->except('index', 'show', 'create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == $this->PM()){
            $users = User::get();
            return view('users.index', compact('users'));
        }else{
            return view('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == $this->PM()){
            $roles = Role::get();
            return view('users.create', compact('roles'));
        }else{
            return redirect('dashboard');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role == $this->PM()){
            $post = new User;
            $post->name = $request->input('name');
            $post->email = $request->input('email');
            $post->password = Hash::make($request->input('password'));
            $post->role = $request->input('role_id');
            $post->save();

            if($post){
                return redirect('users');
            }else{
                return redirect('dashboard');
            }
        }else{
            return redirect('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role == $this->PM()){
            $user = User::findOrFail($id);
            $role = Role::where('id', $user->role)->get();
            return view('users.show', compact('user', 'role'));
        }else{
            return redirect('dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role == $this->PM()){
            $user = User::findOrFail($id);
        $roleSelected = Role::where('id', $user->role)->get();
        $role = Role::get();

        return view('users.edit', compact('user', 'roleSelected','role'));
        }else{
            return redirect('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->role == $this->PM()){

            $post = User::findOrFail($id);
            $post->name = $request->input('name');
            $post->email = $request->input('email');
            $post->password = Hash::make($request->input('password'));
            $post->role = $request->input('role_id');
            $post->save();

            if($post){
                 return redirect('users');
            }else{
                return redirect('dashboard');
            }

        }else{
            return redirect('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
