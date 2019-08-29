<?php
namespace App;

interface AlgorithmInterface
{
    public function __construct($userAnswears = [], $weightAnswears = []);
    public function getResult();
    public function checkTest();
    public function getWeight();
}