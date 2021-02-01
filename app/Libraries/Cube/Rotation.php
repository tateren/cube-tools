<?php

declare(strict_types=1);

namespace App\Libraries\Cube;

use App\Exceptions\Cube\InvalidRotationException;

class Rotation
{
    /**
     * @var string
     */
    private $rotation;

    /**
     * @param string $rotation
     * @throws InvalidRotationException
     */
    public function __construct(string $rotation)
    {
        $pattern = "/^([ULFRBD]w?|[MESxyz])[2']?$/";
        if (preg_match($pattern, $rotation, $match) !== 1) {
            throw new InvalidRotationException('invalid rotation');
        }
        $this->rotation = $rotation;
    }

    public function inverse(): self
    {
        $inverse = clone $this;
        switch (substr($this->rotation, -1)) {
            case "'":
                $inverse->rotation = substr($this->rotation, 0, -1);
                break;
            case "2":
                break;
            default:
                $inverse->rotation = $this->rotation . "'";
        }
        return $inverse;
    }

    public function __toString(): string
    {
        return $this->rotation;
    }
}
