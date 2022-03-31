<?php

namespace Test\File;


use Interview\File\Animals;
use PHPUnit\Framework\TestCase;

class AnimalsTest extends TestCase
{

    public function testGetFastestAnimalName()
    {
        $animals = new Animals();

        $this->assertEquals('Peregrin Falcon', $animals->getFastestAnimalName());
    }

    public function testGetSlowestAnimalSpeed()
    {
        $animals = new Animals();

        $this->assertEquals(152.855, $animals->getSlowestAnimalSpeed());
    }

    public function testGetVotesByAnimal()
    {
        $animals = new Animals();
        $votesArray = $animals->getVotesByAnimal();

        $this->assertInternalType("array", $votesArray);

        $this->assertArrayHasKey("Golden Eagle", $votesArray);
        $this->assertArrayHasKey("Frigatebird", $votesArray);
        $this->assertArrayHasKey("Eurasian hobby", $votesArray);
        $this->assertArrayHasKey("White-throated needletail", $votesArray);
        $this->assertArrayHasKey("Peregrin Falcon", $votesArray);
        $this->assertArrayHasKey("Mexican free-tailed bat", $votesArray);

        $this->assertEquals(20, $votesArray["Golden Eagle"]);
        $this->assertEquals(6, $votesArray["Frigatebird"]);
        $this->assertEquals(18, $votesArray["Eurasian hobby"]);
        $this->assertEquals(16, $votesArray["White-throated needletail"]);
        $this->assertEquals(12, $votesArray["Peregrin Falcon"]);
        $this->assertEquals(37, $votesArray["Mexican free-tailed bat"]);
    }

}