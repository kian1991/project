<?php

namespace TaskFlow\Handler;

use TaskFlow\Command\CommandInvoker;
use TaskFlow\Command\CreateTaskCommand;
use TaskFlow\Command\DeleteTaskCommand;
use TaskFlow\Observer\EventManager;
use TaskFlow\Core\Database;

class TaskHandler implements Handler
{
    public function __construct(
        private EventManager $eventManager,
        private CommandInvoker $invoker
    ) {}

    public function handle(array $request): array
    {
        $action = $request['action'] ?? 'list';
        $data = $request['data'] ?? [];

        return match($action) {
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

    private function createTask(array $data): array
    {
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

    private function listTasks(): array
    {
        // TODO: Implementiere diese Methode
        
        return [
            'success' => false,
            'error' => 'Not implemented yet',
            'status' => 501
        ];
    }

    private function deleteTask(array $data): array
    {
        // TODO: Implementiere diese Methode
        
        return [
            'success' => false,
            'error' => 'Not implemented yet',
            'status' => 501
        ];
    }
}
