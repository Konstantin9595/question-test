<?php

use PHPUnit\Framework\TestCase;
use App\QuestionTest;

final class QuestionTestTest extends TestCase
{
    public function testAction(): void
    {
        $database = new \Filebase\Database(['dir' => dirname(__DIR__) . "/database"]);

        $addTest = ["question" => "Вопрос", "answears" => [1 => "first", 2 => "second"]];
        $test = new QuestionTest();
        
        $this->assertIsArray($test->create($addTest));
        //$this->assertEquals($test->create($addTest), $addTest);
    }
    
}