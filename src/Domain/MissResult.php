<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Coordinate;

final class MissResult implements ShootResult
{
    /**
     * @var Coordinate
     */
    private Coordinate $c;

    public function __construct(Coordinate $c)
    {
        $this->c = $c;
    }

    public function apply(ResultField $field)
    {
        $field->markMissed($this->c);
    }
}