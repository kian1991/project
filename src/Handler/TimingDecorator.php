<?php

namespace TaskFlow\Handler;

use TaskFlow\Core\Logger;

class TimingDecorator implements Handler {

  public function __construct(private Handler $handler, private Logger $logger) {
  }

  public function handle(array $request): array {
    // Vor dem gewrappten Handler
    $start = microtime(true);
    $response = $this->handler->handle($request);
    // Nach dem gewrappeten Handler
    $end = microtime(true);
    $duration = ($end - $start) * 1000; // in ms
    $this->logger->log("Request processed in " . number_format($duration, 2) . " ms");
    return $response;
  }
}
