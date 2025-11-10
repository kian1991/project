<?php

namespace TaskFlow\Command;

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
  }
}
