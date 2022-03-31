<?php

namespace Test\Logic;


use Interview\Logic\LogicChallenge;
use PHPUnit\Framework\TestCase;

class LogicChallengeTest extends TestCase
{

    public function testAppendCheckDigit()
    {
        $randomChallenge = new LogicChallenge();

        $this->assertEquals("042100005264", $randomChallenge->appendCheckDigit("4210000526"));
        $this->assertEquals("036000291452", $randomChallenge->appendCheckDigit("3600029145"));
        $this->assertEquals("123456789104", $randomChallenge->appendCheckDigit("12345678910"));
        $this->assertEquals("000012345670", $randomChallenge->appendCheckDigit("1234567"));
    }

}