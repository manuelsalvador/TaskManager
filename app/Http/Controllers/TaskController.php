<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\Priority;
use App\Models\State;

class TaskController extends Controller
{
public function __construct(){
    //$this->middleware('auth')->except('index', 'show', 'create', 'store');
}
public function PM() {

    return Role::where('role', "Project Manager")->pluck('id')[0];
}

public function DEV() {

    return Role::where('role', "Developer")->pluck('id')[0];
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == $this->PM()){
            $tasks = Task::get();
            return view('tasks.index', compact('tasks'));
        }else{
            $tasks = Task::where('developer_id', Auth::user()->id)->get();
            return view('tasks.index', compact('tasks'));
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

            $projects = Project::pluck('title', 'id');
            $developers = User::where('role',$this->DEV())->pluck('name', 'id');
            $states = State::pluck('state','id');
            $priorities = Priority::pluck('priority','id');

            return view('tasks.create', compact('projects', 'developers', 'states', 'priorities'));

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
                $post = new Task;
                $post->title = $request->input('title');
                $post->description = $request->input('description');
                $post->priority = $request->input('priority');
                $post->developer_id = $request->input('developer_id');
                $post->project_id = $request->input('project_id');
                $post->state = $request->input('state');
                $post->save();

                if($post){
                    return redirect('tasks');
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
        $task = Task::findOrFail($id);
        $project = Project::where('id', $task->project_id)->get();//->pluck('title');
        $developer = User::where('id',$task->developer_id)->get();//->pluck('name');
        $priority = Priority::where('id', $task->priority)->get();//pluck('priority');
        $state = State::where('id', $task->state)->get();//->pluck('state');

        if(Auth::user()->role == $this->PM() || Auth::user()->id == $task->developer_id){
            return view('tasks.show', compact('task','project','developer', 'priority','state'));
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
            $task = Task::findOrFail($id);

            $projectSelected = Project::where('id', $task->project_id)->get();
            $project = Project::get();

            $developerSelected = User::where('id',$task->developer_id)->get();
            $developer = User::where('role',$this->DEV())->get();
            
            $prioritySelected = Priority::where('id', $task->priority)->get();
            $priority = Priority::get();
            
            $stateSelected = State::where('id', $task->state)->get();
            $state = State::get();

            if(Auth::user()->role == $this->PM() || Auth::user()->id == $task->developer_id){
                return view('tasks.edit', compact('task','project','developer', 'priority','state', 
                                              'prioritySelected', 'stateSelected', 'developerSelected', 'projectSelected'));
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
        $post = Task::findOrFail($id);
        if(auth::user()->role == $this->PM()){
            
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->priority = $request->input('priority');
            $post->developer_id = $request->input('developer_id');
            $post->project_id = $request->input('project_id');
            $post->state = $request->input('state');
            $post->save();

            if($post){
                return redirect('tasks');
            }else{
                return redirect('dashboard');
            }
        }else{
            $post->state = $request->input('state');
            $post->save();
            if($post){
                return redirect('tasks');
            }else{
                return redirect('dashboard');
            }
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
