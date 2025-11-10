<?php

namespace TaskFlow\Command;

use TaskFlow\Core\Database;
use TaskFlow\Core\LoggerFactory;
use TaskFlow\Observer\EventManager;
use TaskFlow\Observer\EventType;



class DeleteTaskCommand implements Command {
  public function __construct(private int $taskId) {
  }

  public function execute(): void {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$this->taskId]);

    $logger = LoggerFactory::create('file');
    $logger->log("Task deleted: {$this->taskId}");

    $eventManager = new EventManager();
    $eventManager->notify(EventType::TASK_DELETED, [
      'id' => $this->taskId
    ]);
  }
}
