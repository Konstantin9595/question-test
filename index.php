<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\QuestionTest;

$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));

$database = new \Filebase\Database([
    'dir' => __DIR__ . "/database"
]);

$item = $database->get("respondent_testing");

$item->tests = [ uniqid() => [
    "question" => "Любите ли вы выпекать пироги?", 
    "answears" => [
        1 => "Люблю", 
        2 => "Думаю только об этом, не могу спать.", 
        3 => "Нет" 
    ],
    "weight" => [1 => 50, 2 => 100, 3 => 0]
]];

$item->save();
print_r($database->findAll());
session_start();

// $test = new QuestionTest();

// $test->action();
