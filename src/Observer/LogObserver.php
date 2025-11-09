<?php

namespace TaskFlow\Observer;

use TaskFlow\Core\Logger;

class LogObserver implements Observer {
  private Logger $logger;

  public function __construct(Logger $logger) {
    $this->logger = $logger;
  }
  public function update(EventType $event, mixed $data): void {
    $this->logger->log("($event->value)" . json_encode($data));
  }
}
