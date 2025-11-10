<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TaskFlow\Core\Database;
use TaskFlow\Core\LoggerFactory;
use TaskFlow\Observer\EventManager;
use TaskFlow\Observer\EventType;
use TaskFlow\Observer\LogObserver;
use TaskFlow\Observer\NotificationObserver;
use TaskFlow\Command\CommandInvoker;
use TaskFlow\Command\create_task_command;
use TaskFlow\Command\CreateTaskCommand;
use TaskFlow\Command\DeleteTaskCommand;

$db = Database::getInstance()->getConnection();
$logger = LoggerFactory::create('file');

$logger->log('TaskFlow API started.');
echo "TaskFlow API is running!\n\n";

# observers Beispiel
$event_manager = new EventManager();
$log_observer = new LogObserver($logger);
$notification_observer = new NotificationObserver();

# Attach
$event_manager->attach($log_observer);
$event_manager->attach($notification_observer);

# Beispielnutzung der Commands

$invoker = new CommandInvoker();

$create_task_command = new CreateTaskCommand(
  'Walk the Dog!',
  'The Dog always needs a walk in the evening. Thats not negotiable. 🐕',
  $event_manager
);

$deleteTaskCommand = new DeleteTaskCommand(1); # assuming task with ID 1 exists

$invoker->addCommand($create_task_command);
$invoker->addCommand($deleteTaskCommand);
$invoker->run();
