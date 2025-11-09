<?php

namespace TaskFlow\Observer;

enum EventType: string {
  case TASK_CREATED = 'task_created';
  case TASK_UPDATED = 'task_updated';
  case TASK_DELETED = 'task_deleted';
  case USER_REGISTERED = 'user_registered';
}


interface Subject {
  public function notify(EventType $event, mixed $data): void;
  public function detach(Observer $observer): void;
  public function attach(Observer $observer): void;
}
