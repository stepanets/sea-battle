<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use InvalidArgumentException;

use function array_search;
use function in_array;
use function preg_split;
use function range;
use function sprintf;
use function strtoupper;

final class Coordinate
{
    private int $row;
    private int $col;

    public static function fromString(string $pair)
    {
        [$r, $char] = preg_split('/\d+\K/', $pair);

        if (1 > $r = (int)$r) {
            throw new InvalidArgumentException("Row must be more than 0, $r given");
        }

        if (!in_array($upChar = strtoupper($char), $alfa = range('A', 'Z'), true)) {
            throw new InvalidArgumentException("Column must be between A and Z, $char given");
        }

        return new self(
            $r - 1,
            array_search($upChar, range('A', 'Z'), true)
        );
    }

    public static function bottomOf(Coordinate $pair)
    {
        return new self($pair->row() + 1, $pair->col());
    }

    public static function leftOf(Coordinate $pair)
    {
        return new self($pair->row(), $pair->col() + 1);
    }

    public function __construct(int $row, int $col)
    {
        $this->row = $row;
        $this->col = $col;
    }

    public function row(): int
    {
        return $this->row;
    }

    public function col(): int
    {
        return $this->col;
    }

    public function __toString(): string
    {
        return sprintf(
            '%d%s',
            $this->row + 1,
            range('A', 'Z')[$this->col]
        );
    }
}