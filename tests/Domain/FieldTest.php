<?php

declare(strict_types=1);


namespace Stepanets\SeaBattle\Tests\Domain;


use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Stepanets\SeaBattle\Domain\Coordinate;
use Stepanets\SeaBattle\Domain\Field;
use Stepanets\SeaBattle\Domain\Media;

final class FieldTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testDraw4x4(): void
    {
        /** @var Media & MockObject $media */
        $media = $this->getMockForAbstractClass(Media::class);
        $media->expects(self::once())
            ->method('drawField')
            ->withConsecutive([
                [
                    [0 ,0 ,0, 0],
                    [0 ,0 ,0, 0],
                    [0 ,0 ,0, 0],
                    [0 ,0 ,0, 0],
                ], 'Foo', 4
            ]);
        (new Field(4, 4))->draw($media, 'Foo');
    }

    /**
     * @throws Exception
     */
    public function testDraw5x5(): void
    {
        /** @var Media & MockObject $media */
        $media = $this->getMockForAbstractClass(Media::class);
        $media->expects(self::once())
            ->method('drawField')
            ->withConsecutive([
                [
                    [0 ,0 ,0, 0, 0],
                    [0 ,0 ,0, 0, 0],
                    [0 ,0 ,0, 0, 0],
                    [0 ,0 ,0, 0, 0],
                    [0 ,0 ,0, 0, 0],
                ], 'Bar', 5
            ]);
        (new Field(5, 5))->draw($media, 'Bar');
    }

    /**
     * @throws Exception
     */
    public function testPlaceShip(): void
    {
        /** @var Media & MockObject $media */
        $media = $this->getMockForAbstractClass(Media::class);
        $media->expects(self::once())
            ->method('drawField')
            ->withConsecutive([
                [
                    [1 ,0],
                    [0 ,0],
                ], '', 2
            ]);


        $field = new Field(2, 2);
        $field->placeShip(new Coordinate(0, 0));
        $field->draw($media, '');
    }

    /**
     * @throws Exception
     */
    public function testHandleShootDamaged(): void
    {
        /** @var Media & MockObject $media */
        $media = $this->getMockForAbstractClass(Media::class);
        $media->expects(self::once())
            ->method('drawField')
            ->withConsecutive([
                [
                    [2 ,1],
                    [0 ,0],
                ], '', 2
            ]);

        $field = new Field(2, 2);
        $field->placeShip(new Coordinate(0, 0), new Coordinate(0, 1));
        self::assertEquals(
            Field::SHOOT_DAMAGE,
            $field->handleShoot(new Coordinate(0, 0))
        );
        $field->draw($media, '');
    }

    /**
     * @throws Exception
     */
    public function testHandleShootKilled(): void
    {
        /** @var Media & MockObject $media */
        $media = $this->getMockForAbstractClass(Media::class);
        $media->expects(self::once())
            ->method('drawField')
            ->withConsecutive([
                [
                    [2 ,0],
                    [0 ,0],
                ], '', 2
            ]);

        $field = new Field(2, 2);
        $field->placeShip(new Coordinate(0, 0));
        self::assertEquals(
            Field::SHOOT_KILL,
            $field->handleShoot(new Coordinate(0, 0))
        );
        $field->draw($media, '');
    }
}