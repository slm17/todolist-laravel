<?php

namespace App\Http\Controllers;

use App\services\TodolistService;
use http\Env\Response;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoList(Request $request){
        $todolist = $this->todolistService->getTodolist();
        return response()->view("todolist.todolist", [
            "title" => "todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request){
        $todo = $request->input("todo");

        if (empty($todo)){
            $todolist = $this->todolistService->getTodolist();
            return response()->view("todolist.todolist", [
                "title" => "todolist",
                "todolist" => $todolist,
                "error" => "Todo is required"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class, 'todoList']);
    }

    public function removeTodo(Request $request, string $todoId){

    }
}
