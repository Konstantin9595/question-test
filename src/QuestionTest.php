<?php

namespace App;
use \Filebase\Database;

class QuestionTest {

    private $filterStructure = [
        "question" => [],
        "answears" => []
    ];

    private $test;

    public function create($test = [] )
    {
        $database = new \Filebase\Database(['dir' => dirname(__DIR__) . "/database"]);

        $this->test = array_intersect_key($test, $this->filterStructure);

        $items = $database->get("respondent_testing");
        $items->tests[uniqid()] = $this->test;
        $items->save();

        return $database->query()->results();
    }
}