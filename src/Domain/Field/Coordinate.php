<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain\Field;


use InvalidArgumentException;

final class Coordinate
{
    private int $row;
    private string $column;

    /**
     * @param int $row From 1 to 10
     * @param string $column From A to J
     */
    public function __construct(int $row, string $column)
    {
        if (1 >  $row || $row > 10) {
            throw new InvalidArgumentException("row must be between 1 and 10, $row given");
        }

        if (!in_array($column, range('A', 'J'), true)) {
            throw new InvalidArgumentException("column must be between A and J, $column given");
        }

        $this->row = $row;
        $this->column = $column;
    }

    public function row(): int
    {
        return $this->row;
    }

    public function col(): string
    {
        return $this->column;
    }

    public function asString(): string
    {
        return "{$this->row}{$this->column}";
    }
}