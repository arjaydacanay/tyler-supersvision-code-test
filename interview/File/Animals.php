<?php

namespace Interview\File;

use SebastianBergmann\Environment\Console;

class Animals
{

    /** @var $fileService */
    private $fileService;
    /**
     * @param array $array
     * 
     * 
     */
    public function __construct()
    {
      $this->fileService=new FileServiceImp();
    }
    /**
     * Returns the name of the fastest animal from the animals.txt in this directory
     *
     * @return string
     */
    public function getFastestAnimalName()
    {


         $max = max(array_column( $this->fileService->dataFile, 'SPEED'));
         $keys = array_filter(array_map(function ($data) use ($max) {
                   return $data['SPEED'] == $max ? $data : null;
                 },   $this->fileService->dataFile)); 
     
        return array_values($keys)[0]['ANIMAL'];
    }

    /**
     * Get the slowest animals speed in km/h
     *
     * We're OK with heuristics, we can multiply MPH by 1.609 to get km/h
     *
     * @return float
     */
    public function getSlowestAnimalSpeed()
    {  
        $min = min(array_column( $this->fileService->dataFile, 'SPEED'));
        $keys = array_filter(array_map(function ($data) use ($min) {
                  return $data['SPEED'] == $min ? $data : null;
                },   $this->fileService->dataFile)); 
    
       return array_values($keys)[0]['SPEED'];
    }

    /**
     * Produces an array where each key is the animal name, and each value is the number of votes
     *
     * @return array
     */
    public function getVotesByAnimal()
    { 
        $header=[];
        $votes=[];
        foreach( $this->fileService->dataFile as $k =>$val){
           array_push($header,$val['ANIMAL']);
           array_push($votes,$val['VOTES']);
        }
        return array_combine($header,$votes);
    }

}