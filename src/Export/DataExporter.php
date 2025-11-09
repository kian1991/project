<?php

namespace TaskFlow\Export;

use TaskFlow\Export\Strategies\ExportStrategy;

class DataExporter {
  private ExportStrategy $strategy;


  public function __construct(ExportStrategy $strategy) {
    $this->strategy = $strategy;
  }


  public function setStrategy(ExportStrategy $strategy): void {
    $this->strategy = $strategy;
  }


  public function export(array $data): string {
    return $this->strategy->export($data);
  }
}
