<?php declare(strict_types=1);


namespace Stepanets\SeaBattle\Application;


use InvalidArgumentException;
use Stepanets\SeaBattle\Domain\AttackResult;
use Stepanets\SeaBattle\Domain\Defender;
use Stepanets\SeaBattle\Domain\Field\Coordinate;
use Stepanets\SeaBattle\Domain\Player;
use Stepanets\SeaBattle\Domain\TargetField;
use function readline;
use function str_split;

final class ReadlinePlayer implements Player
{
    private string $prompt;

    private string $errorMsg;

    public function __construct(string $prompt, string $errorMsg)
    {
        $this->prompt = $prompt;
        $this->errorMsg = $errorMsg;
    }

    public function shoot(Defender $defender): AttackResult
    {
        while (true) {
            try {
                $defender
                    ->field()
                    ->handleShoot(
                        new Coordinate(
                            ...str_split(
                                readline($this->prompt)
                            )
                        )
                    );
            } catch (InvalidArgumentException $exception) {
                echo "{$this->errorMsg}\n";
            }
        }

    }

    public function field(): TargetField
    {
        // TODO: Implement field() method.
    }
}