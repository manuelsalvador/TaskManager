<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Role;
use App\Http\Requests\StoreProjectRequest;


class ProjectController extends Controller
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
            $projects = Project::get();
            return view('projects.index', compact('projects'));
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
        if(Customer::get()->count() < 1){
            return redirect()->back()->with('error', 'You can not insert Projects without existing Customers!');
        }

        if(Auth::user()->role == Role::PM()){
            $customers = Customer::get();
            return view('projects.create', compact('customers'));
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
    public function store(StoreProjectRequest $request)
    {
        if(Auth::user()->role == Role::PM()){

            $validated = $request->validated();

            if($validated){
                Project::create($validated);
                return redirect('projects');
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
            $project = Project::findOrFail($id);
            $customer = Customer::where('id', $project->customer_id)->get();
            return view('projects.show', compact('project','customer'));
        }else{
            return view('dashboard');
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
            $project = Project::findOrFail($id);

            $customerSelected = Customer::where('id', $project->customer_id)->get();
            $customer = Customer::get();

            return view('projects.edit', compact('project','customerSelected','customer'));
        }else{
            return view('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProjectRequest $request, $id)
    {
        if(Auth::user()->role == Role::PM()){
            $post = Project::findOrFail($id);
            $post->fill($request->validated());
            $isSaved = $post->save();

            if($isSaved){
                return redirect('projects');
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
        Project::where('id', $id)->delete();
        return redirect('projects');
    }
}
