<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Stepanets\SeaBattle\Domain\Field\Coordinate;

final class DamageResult implements ShootResult
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
        $field->markDamaged($this->c);
    }
}