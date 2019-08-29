<?php

use PHPUnit\Framework\TestCase;
use App\QuestionTest;

final class QuestionTestTest extends TestCase
{
    public function testCreate(): void
    {
        $database = new \Filebase\Database(['dir' => dirname(__DIR__) . "/database"]);

        $addTest =  [
            "type" => "cook",
            "question" => "Любите ли вы выпекать пироги?", 
            "answears" => [
                1 => "Люблю", 
                2 => "Думаю только об этом, не могу спать.", 
                3 => "Нет" 
            ],
            "weight" => [1 => 50, 2 => 100, 3 => 0]
        ];

        $questionTest = new QuestionTest();
        $this->assertIsArray($questionTest->create($addTest));

    }

    public function testGet()
    {
        $addTest = ["type" => "cook", "question" => "Как вы относитесь к еде?", "answears" => [1 => "Очень люблю вкусно поесть", 2 => "Отношусь спокойно.", 3 => "Я - дизайнер блюд в ресторане." ],"weight" => [1 => 100, 2 => 50, 3 => 100]];
        $questionTest = new QuestionTest();
        $questionTest->create($addTest);

        $cookTest = $questionTest->get("cook");
        $this->assertIsArray($cookTest);
    }
    
}