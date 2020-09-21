<?php declare(strict_types=1);


namespace Stepanets\SeaBattle;


use DomainException;
use Exception;
use LucidFrame\Console\ConsoleTable;
use function random_int;
use function readline;

final class Game
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        $field1 =
            $this->drawField(
                $this->placeShips(
                    $this->makeField(), ['1A', '2A', '2C', '3C']
                ),
                'Player 1 field'
            );

        $field2 =
            $this->drawField(
                $this->placeShips(
                    $this->makeField(), ['1A', '1B', '3B', '3C']
                ),
                'Player 2 field'
            );

        while (true) {
            $field2 = $this->drawField(
                $this->shoot($field2, $this->playerPair()),
                'After Player shoot'
            );
            if ($this->allDestroyed($field2)) {
                echo "The winner is Player\n";
                return;
            }

            $field1 = $this->drawField(
                $this->shoot($field1, $this->generatePair()),
                'After CPU shoot'
            );
            if ($this->allDestroyed($field2)) {
                echo "The winner is CPU\n";
                return;
            }
        }
    }

    private function makeField(): array
    {
        return [
            1 => ['A' => 0, 'B' => 0, 'C' => 0],
            2 => ['A' => 0, 'B' => 0, 'C' => 0],
            3 => ['A' => 0, 'B' => 0, 'C' => 0],
        ];
    }

    private function placeShips(array $field, array $coords): array
    {
        foreach ($coords as $pair) {
            [$row, $col] = str_split($pair);
            $field[$row][$col] = 1;
        }

        return $field;
    }

    private function drawField(array $field, string $title): array
    {
        echo $title, "\n";

        $t = (new ConsoleTable())->addRow(['X', 'A', 'B', 'C']);
        foreach ($field as $n => $row) {
            $t = $t->addRow()->addColumn($n);
            foreach ($row as $l => $cell) {
                $t->addColumn($cell);
            }
        }
        $t->display();

        return $field;
    }

    private function shoot(array $field, string $pair): array
    {
        [$r, $c] = str_split($pair);

        if ($field[$r][$c] === 1) {
            $field[$r][$c] = 2;
        }

        return $field;
    }

    private function allDestroyed(array $field): bool
    {
        foreach ($field as $row) {
            foreach ($row as $cell) {
                if ($cell === 1) {
                    return false;
                }
            }
        }

        return true;
    }

    private function playerPair(): string
    {
        if ('exit' === $input = readline('Enter coords: ')) {
            throw new DomainException('Player has stopped the game');
        }

        return $input;
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generatePair(): string
    {
        $rows = range(1, 3);
        $cols = range('A', 'C');
        return $rows[random_int(0, 2)].$cols[random_int(0, 2)];
    }
}