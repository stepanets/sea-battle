<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use function array_search;
use function preg_split;
use function range;
use function sprintf;

final class Coordinate
{
    private int $row;
    private int $col;

    public static function fromString(string $pair)
    {
        [$r, $char] = preg_split('/\d+\K/', $pair);
        return new self(
            $r - 1,
            array_search($char, range('A', 'Z'), true)
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
            $this->row,
            range('A', 'Z')[$this->col]
        );
    }
}