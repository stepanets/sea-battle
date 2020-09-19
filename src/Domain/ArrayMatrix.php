<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use InvalidArgumentException;
use Stepanets\SeaBattle\Domain\Field\Coordinate;
use function range;

final class ArrayMatrix implements Matrix
{
    private const CELL_EMPTY = 0;
    private const CELL_SHIP = 1;
    private const CELL_DAMAGED = 2;

    private array $matrix = [];

    public function __construct()
    {
        foreach (range(1, 10) as $row) {
            foreach (range('A', 'J') as $cell) {
                $this->matrix[$row][$cell] = self::CELL_EMPTY;
            }
        }
    }

    public function markShip(Coordinate $c): void
    {
        if ($this->matrix[$c->row()][$c->col()] !== self::CELL_EMPTY) {
            throw new InvalidArgumentException("Cell {$c->row()} is not empty");
        }

        $this->matrix[$c->row()][$c->col()] = self::CELL_SHIP;
    }

    public function markDamage(Coordinate $c): void
    {
        if ($this->matrix[$c->row()][$c->col()] === self::CELL_DAMAGED) {
            return;
        }

        if ($this->matrix[$c->row()][$c->col()] !== self::CELL_SHIP) {
            throw new InvalidArgumentException("Cell {$c->row()} is not ship");
        }

        $this->matrix[$c->row()][$c->col()] = self::CELL_DAMAGED;
    }

}