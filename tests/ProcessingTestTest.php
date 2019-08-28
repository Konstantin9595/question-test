<?php

use PHPUnit\Framework\TestCase;
use App\QuestionTest;
use App\strategies\CookAlgorithm;
use App\strategies\SocialGroupAlgorithm;
use App\ProcessingTest;


final class ProcessingTestTest extends TestCase
{
    public function testGetState(): void
    {
        $questionTest = new QuestionTest();
        $cookTest = $questionTest->get("cook");

        $processing = new ProcessingTest(new User(["type" => "guest"]), $cookTest, [CookAlgorithm::class, SocialGroupAlgorithm::class] );
        $this->assertEquals(["userType" => "guest", "weightAnswears" => [], "results" => []], $processing->getState());

        $processing->run();
        $this->assertNotEmpty($processing->getState()->getResults());

    }
    
}