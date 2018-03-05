<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/8/18
 * Time: 1:36 PM
 */

class CsvImport
{
    protected $filename;
    protected $csv_array;
    protected $delimiter;
    protected $type;

    public function __construct($filename, $type = 'array', $delimiter = ',')
    {
        $this->filename = $filename;
        $this->type = $type;
        $this->delimiter = $delimiter;

    }

    public function convert(){

        if(!file_exists($this->filename) || !is_readable($this->filename))
            return FALSE;

        $header = NULL;
        $data = array();
        if (($handle = fopen($this->filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                {
                    //foreach($row as $item)
                    $data[] = array_combine($header, $row);
                }

            }
            fclose($handle);
        }
        $this->csv_array = $data;
        return $this->csv_array;
    }

}