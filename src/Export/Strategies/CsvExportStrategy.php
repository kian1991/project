<?php

namespace TaskFlow\Export\Strategies;


class CsvExportStrategy implements ExportStrategy {
  public function export(array $data): string {
    $output = fopen('php://temp', 'r+');
    $this->writeCsvLine($output, array_keys($data[0]));
    foreach ($data as $row) {
      $this->writeCsvLine($output, $row);
    }
    rewind($output); // rewind because fputcsv advanced the pointer to the end. We want to read from the beginning
    return stream_get_contents($output);
  }

  private function writeCsvLine($handle, array $fields): void {
    fputcsv($handle, $fields, ',', '"', '\\');
  }
}
