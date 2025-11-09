<?php

namespace TaskFlow\Export\Strategies;

class JsonExportStrategy implements ExportStrategy {
  public function export(array $data): string {
    return json_encode($data, JSON_PRETTY_PRINT);
  }
}
