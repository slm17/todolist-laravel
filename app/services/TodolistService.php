<?php

namespace App\services;

interface TodolistService
{
    public function saveTodo(string $id, string $todo): void;

    public function getTodolist(): array;

}
