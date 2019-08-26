<?php

use PHPUnit\Framework\TestCase;
use App\QuestionTest;

final class QuestionTestTest extends TestCase
{
    public function testAction(): void
    {
        $test = new QuestionTest();
        $this->assertEquals("Константин", $test->action());
    }
}