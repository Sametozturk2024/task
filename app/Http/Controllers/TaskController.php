<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskList;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function admin ()
    {


     $tasks =   TaskList::with('user')
     ->orderBy('created_at', 'desc')
         ->get();


        $users = Auth::user()->get();

        return view('backend.admin', compact('tasks' , 'users') );

    }



    public function index()
    {


        $tasks = TaskList::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('status');

        return view('backend.index', [
            'active_tasks' => $tasks['active'] ?? [],
            'pending_tasks' => $tasks['pending'] ?? [],
            'completed_tasks' => $tasks['completed'] ?? []
        ]);


        /*

         * */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function updateStatus(Request $request)
    {
        $task = TaskList::findOrFail($request->task_id);

        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->status = $request->status;
        $task->save();

        return response()->json(['success' => true]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'user_id' => 'nullable|max:1000'
        ]);

        $task = new TaskList();
        $task->name = $validatedData['name'];
        $task->description = $validatedData['description'] ?? '';
        $task->status = 'active';
        $task->user_id = $request->user_id ? $request->user_id : Auth::id() ; ;
        $task->save();

        return redirect()->back()->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = TaskList::findOrFail($id);

        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        return response()->json($task);
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
        $task = TaskList::findOrFail($id);

        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000'
        ]);

        $task->name = $validatedData['name'];
        $task->description = $validatedData['description'] ?? '';
        $task->save();

        return response()->json(['success' => true, 'task' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = TaskList::findOrFail($id);

        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json(['success' => true]);
    }
}
