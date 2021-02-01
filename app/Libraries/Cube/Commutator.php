<?php

declare(strict_types=1);

namespace App\Libraries\Cube;

use App\Exceptions\Cube\InvalidRotationException;

class Commutator
{
    /**
     * @var Algorithm
     */
    private $a;

    /**
     * @var Algorithm
     */
    private $b;

    /**
     * @var Algorithm|null
     */
    private $setup;

    /**
     * @param Algorithm $a
     * @param Algorithm $b
     * @param Algorithm|null $setup
     */
    public function __construct(Algorithm $a, Algorithm $b, ?Algorithm $setup = null)
    {
        $this->a = $a;
        $this->b = $b;
        $this->setup = $setup;
    }

    /**
     * @return $this
     */
    public function inverse(): self
    {
        return new self($this->b, $this->a, $this->setup);
    }

    /**
     * @return Algorithm
     * @throws InvalidRotationException
     */
    public function algorithm(): Algorithm
    {
        return new Algorithm(implode(' ', array_filter([
            $this->setup,
            $this->a,
            $this->b,
            $this->a->inverse(),
            $this->b->inverse(),
            $this->setup ? $this->setup->inverse() : null
        ])));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $string = "[{$this->a}, {$this->b}]";
        if ($this->setup !== null) {
            $string = "[{$this->setup}: ${string}]";
        }
        return $string;
    }
}
