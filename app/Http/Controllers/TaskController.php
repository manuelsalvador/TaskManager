<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\StoreTaskRequest;

use App\Models\Role;
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == Role::PM()){
            $tasks = Task::get();
        }else{
            $tasks = Task::where('user_id', Auth::user()->id)->get();
        }
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Project::get()->count() < 1){
            return redirect()->back()->with('error', 'You can not insert Tasks without existing Projects!');
        }

        if(Auth::user()->role == Role::PM()){        

            $projects = Project::pluck('title', 'id');
            $developers = User::where('role',Role::DEV())->pluck('name', 'id');
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
    public function store(StoreTaskRequest $request)
    {
        if(Auth::user()->role == Role::PM()){

            $validated = $request->validated();

            if($validated){
                Task::create($validated);
                return redirect('tasks');
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
        $task = Task::findOrFail($id);
        $project = Project::findOrFail($task->project_id);
        $developer = User::where('id', $task->user_id)->get();
        $priority = Priority::findOrFail( $task->priority);
        $state = State::findOrFail($task->state);

        if(Auth::user()->role == Role::PM() || Auth::user()->id == $task->user_id){

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
        $project = Project::get();
        $developer = User::where('role',Role::DEV())->get();
        $priority = Priority::get();
        $state = State::get();

        $projectSelected = Project::where('id',$task->project_id)->get();
        $developerSelected = User::where('id',$task->user_id)->get();
        $prioritySelected = Priority::where('id',$task->priority)->get();

        if(Auth::user()->role == Role::PM() || Auth::user()->id == $task->user_id){
            return view('tasks.edit', compact('task','project','developer', 'priority','state', 'developerSelected', 'prioritySelected', 'projectSelected'));
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
    public function update(StoreTaskRequest $request, $id)
    {
        $post = Task::findOrFail($id);
        $post->fill($request->validated());
        $isSaved = $post->save();

        if($isSaved){
            return redirect('tasks');
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
        Task::where('id', $id)->delete();
        return redirect('tasks');
    }
}
