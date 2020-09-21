<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


final class ResultDamage implements ShootResult
{
    /**
     * @var Coordinate
     */
    private Coordinate $pair;

    public function __construct(Coordinate $pair)
    {
        $this->pair = $pair;
    }

    public function updateMap(Map $map): void
    {
        $map->markDamage($this->pair);
    }
}