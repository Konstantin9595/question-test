<?php
namespace App;
use App\User;

class ProcessingTest
{
    private $userName;
    private $testInformation = [
        "testType" => null,
        "listQuestions" => null,
        "listAnswears" => null,
        "weightAnswears" => null,
    ];

    private $state = [
        "testCompleted" => false,
        "getCurrentNumberQuestionStep" => 0,
        "questionCount" => null,
        "userAnswears" => null
    ];

    private $listAlgorithms;

    public function __construct(User $user, $test = [], $algorihms = []){
        $this->userName = $user->getUsername() ?? "guest";
        $this->testInformation["listQuestions"] = $this->questionFilter($test);
        $this->testInformation["listAnswears"] = $this->answeaerFilter($test);
        $this->testInformation["weightAnswears"] = $this->weightFilter($test);
        $this->state["questionCount"] = count($this->testInformation["listQuestions"]);
        $this->listAlgorithms = $algorihms;
    }

    private function setCompletedTest(){
        if(!$this->isComleted() && getQuestionCount() === 0) {
            $this->state["testCompleted"] = true;
        }
        
    }
    public function run(){}
    public function getState(){}

    public function nextQuestionStep()
    {
        if($this->isComleted()) {
            $this->setCompletedTest();
            
            return false;
        }

        $this->setIncrementCount();
    }

    public function setUserAnswear($userAnswear)
    {
        $this->state["userAnswears"][] = $userAnswear; 
    }

    public function prevQuestionStep() 
    {
        if($this->isComleted()) {
            $this->setCompletedTest();

            return false;
        }

        $this->setDecrementCount();
    }

    public function isComleted()
    {
        $this->state["testCompleted"];
    }

    public function getQuestionCount()
    {
        return $this->state["questionCount"];
    }

    public function getCurrentQuestion()
    {
        return $this->getQuestion($this->getCurrentNumberQuestionStep());
    }

    public function getQuestion($number)
    {
        return $this->testInformation["listQuestions"][$number]['question'];
    }

    private function getCurrentNumberQuestionStep()
    {
        return  $this->state["getCurrentNumberQuestionStep"];
    }

    private function setIncrementCount()
    {
        $this->state["questionCount"] = $this->getQuestionCount() + 1;
    }

    private function setDecrementCount()
    {
        $this->state["questionCount"] = $this->getQuestionCount() - 1;
    }

    public function getResult()
    {
        // применить к ответам пользователя писок алгоритмов
        // return CookAlgoritm($userAnswears = [], $weightAnswears = [])->checkTest()->getResult();
        $result = collect($this->listAlgorithms)->map(function($algorithm){
            return $algorithm($this->state['userAnswears'], $this->testInformation['weightAnswears']);
        });

        return $result->toArray();
    }

    private function answeaerFilter($tests)
    {
        if(isset($tests)) {
            $answears = collect($tests)->filter(function($item, $key){
                return $item["answears"];
            });

            return $answears->toArray();
        }
    }

    private function weightFilter($tests)
    {
        if(isset($tests)) {
            $answears = collect($tests)->filter(function($item, $key){
                return $item["weight"];
            });
            
            return $answears->toArray();
        }
    }

    private function questionFilter($tests)
    {
        if(isset($tests)) {
            $question = collect($tests)->filter(function($item, $key) {
                return $item["question"];
            });
            return $question->toArray();
        }
    }
}

// $test = [
//     "questions" => [
//         "0" => [
//             "type" => "cook",
//             "question" => "Умеете ли вы варить суп ?",
//             "answears" => [1 => "Нет", 2 => "Да", 3 => "Наверное"],
//             "weight" => [1 => 0, 2 => 100, 3 => 50]
//         ],
//         "1" => [
//             "type" => "cook",
//             "question" => "Умеете ли вы варить суп ?",
//             "answears" => [1 => "Нет", 2 => "Да", 3 => "Наверное"],
//             "weight" => [1 => 0, 2 => 100, 3 => 50]
//         ]
//     ]
// ];
