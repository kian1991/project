<?php

namespace TaskFlow\Handler;


class ErrorHandlingDecorator implements Handler {

  public function __construct(private Handler $handler) {
  }

  public function handle(array $request): array {
    try {
      $response = $this->handler->handle($request);
    } catch (\Throwable $th) {
      return [
        'message' => $th->getMessage(), // In Produktionssystem würden wir das nicht so machen!
        'status' => 500,
        'error' => 'Internal Server Error'
      ];
    }

    return $response;
  }
}
