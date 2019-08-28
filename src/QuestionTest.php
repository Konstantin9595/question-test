<?php

namespace App;
use \Filebase\Database;
use Tightenco\Collect\Support\Collection;

class QuestionTest {

    private $database;
    private $dbName = "respondent_testing";

    private $filterStructure = [
        "type" => "",
        "question" => [],
        "answears" => [],
        "weight" => []
    ];

    private $test;

    public function __construct()
    {
        $this->database = new \Filebase\Database(['dir' => dirname(__DIR__) . "/database"]);
    }

    public function create($test = [] )
    {

        $this->test = array_intersect_key($test, $this->filterStructure);

        $items = $this->database->get($this->dbName);
        $items->tests[uniqid()] = $this->test;
        $items->save();

        return $this->database->query()->results();
    }

    public function update($test = [])
    {
        //$this->test = array_intersect_key($test, $this->filterStructure);

        // get uid

        // find element by uid

        // update element by uid

        // save and return new database state
    }

    public function delete($id){

    }

    public function get($type = '') 
    {
        $items = $this->database->get($this->dbName)->toArray();
        $collect = new Collection($items);

        $result = $collect->map(function($item) use($type) {
            return collect($item)->filter(function($value, $id) use($type) {
               return $value['type'] === $type;
            });
        })->toArray();

        $output = isset($result['tests']) && !empty($result['tests']) ? $result['tests'] : null;

        return $output;
    }

}