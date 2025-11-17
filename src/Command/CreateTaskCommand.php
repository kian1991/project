<?php

namespace TaskFlow\Command;

use TaskFlow\Core\Database;
use TaskFlow\Observer\EventManager;
use TaskFlow\Observer\EventType;

class CreateTaskCommand implements Command {
  public function __construct(
    private string $title,
    private string $description = '',
  ) {
  }

  public function execute(): void {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
    $stmt->execute([$this->title, $this->description]);

    $eventManager = EventManager::getInstance();
    if ($eventManager) {
      $eventManager->notify(EventType::TASK_CREATED, [
        'title' => $this->title
      ]);
    }
  }
}
