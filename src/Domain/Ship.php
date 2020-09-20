<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


final class Ship
{
    /**
     * @var Coordinate[]
     */
    private array $pairs;

    public static function Boat(Coordinate $pair): self
    {
        return new self($pair);
    }

    public static function Destroyer(Coordinate $pair, $vertical = false): self
    {
        return $vertical ?
            new self($pair, Coordinate::bottomOf($pair)) :
            new self($pair, Coordinate::leftOf($pair));
    }

    public static function Cruiser(Coordinate $pair, $vertical = false): self
    {
        return $vertical ?
            new self($pair, $p = Coordinate::bottomOf($pair), Coordinate::bottomOf($p)) :
            new self($pair, $p = Coordinate::leftOf($pair), Coordinate::leftOf($p));
    }

    private function __construct(Coordinate ...$pairs)
    {
        $this->pairs = $pairs;
    }

    public function place(Field $field): void
    {
        $field->placeShip(...$this->pairs);
    }
}