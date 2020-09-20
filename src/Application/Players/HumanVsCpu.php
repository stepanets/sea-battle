<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Application\Players;


use Stepanets\SeaBattle\Domain\Coordinate;
use Stepanets\SeaBattle\Domain\CpuPlayer;
use Stepanets\SeaBattle\Domain\Field;
use Stepanets\SeaBattle\Domain\Field\Matrix;
use Stepanets\SeaBattle\Domain\HumanPlayer;
use Stepanets\SeaBattle\Domain\Player;
use Stepanets\SeaBattle\Domain\Players;
use Stepanets\SeaBattle\Domain\Ship;

final class HumanVsCpu implements Players
{
    public function one(): Player
    {
        $field = new Field(
            Matrix::zero(4, 4)
        );
        foreach ($this->playerShips() as $ship) {
            $ship->place($field);
        }
        return new HumanPlayer($field);
    }

    public function two(): Player
    {
        $field = new Field(
            Matrix::zero(4, 4)
        );
        foreach ($this->cpuShips() as $ship) {
            $ship->place($field);
        }
        return new CpuPlayer($field);
    }

    /**
     * @return Ship[]
     */
    private function playerShips(): array
    {
        // ['1A', '1B', '3B', '3C']
        return [
            Ship::Cruiser(Coordinate::fromString('1A'), true),
            Ship::Destroyer(Coordinate::fromString('3C'))
        ];
    }

    /**
     * @return Ship[]
     */
    private function cpuShips(): array
    {
        // ['1A', '2A', '2C', '3C']
        return [
            Ship::Destroyer(Coordinate::fromString('1A')),
            Ship::Destroyer(Coordinate::fromString('3C'), true)
        ];
    }
}