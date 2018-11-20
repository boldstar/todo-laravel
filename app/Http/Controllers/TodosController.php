<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todo::all();
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
            'user_id'=> 'required|integer',
            'todo' => 'required|string',
            'complete' => 'required|boolean'
        ]);

        $todo = Todo::create([
            'user_id' => $request->user_id,
            'todo' => $request->todo,
            'complete' => $request->complete
        ]);

        return response($todo, 200);
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
    public function destroy($id)
    {
        //
    }
}
