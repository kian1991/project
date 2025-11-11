<?php

namespace TaskFlow\Handler;

use TaskFlow\Core\Logger;

class LoggingDecorator implements Handler {

  public function __construct(private Handler $handler, private Logger $logger) {
  }

  public function handle(array $request): array {
    // Vor dem gewrappten Handler
    $this->logger->log("Incoming Request: " . $request['method'] . " " .  $request['action']);
    $response = $this->handler->handle($request);
    // Nach dem gewrappeten Handler
    $this->logger->log("Response Status: " . $response['status']);

    return $response;
  }
}
