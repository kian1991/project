<?php

namespace TaskFlow\Command;

# Command Interface
interface Command {
  public function execute(): void;
}
