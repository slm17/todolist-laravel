<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
   public function testTodolist()
   {
       $this->withSession([
           "user" => "slm",
           "todolist" => [
               "id" => "1",
               "todo" => "slm"
           ]
       ])->get('/todolist')
           ->assertSeeText("1")
           ->assertSeeText("slm");
   }

   public function testAddTodoFailed()
   {
       $this->withSession([
           "user" => "slm"
       ])->post("/todolist", [])
           ->assertSeeText("Todo is required");
   }

   public function testAddTodoSucces()
   {
       $this->withSession([
           "user" => "slm"
       ])->post("/todolist", [
           "todo" => "slm"
       ])->assertRedirect("/todolist");
   }
}
