<?php

namespace TaskFlow\Command;

use TaskFlow\Core\Database;
use TaskFlow\Observer\EventManager;
use TaskFlow\Observer\EventType;

class DeleteTaskCommand implements Command {
  public function __construct(private int $taskId, private ?EventManager $eventManager = null) {
  }

  public function execute(): void {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$this->taskId]);

    if ($this->eventManager) {
      $this->eventManager->notify(EventType::TASK_DELETED, [
        'taskId' => $this->taskId
      ]);
    }
  }
}
