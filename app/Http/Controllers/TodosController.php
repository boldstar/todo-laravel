<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Imports\TodoImport;
use Maatwebsite\Excel\Facades\Excel;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todo::where('user_id', auth()->user()->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'todo' => 'required|string',
            'complete' => 'required|boolean'
        ]);

        $todo = Todo::create([
            'user_id' => auth()->user()->id,
            'todo' => $request->todo,
            'complete' => $request->complete
        ]);

        return response($todo, 200);
    }

    public function importExcel(Request $request) 
    {

        if (empty($request->file('file')->getRealPath())) {
            return back()->with('success','No file selected');
        }
        else {
        Excel::import(new TodoImport, $request->file('file'));
   
        return response('Import Succesful, Please Refresh Page');
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'user_id'=> 'required|integer',
            'todo' => 'required|string',
            'complete' => 'required|boolean'
        ]);

        $todo->update([
            'user_id' => $request->user_id,
            'todo' => $request->todo,
            'complete' => $request->complete
        ]);

        return response($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response('Todo Is Deleted', 200);
    }
}
