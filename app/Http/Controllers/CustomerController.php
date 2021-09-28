<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\StoreCustomerRequest;


class CustomerController extends Controller
{

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
        if(Auth::user()->role == Role::PM()){
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
        if(Auth::user()->role == Role::PM()){
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
    public function store(StoreCustomerRequest $request)
    {
        if(Auth::user()->role == Role::PM()){
            
            $validated = $request->validated();

            if($validated){
                Customer::create($validated);
                return redirect('customers');
            }
        }

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->role == Role::PM()){
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
        if(Auth::user()->role == Role::PM()){
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
    public function update(StoreCustomerRequest $request, $id)
    {
        if(Auth::user()->role == Role::PM()){

            $post = Customer::findOrFail($id);
            $post->fill($request->validated());
            $isSaved = $post->save();

            if($isSaved){
                return redirect('customers');
            }

        }

        return redirect('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::where('id', $id)->delete();
        return redirect('customers');
    }
}
