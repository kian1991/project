<?php

namespace TaskFlow\Command;

use TaskFlow\Core\Database;
use TaskFlow\Core\LoggerFactory;
use TaskFlow\Observer\EventManager;
use TaskFlow\Observer\EventType;

class CreateTaskCommand implements Command {
  public function __construct(
    private string $title,
    private string $description = ''
  ) {
  }

  public function execute(): void {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
    $stmt->execute([$this->title, $this->description]);

    $logger = LoggerFactory::create('file');
    $logger->log("Task created: {$this->title}");

    $eventManager = new EventManager();
    $eventManager->notify(EventType::TASK_CREATED, [
      'title' => $this->title
    ]);
  }
}
