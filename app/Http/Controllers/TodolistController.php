<?php

namespace App\Http\Controllers;

use App\Services\Impl\TodolistServiceImpl;
use App\Services\TodolistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistServiceImpl $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todolist()
    {
        $todolist = $this->todolistService->getTodolist();

        return response()->view("todolist.todolist", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }
}
