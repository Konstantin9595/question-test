<?php

use PHPUnit\Framework\TestCase;
use App\QuestionTest;
use App\strategies\CookAlgorithm;
use App\strategies\SocialGroupAlgorithm;
use App\ProcessingTest;
use App\User;

final class ProcessingTestTest extends TestCase
{

    public function testGetState(): void
    {
        $addTest = ["type" => "cook", "question" => "Как вы относитесь к еде?", "answears" => [1 => "Очень люблю вкусно поесть", 2 => "Отношусь спокойно.", 3 => "Я - дизайнер блюд в ресторане." ],"weight" => [1 => 100, 2 => 50, 3 => 100]];
        $questionTest = new QuestionTest();
        $questionTest->create($addTest);

        $cookTest = $questionTest->get("cook");
        //print_r($cookTest);
        $processing = new ProcessingTest(new User, $cookTest, [CookAlgorithm::class, SocialGroupAlgorithm::class] );
        $this->assertEquals("Как вы относитесь к еде?", $processing->getCurrentQuestion());


    }
    
}