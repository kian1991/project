<?php

namespace TaskFlow\Observer;

use TaskFlow\Observer\EventType;

interface Observer {
  public function update(EventType $event, mixed $data): void;
}
