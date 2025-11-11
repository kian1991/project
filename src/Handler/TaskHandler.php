<?php

namespace TaskFlow\Handler;

use TaskFlow\Command\CommandInvoker;
use TaskFlow\Command\CreateTaskCommand;
use TaskFlow\Command\DeleteTaskCommand;
use TaskFlow\Observer\EventManager;
use TaskFlow\Core\Database;

class TaskHandler implements Handler {
    public function __construct(
        private EventManager $eventManager,
        private CommandInvoker $invoker
    ) {
    }

    public function handle(array $request): array {
        $action = $request['action'] ?? 'list';
        $data = $request['data'] ?? [];

        return match ($action) {
            'create' => $this->createTask($data),
            'list' => $this->listTasks(),
            'delete' => $this->deleteTask($data),

            default => [
                'success' => false,
                'error' => 'Unknown action',
                'status' => 400
            ]
        };
    }

    private function createTask(array $data): array {
        // Nutze Command Pattern aus vorherigem Kapitel!
        $command = new CreateTaskCommand(
            $data['title'] ?? '',
            $data['description'] ?? '',
            $this->eventManager
        );

        $this->invoker->addCommand($command);
        $this->invoker->run();

        return [
            'success' => true,
            'message' => 'Task created successfully',
            'status' => 201
        ];
    }

    private function listTasks(): array {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query('SELECT id, title, description, created_at FROM tasks');
        $tasks = $stmt->fetchAll();

        return [
            'success' => true,
            'data' => $tasks,
            'status' => 200
        ];
    }

    private function deleteTask(array $data): array {
        $command = new DeleteTaskCommand(
            $data['id'] ?? 0,
            $this->eventManager
        );

        $this->invoker->addCommand($command);
        $this->invoker->run();

        return [
            'success' => true,
            'message' => 'Task deleted successfully',
            'status' => 200
        ];
    }
}
