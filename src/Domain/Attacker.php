<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


interface Attacker
{
    public function shoot(Defender $enemy): void;
}