<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskApi;
use App\Helper\Enumeration\Status;
use App\Http\Requests\StoreTaskApiRequest;
use App\Http\Requests\UpdateTaskApiRequest;

class TaskApiController extends Controller
{

  ///////////////////////////////////////////////////////////////////////////////
  // PUBLIC FUNCTION

  //*****************************************************************************

  public function markDone($id)
  {
    TaskApi::where('id', $id)
      ->update([
        'status' => Status::Done->value,
        'done_at' => now()
      ]);

    $another = TaskApi::where('status', Status::Unfinished->value)
      ->exists();

    return response()->json(['another' => $another], 200);

  }

  //*****************************************************************************

  public function next()
  {
    $task = TaskApi::where('status', Status::Unfinished->value)
      ->orderBy('created_at')
      ->first();
    
    if ($task == null)
    {
      return response()->json(['exists' => false], 200);

    }

    return response()->json([
      'exists' => true,
      'id' => $task->id,
      'body' => substr($task->body, 0, 255)
    ], 200);
  }

  ///////////////////////////////////////////////////////////////////////////////

  // PUBLIC RESTFUL

  public function index()
  {
    //
  }

  //*****************************************************************************
  
  public function create()
  {
    $tasks = TaskApi::all()
      ->sortBy('created_at');

    foreach ($tasks as &$task)
    {
      if (Status::from($task->status) == Status::Unfinished)
      {
        $task->tailwindColor = "bg-orange-600 text-black";
      }
      else
      {
        $task->tailwindColor = "bg-green-600 text-black";
      }
    }

    return view('taskapi.create', [
      'statusOptions' => Status::cases(),
      'tasks' => $tasks
    ]);
  }
  
  public function store(StoreTaskApiRequest $request)
  {
    // Form Request Validation :: validated() : array of validated data
    $data = $request->validated();

    if (TaskApi::create($data))
    {
      return back()->with('success', __("New Task added."));
    }

  }
  
  public function show(TaskApi $taskApi)
  {
    //
  }
  
  public function edit(TaskApi $taskApi)
  {
    //
  }
  
  public function update(UpdateTaskApiRequest $request, TaskApi $taskApi)
  {
    //
  }
  
  public function destroy(TaskApi $taskApi)
  {
    //
  }
}
