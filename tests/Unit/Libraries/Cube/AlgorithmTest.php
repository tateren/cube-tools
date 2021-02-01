<?php

namespace Tests\Unit\Libraries\Cube;

use App\Libraries\Cube\Algorithm;
use PHPUnit\Framework\TestCase;

class AlgorithmTest extends TestCase
{
    public function testConstruct(): void
    {
        $algorithm = new Algorithm("R U R' U'");
        self::assertInstanceOf(Algorithm::class, $algorithm);
    }

    public function testToString(): void
    {
        $algorithm = new Algorithm("R U R' U'");
        self::assertEquals("R U R' U'", (string)$algorithm);
    }

    public function testInverse(): void
    {
        $algorithm = new Algorithm("R U R' U'");
        self::assertEquals("U R U' R'", (string)$algorithm->inverse());
    }
}
