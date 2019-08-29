<?php

namespace App;
use \Filebase\Database;
use Tightenco\Collect\Support\Collection;

class QuestionTest {

    private $database;
    private $tableName = "respondent_testing";

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
        $this->table = $this->database->get($this->tableName);
    }

    public function create($test = [] )
    {

        $this->test = array_intersect_key($test, $this->filterStructure);

        $this->table->tests[uniqid()] = $this->test;
        $this->table->save();

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
        $items = $this->database->get($this->tableName)->toArray();
        $collect = new Collection($items);
        $output = ["questions" => null];
        
        $result = $collect->map(function($item) use($type) {
            return collect($item)->filter(function($value, $id) use($type) {
               return $value['type'] === $type;
            });
        })->toArray();
       
        $isset = isset($result['tests']) && !empty($result['tests']) ? $result['tests'] : [];

        $output['questions'] = $isset;
        return $this->orderItteration($output);

    }

    private function orderItteration($collection)
    {
        if(isset($collection['questions'])) {
            $res = [];
            foreach($collection['questions'] as $key => $value) {
                $res[] = $value;                
            }
            return $res;
        }
    }

}