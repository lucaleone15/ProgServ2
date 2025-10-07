<?php

namespace Tasks;

interface TasksManagerInterface {
    public function getTasks(): array;
    public function addTask(Task $task): int;
    public function removeTask(int $id): bool;
    public function getTaskById(int $id): ?Task;
    public function updateTask(int $id, Task $task): bool;
}