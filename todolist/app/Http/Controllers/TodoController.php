<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::paginate(5);
        return view('welcome', ['todos' => $todos]);
    }
     public function store(Request $request)
     {
        $validated = $request->validate([
            'task' => 'required'
        ]);

        $todo = Todo::create($validated);
        return back()->with('text', 'A new Task has been created.');
     }
     public function show()
     {
        $todos = Todo::paginate(5);
        return view('welcome', ['todos' => $todos]);
     }
     public function edit()
     {
        return view('edit');
     }
     public function deleteMultiple(Request $request)
     {
        $result = Todo::destroy($request->ids);
        if($result)
        {
            return back()->with('text', 'Items Deleted Successfully.');
        }else{
            return back()->with('text', 'Items Not Found.');
        }
        // $result = Todo::destroy([$request->ids]);
        // if($result)
        // {
        //     return back()->with('text', 'Items Deleted Successfully.');
        // }else{
        //     return "Items Not Found !";
        // }
     }
     public function search(Request $request)
     {
        // Todo::where('name', 'like', '%' ,$request->search ,'%')->get();
        $todos = Todo::where('task', 'like', "%$request->search%")->get();
        return view('welcome', ['todos' => $todos, 'search' => $request->search]);
     }
}
