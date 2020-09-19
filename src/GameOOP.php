<?php declare(strict_types=1);


namespace Stepanets\SeaBattle;


use DomainException;
use Exception;
use Stepanets\SeaBattle\Domain\Field;
use Stepanets\SeaBattle\Domain\Media;
use function random_int;
use function readline;

final class GameOOP
{
    /**
     * @var Media
     */
    private Media $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }


    /**
     * @throws Exception
     */
    public function run(): void
    {
        $field1 = new Field(4, 4);
        $field1->placeShip(['1A', '2A', '2C', '3C']);
        $field1->draw($this->media, 'Player field');

        $field2 = new Field(4, 4,);
        $field2->placeShip(['1A', '1B', '3B', '3C']);
        $field2->draw($this->media, 'CPU field');

        while (true) {
            $field2->handleShoot($this->playerPair());
            $field2->draw($this->media, 'After Player shoot');
            if ($field2->allDestroyed()) {
                echo "The winner is Player\n";
                return;
            }

            $field1->handleShoot($this->generatePair());
            $field1->draw($this->media, 'After CPU shoot');
            if ($field1->allDestroyed()) {
                echo "The winner is CPU\n";
                return;
            }
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generatePair(): string
    {
        $rows = range(1, 3);
        $cols = range('A', 'C');
        return $rows[random_int(0, 2)].$cols[random_int(0, 2)];
    }

    /**
     * @return string
     * @throws Exception
     */
    private function playerPair(): string
    {
        if ('exit' === $input = readline('Enter coords: ')) {
            throw new DomainException('Player has stopped the game');
        }

        return $input;
    }
}