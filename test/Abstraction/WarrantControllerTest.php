<?php

namespace Test\Abstraction;

use Faker\Factory;
use Interview\Abstraction\Response;
use Interview\Abstraction\WarrantController;
use PHPUnit\Framework\TestCase;

class WarrantControllerTest extends TestCase
{

    public function testCreateWarrant()
    {
        $payload = $this->makeBasePayload();
        $warrantRequest = new WarrantRequest('POST', json_encode($payload));
        $warrantController = new WarrantController();

        $response = $warrantController->createWarrant($warrantRequest);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());

        $body = $response->getBody();

        $this->assertInternalType("string", $body);

        $bodyArray = json_decode($body, true);

        $this->assertInternalType("array", $bodyArray);
        $this->assertArrayHasKey("success", $bodyArray);
        $this->assertArrayHasKey("message", $bodyArray);
        $this->assertArrayHasKey("issuedBy", $bodyArray);

        $testMessage = "Warrant created for " . $payload["Event"]["Individual"]["LastName"] . ", " . $payload["Event"]["Individual"]["FirstName"];
        $testIssuedBy = $payload["Event"]["Judge"]["LastName"] . ", " . $payload["Event"]["Judge"]["FirstName"];

        $this->assertTrue($bodyArray["success"]);
        $this->assertEquals($testMessage, $bodyArray["message"]);
        $this->assertEquals($testIssuedBy, $bodyArray["issuedBy"]);
    }

    public function testMissingIndividualId()
    {
        $payload = $this->makeBasePayload();
        unset($payload["Event"]["Individual"]["IndividualId"]);

        $warrantRequest = new WarrantRequest('POST', json_encode($payload));
        $warrantController = new WarrantController();

        $response = $warrantController->createWarrant($warrantRequest);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testMissingJudgeId()
    {
        $payload = $this->makeBasePayload();
        $payload["Event"]["Judge"]["JudgeId"] = null;

        $warrantRequest = new WarrantRequest('POST', json_encode($payload));
        $warrantController = new WarrantController();

        $response = $warrantController->createWarrant($warrantRequest);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testMissingOffenses()
    {
        $payload = $this->makeBasePayload();
        $payload["Event"]["Offenses"] = [];

        $warrantRequest = new WarrantRequest('POST', json_encode($payload));
        $warrantController = new WarrantController();

        $response = $warrantController->createWarrant($warrantRequest);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testWrongMethod()
    {
        $payload = $this->makeBasePayload();

        $warrantRequest = new WarrantRequest('PUT', json_encode($payload));
        $warrantController = new WarrantController();

        $response = $warrantController->createWarrant($warrantRequest);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(405, $response->getStatusCode());
    }

    protected function makeBasePayload()
    {
        $faker = Factory::create();
        $offenses = [];
        $numOffenses = mt_rand(1, 4);

        for ($i = 0; $i < $numOffenses; $i++) {
            $offenses[] = [
                "Code" => $faker->numerify("PC-###"),
            ];
        }

        return [
            "Event" => [
                "EventType" => "Warrant",
                "Individual" => [
                    "IndividualId" => $faker->numberBetween(1, 100000000),
                    "FirstName" => $faker->firstName,
                    "LastName" => $faker->lastName,
                ],
                "Judge" => [
                    "JudgeId" => $faker->numberBetween(1, 100000000),
                    "FirstName" => $faker->firstName,
                    "LastName" => $faker->lastName,
                ],
                "Court" => [
                    "Address" => $faker->address,
                ],
                "Offenses" => $offenses,
            ],
        ];
    }

}