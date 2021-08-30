<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Role;

class CustomerController extends Controller
{

    public function __construct(){
        //$this->middleware('auth')->except('index', 'show', 'create', 'store');
    }
    
    public function PM() {
        return Role::where('role', "Project Manager")->pluck('id')[0];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == $this->PM()){
            $customers = Customer::get();
            return view('customers.index', compact('customers'));
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
            return view('customers.create');
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
            $post = new Customer;
            $post->name = $request->input('name');
            $post->surname = $request->input('surname');
            $post->address = $request->input('address');
            $post->phone = $request->input('phone');
            $post->email = $request->input('email');
            $post->save();

            if($post){
                return redirect('customers');
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
            $customer = Customer::findOrFail($id);
            return view('customers.show', compact('customer'));
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
            $customer = Customer::findOrFail($id);
            return view('customers.edit', compact('customer'));
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
            $post = Customer::findOrFail($id);
            $post->name = $request->input('name');
            $post->surname = $request->input('surname');
            $post->address = $request->input('address');
            $post->phone = $request->input('phone');
            $post->email = $request->input('email');
            $post->save();

            if($post){
                return redirect('customers');
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
