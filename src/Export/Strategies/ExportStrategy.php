<?php

namespace TaskFlow\Export\Strategies;

interface ExportStrategy {
  public function export(array $data): string;
}
