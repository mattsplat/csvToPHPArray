<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/8/18
 * Time: 1:45 PM
 */
require ('CsvImport.php');


if($argc < 2){
    echo ' No arguments passed'.PHP_EOL; die;
}
// short arguments p: is -p | long arguments ::drivers is --drivers="" | : = required :: = optional
$config = getopt('f:d::', ['output::']);

$delimiter = $config['d'] ?? ',';

$csv = new CsvImport($config['f'], $delimiter);
$export = $csv->convert();

$output = $config['output'] ?? 'export.php';
//$file = fopen($output, 'w');
file_put_contents($output, var_export($export, true));
//fwrite($file, print_r($export, true));
echo 'File '.$output.' written successfully'. PHP_EOL;
//fclose($file);

