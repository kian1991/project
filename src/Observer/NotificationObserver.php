<?php

namespace TaskFlow\Observer;

class NotificationObserver implements Observer {
  public function update(EventType $event, mixed $data): void {
    echo "[$event->value]" . json_encode($data);
  }
}
