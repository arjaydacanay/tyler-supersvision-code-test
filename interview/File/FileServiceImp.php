<?php
namespace Interview\File;

class FileServiceImp
{

    public $dataFile=[];

    public  function __construct() {
        $this->readFile();
    }

      /**
     * Read file and set the $dataFile variable.
     *
     * @return void
     */
    public function readFile() : void{
        $arr=[];
        $newArray=[];
        if ($file = fopen("./interview/File/animals.txt", "r")) {
            while(!feof($file)) {
                $textperline = fgets($file);
                $pieces = explode(",", $textperline );
               array_push($arr,$pieces);
             }
             fclose($file);
             $header=[];
             foreach ($arr as $k => $v) {
                if($k==0){
                    $header = array_map(function ($data) {return trim($data);},$v);
                }else{
                   array_push($newArray,array_combine($header,$v));
                }
            }
        }
        $newArray= array_map(function ($data) {
            $speed = strpos($data['SPEED'], 'km')? round(floatval($data['SPEED']),3):round(floatval($data['SPEED'])*1.609,3);
            $data['SPEED']= $speed;$data['VOTES']=intval($data['VOTES']);
            return $data;
          },$newArray);
          $this->dataFile = $newArray;
    }
  

}

