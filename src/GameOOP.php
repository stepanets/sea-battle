<?php declare(strict_types=1);


namespace Stepanets\SeaBattle;


use DomainException;
use Exception;
use RuntimeException;
use Stepanets\SeaBattle\Domain\Coordinate;
use Stepanets\SeaBattle\Domain\CpuPlayer;
use Stepanets\SeaBattle\Domain\Field;
use Stepanets\SeaBattle\Domain\HumanPlayer;
use Stepanets\SeaBattle\Domain\Media;
use Stepanets\SeaBattle\Domain\Ship;
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
        foreach ($this->playerShips() as $ship) {
            $ship->place($field1);
        }
        $field1->draw($this->media, 'Player field');

        $field2 = new Field(4, 4);
        foreach ($this->cpuShips() as $ship) {
            $ship->place($field2);
        }
        $field2->draw($this->media, 'CPU field');

        $human = new HumanPlayer($field1);
        $cpu = new CpuPlayer($field2);

        $i = 0;
        while (true) {
            $human->shoot($cpu);
            $cpu->field()->draw($this->media, 'After Player shoot');
            if ($cpu->field()->allDestroyed()) {
                echo "The winner is Player\n";
                return;
            }

            $cpu->shoot($human);
            $human->field()->draw($this->media, 'After CPU shoot');
            if ($human->field()->allDestroyed()) {
                echo "The winner is CPU\n";
                return;
            }

            if (++$i === 1000000) {
                throw new RuntimeException('Infinite loop occurred');
            }
        }
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generatePair(): Coordinate
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
        if ('xt' === $input = readline('Enter coordinate you want shoot (or "xt" to exit the game): ')) {
            throw new DomainException('Player has stopped the game');
        }

        return $input;
    }

    /**
     * @return Ship[]
     */
    private function playerShips(): array
    {
        // ['1A', '1B', '3B', '3C']
        return [
            Ship::Cruiser(Coordinate::fromString('1A'), true),
            Ship::Destroyer(Coordinate::fromString('3C'))
        ];
    }

    /**
     * @return Ship[]
     */
    private function cpuShips(): array
    {
        // ['1A', '2A', '2C', '3C']
        return [
            Ship::Destroyer(Coordinate::fromString('1A')),
            Ship::Destroyer(Coordinate::fromString('3C'), true)
        ];
    }
}