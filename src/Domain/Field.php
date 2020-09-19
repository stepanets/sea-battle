<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use function str_split;

final class Field
{
    private array $field = [];

    private int $cols;

    public function __construct(int $rows, int $cols)
    {
        $letters = range('A', 'Z');
        for ($i = 1; $i <= $rows; ++$i) {
            for ($j = 1; $j <= $cols; ++$j) {
                $this->field[$i][$letters[$j - 1]] = 0;
            }
        }
        $this->cols = $cols;
    }

    public function placeShip(array $coords): void
    {
        foreach ($coords as $pair) {
            [$row, $col] = str_split($pair);
            $this->field[$row][$col] = 1;
        }
    }

    public function handleShoot(string $pair): bool
    {
        [$r, $c] = str_split($pair);

        if ($this->field[$r][$c] === 1) {
            $this->field[$r][$c] = 2;
            return true;
        }

        return false;
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
}