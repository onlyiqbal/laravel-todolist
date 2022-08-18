<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "iqbal",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "ngopi"
                ],
                [
                    "id" => "2",
                    "todo" => "belajar"
                ]
            ]
        ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("ngopi")
            ->assertSeeText("2")
            ->assertSeeText("belajar");
    }

    public function testAddTodotFaild()
    {
        $this->withSession([
            "user" => "iqbal"
        ])->post("/todolist")
            ->assertSeeText("Todo tidak boleh kosong");
    }

    public function testAddTodo()
    {
        $this->withSession([
            "user" => "iqbal"
        ])->post("/todolist", [
            "todo" => "belajar"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodo()
    {
        $this->withSession(
            [
                "user" => "iqbal",
                "todolist" => [
                    [
                        "id" => "1",
                        "todo" => "ngopi"
                    ],
                    [
                        "id" => "2",
                        "todo" => "belajar"
                    ]
                ]
            ]
        )->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
