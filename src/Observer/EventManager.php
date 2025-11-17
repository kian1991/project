<?php

namespace TaskFlow\Observer;

use TaskFlow\Observer\Subject;


class EventManager implements Subject {
  private array $observers = [];
  private static ?EventManager $instance = null;

  public static function getInstance(): EventManager {
    if (self::$instance === null) {
      self::$instance = new EventManager();
    }
    return self::$instance;
  }

  public function attach(Observer $observer): void {
    $this->observers[] = $observer;
  }

  public function detach(Observer $observer): void {
    $this->observers = array_filter($this->observers, fn($el) => $el !== $observer);
  }

  public function notify(EventType $event_type, mixed $data): void {
    foreach ($this->observers as $observer) {
      $observer->update($event_type, $data);
    }
  }
}
