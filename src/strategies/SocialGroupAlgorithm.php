<?php
namespace App\strategies;
use App\AlgorithmInterface;

class SocialGroupAlgorithm implements AlgorithmInterface
{
    public function __construct($userAnswears = [], $weightAnswears = []);
    public function getResult();
    public function checkTest();
    public function getWeight();
}