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
     * @return int
     * @throws Exception
     */
    public function shoot(Player $enemy): int
    {
        return $enemy->field()->handleShoot(
            $this->generatePair($enemy->field())
        );
    }

    public function field(): Field
    {
        return $this->field;
    }

    /**
     * @param Field $field
     * @return Coordinate
     * @throws Exception
     */
    private function generatePair(Field $field): Coordinate
    {
        return new Coordinate(
            random_int(0, $field->corner()->row()),
            random_int(0, $field->corner()->col())
        );
    }
}