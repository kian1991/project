<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TaskFlow\Handler\TaskHandler;
use TaskFlow\Handler\LoggingDecorator;
use TaskFlow\Handler\TimingDecorator;
use TaskFlow\Handler\ErrorHandlingDecorator;
use TaskFlow\Core\LoggerFactory;
use TaskFlow\Observer\EventManager;
use TaskFlow\Observer\LogObserver;
use TaskFlow\Observer\NotificationObserver;
use TaskFlow\Command\CommandInvoker;

// ZENTRALE DEPENDENCIES erstellen (nur EINMAL!)
$logger = LoggerFactory::create('file');
$eventManager = new EventManager();
$eventManager->attach(new LogObserver($logger));
$eventManager->attach(new NotificationObserver());
$invoker = new CommandInvoker();

// Basis-Handler erstellen
$handler = new TaskHandler($eventManager, $invoker);

// Decorator-Stack aufbauen (von innen nach außen!)
$handler = new LoggingDecorator($handler, $logger);
$handler = new TimingDecorator($handler, $logger);
$handler = new ErrorHandlingDecorator($handler);

// Request bauen
$request = [
    'action' => $_GET['action'] ?? 'list',
    'data' => json_decode(file_get_contents('php://input'), true) ?? $_POST,
    'method' => $_SERVER['REQUEST_METHOD']
];

// Request durch den Decorator-Stack schicken
$response = $handler->handle($request);

// JSON Response ausgeben
header('Content-Type: application/json');
http_response_code($response['status'] ?? 200);
echo json_encode($response, JSON_PRETTY_PRINT);
