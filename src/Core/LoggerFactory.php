<?php

namespace TaskFlow\Core;

interface Logger
{
  public function log(string $message): void;
}

// Helper function to format log messages with timestamp
function formatLogMessage(string $message): string
{
  return sprintf('[%s] %s', date('Y-m-d H:i:s'), $message);
}

class FileLogger implements Logger
{
  public function log(string $message): void
  {
    file_put_contents(__DIR__ . '/../../logs/app.log', formatLogMessage($message) . PHP_EOL, FILE_APPEND);
  }
}

class ConsoleLogger implements Logger
{
  public function log(string $message): void
  {
    echo formatLogMessage($message) . PHP_EOL;
  }
}

class LoggerFactory
{
  public static function create(string $type): Logger
  {
    return match ($type) {
      'file' => new FileLogger(),
      'console' => new ConsoleLogger(),
      default => throw new \InvalidArgumentException('Unknown logger type'),
    };
  }
}
