<?php

declare(strict_types=1);

namespace App\Libraries\Cube;

use App\Exceptions\Cube\InvalidRotationException;

class Algorithm
{
    /**
     * @var Rotation[]
     */
    private $rotations;

    /**
     * @param string $algorithm
     *
     * @throws InvalidRotationException
     */
    public function __construct(string $algorithm)
    {
        foreach (explode(' ', $algorithm) as $rotation) {
            $this->rotations[] = new Rotation($rotation);
        }
    }

    /**
     * @return $this
     */
    public function inverse(): self
    {
        $inverse = clone $this;
        $inverse->rotations = array_map(static function (Rotation $rotation) {
            return $rotation->inverse();
        }, array_reverse($this->rotations));
        return $inverse;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode(' ', $this->rotations);
    }
}
