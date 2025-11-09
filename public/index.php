<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TaskFlow\Core\Database;
use TaskFlow\Core\LoggerFactory;
use TaskFlow\Observer\EventManager;
use TaskFlow\Observer\EventType;
use TaskFlow\Observer\LogObserver;
use TaskFlow\Observer\NotificationObserver;

$db = Database::getInstance()->getConnection();
$logger = LoggerFactory::create('file');

$logger->log('TaskFlow API started.');
echo "TaskFlow API is running!\n\n";

# observers beispiel
$event_manager = new EventManager();
$log_observer = new LogObserver($logger);
$notification_observer = new NotificationObserver();

# Attach
$event_manager->attach($log_observer);
$event_manager->attach($notification_observer);

# Let's fire an Event! 
$event_manager->notify(EventType::TASK_CREATED, [
  'id' => 124532,
  'status' => 'open'
]);
