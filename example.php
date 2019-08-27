<?php

// 1. Будет сущность QuestionTest имеющий общую логику для создания всех тестов. Который будет состоять из методов:
        // createTest(testType)
        // updateTest(id)
        // removeTest(id);
    //На его основе будут создаваться все наши тесты.

// 2. Будет сущность User который будет взаимодействовать с тестом.

// 3. Будет сущность Alorirm (AlorirmInterface) на его основе будет создаваться неограниченное кол-во
    // алгоритмов с разной логикой.

// 4. Будет сущность ProcessingTest( new User, "testType", new Algorithm);
    //  Вкючает в себя:
        // Пользователя который проходит тест.
        // Конкретный тест
        // Алгоритм, который будет проверять результаты теста.

// В результате:
    // 1. По адрессу /tests-list будет список предлогаемых тестов.
    // 2. Пользователь кликает на тест:
        // Создается сессия прохождения теста. Срабатывает класс new ProcessingTest(new User, 'testType',  [ new FirstAlgorithm, ... ] )
        // Пользователь проходит тест жмет "показать результат" пользовательские ответы прогоняются через 
        //  алгоритмы и отображает пользователю рузальтат в процентах.

//  $test = [
//     1 => [
//         "question" => "Любите ли вы выпекать пироги?",
//         "answear" => [
//             1 => "Люблю",
//             2 => "Думаю только об этом, не могу спать.",
//             3 => "Нет"
//         ]
        
//     // ...

//     ]
//  ];    