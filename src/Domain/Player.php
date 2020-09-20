<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


interface Player
{
    public function shoot(Player $enemy): int;

    public function field(): Field;
}