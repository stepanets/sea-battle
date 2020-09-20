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
     * @return int
     * @throws Exception
     */
    public function shoot(Player $enemy): int
    {
        return $enemy->field()->handleShoot(
            $this->playerPair()
        );
    }

    public function field(): Field
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
        echo "entered $input\n";
        return Coordinate::fromString($input);
    }
}