<?php

namespace Tests\Unit\Libraries\Cube;

use App\Exceptions\Cube\InvalidRotationException;
use App\Libraries\Cube\Rotation;
use PHPUnit\Framework\TestCase;

class RotationTest extends TestCase
{
    /**
     * @dataProvider validRotations
     * @param string $rotation
     * @throws InvalidRotationException
     */
    public function testValidRotations(string $rotation): void
    {
        self::assertInstanceOf(Rotation::class, new Rotation($rotation));
    }

    /**
     * @dataProvider invalidRotations
     * @param string $rotation
     */
    public function testInvalidRotation(string $rotation): void
    {
        $this->expectException(InvalidRotationException::class);
        new Rotation($rotation);
    }

    /**
     * @dataProvider inverseDataProvider
     * @param string $rotation
     * @param string $inverse
     * @throws InvalidRotationException
     */
    public function testInverse(string $rotation, string $inverse): void
    {
        self::assertEquals($inverse, (string)(new Rotation($rotation))->inverse());
    }

    public function validRotations(): array
    {
        return [
            ["U"], ["U2"], ["U'"], ["Uw"], ["Uw2"], ["Uw'"],
            ["L"], ["L2"], ["L'"], ["Lw"], ["Lw2"], ["Lw'"],
            ["F"], ["F2"], ["F'"], ["Fw"], ["Fw2"], ["Fw'"],
            ["R"], ["R2"], ["R'"], ["Rw"], ["Rw2"], ["Rw'"],
            ["B"], ["B2"], ["B'"], ["Bw"], ["Bw2"], ["Bw'"],
            ["D"], ["D2"], ["D'"], ["Dw"], ["Dw2"], ["Dw'"],
            ["M"], ["M2"], ["M'"],
            ["E"], ["E2"], ["E'"],
            ["S"], ["S2"], ["S'"],
            ["x"], ["x2"], ["x'"],
            ["y"], ["y2"], ["y'"],
            ["z"], ["z2"], ["z'"],
        ];
    }

    public function invalidRotations(): array
    {
        return [
            ["A"],
            ["U2'"],
            ["Mw"],
        ];
    }

    public function inverseDataProvider(): array
    {
        return [
            ["U", "U'"],
            ["U'", "U"],
            ["U2", "U2"],
        ];
    }
}
