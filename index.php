<?php

require_once __DIR__.'/vendor/autoload.php';

if (isset($_FILES['file'])) {
    try {
        $file = $_FILES['file'];
        $fileContent = file_get_contents($file['tmp_name']);

        $instanceValue = json_decode($fileContent);
        $schema = new \Swaggest\JsonSchema\Schema();
        $f = new \Swaggest\JsonSchemaMaker\SchemaMaker($schema);
        $f->options->heuristicRequired = true;
        $f->addInstanceValue($instanceValue);

        $schemaJson = json_encode(\Swaggest\JsonSchema\Schema::export($schema));
        $schemaJsonInline = json_encode($schema);

        header('Content-Type: application/json; charset=utf-8');

        echo $schemaJsonInline;
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
}
?>