<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\QuestionTest;

$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));

session_start();

$test = new QuestionTest();

$test->action();