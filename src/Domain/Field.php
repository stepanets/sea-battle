<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use InvalidArgumentException;
use function array_fill;

final class Field
{
    public const SHOOT_MISS = 0;
    public const SHOOT_DAMAGE = 1;
    public const SHOOT_KILL = 2;

    private const CELL_EMPTY = 0;
    private const CELL_SHIP = 1;
    private const CELL_DAMAGED_SHIP = 2;

    private array $field = [];

    private int $cols;
    private int $rows;

    public function __construct(int $rows, int $cols)
    {
        $this->cols = $cols;
        $this->rows = $rows;
        $this->field = array_fill(
            0,
            $rows,
            array_fill(0, $cols, self::CELL_EMPTY)
        );
    }

    public function corner(): Coordinate
    {
        return new Coordinate($this->rows - 1, $this->cols - 1);
    }

    public function placeShip(Coordinate ...$coords): void
    {
        foreach ($coords as $pair) {
            if (!isset($this->field[$r = $pair->row()][$c = $pair->col()])) {
                throw new InvalidArgumentException(sprintf('Coordinate %s is out of the field', $pair));
            }
            $this->field[$pair->row()][$pair->col()] = 1;
        }
    }

    public function handleShoot(Coordinate $pair): int
    {
        if ($this->field[$r = $pair->row()][$c = $pair->col()] === self::CELL_SHIP) {
            $this->field[$r][$c] = self::CELL_DAMAGED_SHIP;
            return $this->checkKilled($pair) ? self::SHOOT_KILL : self::SHOOT_DAMAGE;
        }

        return self::SHOOT_MISS;
    }

    public function allDestroyed(): bool
    {
        foreach ($this->field as $row) {
            foreach ($row as $cell) {
                if ($cell === 1) {
                    return false;
                }
            }
        }

        return true;
    }

    public function draw(Media $media, string $title): void
    {
        $media->drawField($this->field, $title, $this->cols);
    }

    private function checkKilled(Coordinate $pair): bool
    {
        for ($i = $pair->row() - 1; $i < $pair->row() + 1; ++$i) {
            for ($j = $pair->col() - 1; $j < $pair->col() + 1; ++$j) {
                if (isset($this->field[$i][$j]) && $this->field[$i][$j] === self::CELL_SHIP) {
                    return false;
                }
            }
        }

        return true;
    }
}