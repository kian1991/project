<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TaskFlow\Core\Database;
use TaskFlow\Core\LoggerFactory;

$db = Database::getInstance()->getConnection();
$logger = LoggerFactory::create('file');

$logger->log('TaskFlow API started.');
echo "TaskFlow API is running!";
