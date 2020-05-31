<?php declare(strict_types=1);

/*
 * (c) Vladimir "allejo" Jimenez <me@allejo.io>
 *
 * For the full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 */

namespace allejo\bzflag\world\Object;

use allejo\bzflag\generic\FrozenObstacleException;
use allejo\bzflag\networking\Packets\NetworkPacket;
use allejo\bzflag\world\WorldDatabase;

class Teleporter extends Obstacle
{
    /** @var string */
    private $name;

    /** @var float */
    private $border;

    /** @var bool */
    private $horizontal;

    public function __construct(WorldDatabase $database)
    {
        parent::__construct($database, ObstacleType::TELE_TYPE);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBorder(): float
    {
        return $this->border;
    }

    public function isHorizontal(): bool
    {
        return $this->horizontal;
    }

    /**
     * @throws FrozenObstacleException
     *
     * @return Teleporter
     */
    public function setName(string $name): self
    {
        $this->frozenObstacleCheck();
        $this->name = $name;

        return $this;
    }

    /**
     * @throws FrozenObstacleException
     *
     * @return Teleporter
     */
    public function setBorder(float $border): self
    {
        $this->frozenObstacleCheck();
        $this->border = $border;

        return $this;
    }

    /**
     * @throws FrozenObstacleException
     *
     * @return Teleporter
     */
    public function setHorizontal(bool $horizontal): self
    {
        $this->frozenObstacleCheck();
        $this->horizontal = $horizontal;

        return $this;
    }

    public function unpack(&$resource): void
    {
        $this->name = NetworkPacket::unpackStdString($resource);

        $this->pos = NetworkPacket::unpackVector($resource);
        $this->angle = NetworkPacket::unpackFloat($resource);
        $this->size = NetworkPacket::unpackVector($resource);
        $this->border = NetworkPacket::unpackFloat($resource);

        $horizontalByte = NetworkPacket::unpackUInt8($resource);
        $this->horizontal = $horizontalByte !== 0;

        $stateByte = NetworkPacket::unpackUInt8($resource);
        $this->driveThrough = ($stateByte & (1 << 0)) !== 0;
        $this->shootThrough = ($stateByte & (1 << 1)) !== 0;
        $this->ricochet = ($stateByte & (1 << 3)) !== 0;

        $this->freeze();
    }
}
