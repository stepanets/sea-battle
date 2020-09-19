<?php declare(strict_types=1);


namespace Stepanets\SeaBattle;


final class Game
{
    public function run(): void
    {
        $name = \readline('Enter your name: ');
        echo "Your name is $name\n";

        $player1 = new Human(
            $name,
            new RandomField()
        );
        $player2 = new AI(
            new RandomField()
        );

        $attacker = $player1;
        $defender = $player2;
        do {
            $result = $attacker->shoot($defender);
            [$attacker, $defender] = [$defender, $attacker];
        } while(!$result->isOver());

        $result->print($this->media);
    }
}