<?php declare(strict_types=1);


namespace Stepanets\SeaBattle;


use Exception;
use InvalidArgumentException;
use RuntimeException;
use Stepanets\SeaBattle\Domain\Field\Matrix;
use Stepanets\SeaBattle\Domain\Map;
use Stepanets\SeaBattle\Domain\Media;
use Stepanets\SeaBattle\Domain\Player;
use Stepanets\SeaBattle\Domain\Players;

final class GameOOP
{
    /**
     * @var Media
     */
    private Media $media;

    /**
     * @var Players
     */
    private Players $players;

    public function __construct(Players $players, Media $media)
    {
        $this->media = $media;
        $this->players = $players;
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $human = $this->players->first();
        $human->field()->draw($this->media, 'Player field');
        $cpu = $this->players->second();
        $cpu->field()->draw($this->media, 'CPU field');

        $map = new Map(Matrix::zero(4, 4));

        $i = 0;
        while (true) {
            try {
                if ($this->turn($human, $cpu, $map)) {
                    return;
                }
            } catch (InvalidArgumentException $e) {
                echo "Incorrect input, try again\n";
            }


            if (++$i === 1000000) {
                throw new RuntimeException('Infinite loop occurred');
            }
        }
    }

    private function turn(Player $human, Player $cpu, Map $map): bool
    {
        $human->shoot($cpu)->updateMap($map);
//            $cpu->field()->draw($this->media, 'After Player shoot');
        $map->draw($this->media, 'Player map');
        if ($cpu->field()->allDestroyed()) {
            echo "The winner is Player\n";
            return true;
        }

        $cpu->shoot($human);
        $human->field()->draw($this->media, 'After CPU shoot');
        if ($human->field()->allDestroyed()) {
            echo "The winner is CPU\n";
            return true;
        }

        return false;
    }
}