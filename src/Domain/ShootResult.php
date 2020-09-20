<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


interface ShootResult
{
    public function updateMap(Map $map): void;
}