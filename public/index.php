<?php

require_once __DIR__ . '/../vendor/autoload.php';

use TaskFlow\Core\Database;
use TaskFlow\Core\LoggerFactory;

$db = Database::getInstance()->getConnection();
$logger = LoggerFactory::create('file');

$logger->log('TaskFlow API started.');
echo "TaskFlow API is running!";


# Example usage of DataExporter with JsonExportStrategy

use TaskFlow\Export\DataExporter;
use TaskFlow\Export\Strategies\CsvExportStrategy;
use TaskFlow\Export\Strategies\JsonExportStrategy;
use TaskFlow\Export\Strategies\XmlExportStrategy;

// Beispielnutzung
$data = [
  ['id' => 1, 'title' => 'Get the Milk!', 'status' => 'open'],
  ['id' => 2, 'title' => 'Walk the Dog', 'status' => 'done']
];


$json_exporter = new DataExporter(new JsonExportStrategy());
$csv_exporter = new DataExporter(new CsvExportStrategy());
$xml_exporter = new DataExporter(new XmlExportStrategy());

?>

<pre>
<?php
echo $csv_exporter->export($data);
echo "\n";
echo $json_exporter->export($data);
echo "\n";
?>
</pre>
<textarea rows="15" cols="80">
<?php
echo $xml_exporter->export($data);
?>
</textarea>