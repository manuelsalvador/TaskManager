<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Customer;
use App\Models\Role;

class ProjectController extends Controller
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
        if(Auth::user()->role == $this->PM()){
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
    public function store(Request $request)
    {
        if(Auth::user()->role == $this->PM()){
            $post = new Project;
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->customer_id = $request->input('customer_id');
            $post->save();

            if($post){
                return redirect('projects');
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
        if(Auth::user()->role == $this->PM()){
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
    public function update(Request $request, $id)
    {
        if(auth::user()->role == $this->PM()){
            $post = Project::findOrFail($id);
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->customer_id = $request->input('customer_id');
            $post->save();

            if($post){
                return redirect('projects');
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
