<?php

namespace TaskFlow\Command;

use TaskFlow\Observer\EventManager;

# Command Invoker
class CommandInvoker {
  private array $commands = [];

  public function addCommand(Command $command): void {
    $this->commands[] = $command;
  }

  public function run(): void {
    foreach ($this->commands as $command) {
      $command->execute();
    }
    $this->commands = []; // Clear commands after execution
  }
}
