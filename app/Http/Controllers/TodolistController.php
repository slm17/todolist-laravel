<?php

namespace App\Http\Controllers;

use App\services\TodolistService;
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

    }

    public function removeTodo(Request $request, string $todoId){

    }
}
