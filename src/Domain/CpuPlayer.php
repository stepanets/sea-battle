<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use Exception;

use function random_int;

final class CpuPlayer implements Player
{
    /**
     * @var Field
     */
    private Field $field;

    public function __construct(Field $field)
    {
        $this->field = $field;
    }

    /**
     * @param Player $enemy
     * @return ShootResult
     * @throws Exception
     */
    public function shoot(Player $enemy): ShootResult
    {
        return (Field::SHOOT_MISS === $res = $enemy->field()->handleShoot(
                $pair = $this->generatePair($enemy->field())
            )) ? new ResultMiss($pair) : new ResultDamage($pair);
    }

    public function field(): Field
    {
        return $this->field;
    }

    /**
     * @param TargetField $field
     * @return Coordinate
     * @throws Exception
     */
    private function generatePair(TargetField $field): Coordinate
    {
        return new Coordinate(
            random_int(0, $field->corner()->row()),
            random_int(0, $field->corner()->col())
        );
    }
}