<?php

namespace Tasks;

interface TasksManagerInterface {
    public function getTasks(): array;
    public function addTask(Task $task): int;
    public function removeTask(int $id): bool;
}