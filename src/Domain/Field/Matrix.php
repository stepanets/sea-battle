<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain\Field;


use InvalidArgumentException;
use Stepanets\SeaBattle\Domain\Coordinate;

use function array_fill;

final class Matrix
{
    private int $rows;
    private int $cols;
    private array $matrix;

    public static function zero(int $rows, int $cols): self
    {
        return self::filled($rows, $cols, 0);
    }

    public static function filled(int $rows, int $cols, int $code): self
    {
        return new self(
            array_fill(
                0,
                $rows,
                array_fill(0, $cols, $code)
            )
        );
    }

    public function __construct(array $matrix)
    {
        $this->matrix = $matrix;
        $this->rows = count($matrix);
        $this->cols = count($matrix[0]);
    }

    public function markCell(Coordinate $pair, int $code): void
    {
        $this->validateCoordinate($pair);
        $this->matrix[$pair->row()][$pair->col()] = $code;
    }

    public function code(Coordinate $pair): int
    {
        $this->validateCoordinate($pair);
        return $this->matrix[$pair->row()][$pair->col()];
    }

    public function rows(): int
    {
        return $this->rows;
    }

    public function cols(): int
    {
        return $this->cols;
    }

    public function has(int $code): bool
    {
        foreach ($this->matrix as $row) {
            foreach ($row as $cell) {
                if ($cell === $code) {
                    return true;
                }
            }
        }

        return false;
    }

    public function asArray(): array
    {
        return $this->matrix;
    }

    /**
     * @param Coordinate $pair
     * @return Coordinate[]
     */
    public function neighbors(Coordinate $pair): array
    {
        $result = [];
        for ($i = $pair->row() - 1; $i <= $pair->row() + 1; ++$i) {
            for ($j = $pair->col() - 1; $j <= $pair->col() + 1; ++$j) {
                if (isset($this->matrix[$i][$j]) && !($i === $pair->row() && $j === $pair->col())) {
                    $result[] = new Coordinate($i, $j);
                }
            }
        }

        return $result;
    }

    private function validateCoordinate(Coordinate $pair): void
    {
        if (0 > $pair->row() || $pair->row() > $this->rows - 1) {
            throw new InvalidArgumentException(
                sprintf(
                    'Row must be between 0 and %d, %d given',
                    $this->rows - 1,
                    $pair->row()
                )
            );
        }
        if (0 > $pair->col() || $pair->col() > $this->cols - 1) {
            throw new InvalidArgumentException(
                sprintf(
                    'Columns must be between 0 and %d, %d given',
                    $this->cols - 1,
                    $pair->col()
                )
            );
        }
    }
}