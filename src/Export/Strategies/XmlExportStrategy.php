<?php

namespace TaskFlow\Export\Strategies;

class XmlExportStrategy implements ExportStrategy {
  public function export(array $data): string {
    $xml = new \SimpleXMLElement('<data />');
    foreach ($data as $item) {
      $child = $xml->addChild('item');
      foreach ($item as $key => $value) {
        $child->addChild($key, htmlspecialchars((string)$value));
      }
    }
    return $xml->asXML();
  }
}
