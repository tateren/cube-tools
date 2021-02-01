<?php

namespace Tests\Unit\Libraries\Cube;

use App\Exceptions\Cube\InvalidRotationException;
use App\Libraries\Cube\Algorithm;
use App\Libraries\Cube\Commutator;
use PHPUnit\Framework\TestCase;

class CommutatorTest extends TestCase
{
    /**
     * @param Algorithm $a
     * @param Algorithm $b
     * @param ?Algorithm $setup
     * @dataProvider algorithms
     */
    public function testConstruct(Algorithm $a, Algorithm $b, ?Algorithm $setup): void
    {
        $commutator = new Commutator($a, $b, $setup);
        self::assertInstanceOf(Commutator::class, $commutator);
    }

    /**
     * @param Algorithm $a
     * @param Algorithm $b
     * @param ?Algorithm $setup
     * @dataProvider algorithms
     */
    public function testExpression(Algorithm $a, Algorithm $b, ?Algorithm $setup): void
    {
        $commutator = new Commutator($a, $b, $setup);
        self::assertEquals("[D: [U2, R D R']]", (string)$commutator);
    }

    /**
     * @param Algorithm $a
     * @param Algorithm $b
     * @param ?Algorithm $setup
     * @dataProvider algorithms
     * @throws InvalidRotationException
     */
    public function testToString(Algorithm $a, Algorithm $b, ?Algorithm $setup): void
    {
        $commutator = new Commutator($a, $b, $setup);
        self::assertEquals("D U2 R D R' U2 R D' R' D'", (string)$commutator->algorithm());
    }

    /**
     * @param Algorithm $a
     * @param Algorithm $b
     * @param ?Algorithm $setup
     * @dataProvider algorithms
     * @throws InvalidRotationException
     */
    public function testInverse(Algorithm $a, Algorithm $b, ?Algorithm $setup): void
    {
        $commutator = new Commutator($a, $b, $setup);
        $inverse = $commutator->inverse();
        self::assertEquals("[D: [R D R', U2]]", (string)$inverse);
        self::assertEquals("D R D R' U2 R D' R' U2 D'", (string)$inverse->algorithm());
    }

    /**
     * @param Algorithm $a
     * @param Algorithm $b
     * @dataProvider algorithms
     * @throws InvalidRotationException
     */
    public function testWithoutSetup(Algorithm $a, Algorithm $b): void
    {
        $commutator = new Commutator($a, $b, null);
        self::assertInstanceOf(Commutator::class, $commutator);
        self::assertEquals("[U2, R D R']", (string)$commutator);
        self::assertEquals("U2 R D R' U2 R D' R'", (string)$commutator->algorithm());
    }

    /**
     * @return Algorithm[][]
     */
    public function algorithms(): array
    {
        return [
            [new Algorithm("U2"), new Algorithm("R D R'"), new Algorithm("D")],
        ];
    }
}
