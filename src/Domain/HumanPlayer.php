<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Domain;


use DomainException;
use Exception;

final class HumanPlayer implements Player
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
                $pair = $this->playerPair()
            )) ? new ResultMiss($pair) : new ResultDamage($pair);
    }

    public function field(): TargetField
    {
        return $this->field;
    }

    /**
     * @return Coordinate
     */
    private function playerPair(): Coordinate
    {
        if ('xt' === $input = readline('Enter coordinate you want shoot (or "xt" to exit the game): ')) {
            throw new DomainException('Player has stopped the game');
        }
        return Coordinate::fromString($input);
    }
}