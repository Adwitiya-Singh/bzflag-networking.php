<?php declare(strict_types=1);

/*
 * (c) Vladimir "allejo" Jimenez <me@allejo.io>
 *
 * For the full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 */

namespace allejo\bzflag\networking\Packets;

class MsgScoreOver extends GamePacket
{
    public const PACKET_TYPE = 'MsgScoreOver';

    /** @var int */
    private $playerId;

    /** @var int */
    private $team;

    public function getPlayerId(): int
    {
        return $this->playerId;
    }

    public function getTeam(): int
    {
        return $this->team;
    }

    protected function unpack(): void
    {
        $this->playerId = NetworkPacket::unpackUInt8($this->buffer);
        $this->team = NetworkPacket::unpackUInt16($this->buffer);
    }
}
