<?php declare(strict_types=1);

/*
 * (c) Vladimir "allejo" Jimenez <me@allejo.io>
 *
 * For the full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 */

namespace allejo\bzflag\networking\Packets;

use allejo\bzflag\networking\GameData\PlayerScore;

class MsgAddPlayer extends GamePacket
{
    const PACKET_TYPE = 'MsgAddPlayer';

    /** @var int */
    private $playerIndex;

    /** @var int */
    private $playerType;

    /** @var int */
    private $teamValue;

    /** @var string */
    private $callsign;

    /** @var string */
    private $motto;

    /** @var PlayerScore */
    private $score;

    /**
     * @return int
     */
    public function getPlayerIndex(): int
    {
        return $this->playerIndex;
    }

    /**
     * @return int
     */
    public function getPlayerType(): int
    {
        return $this->playerType;
    }

    /**
     * @return int
     */
    public function getTeamValue(): int
    {
        return $this->teamValue;
    }

    /**
     * @return string
     */
    public function getCallsign(): string
    {
        return $this->callsign;
    }

    /**
     * @return string
     */
    public function getMotto(): string
    {
        return $this->motto;
    }

    /**
     * @return PlayerScore
     */
    public function getScore(): PlayerScore
    {
        return $this->score;
    }

    protected function defaultComplexVariables(): void
    {
        $this->score = new PlayerScore();
    }

    protected function unpack(): void
    {
        $this->playerIndex = NetworkPacket::unpackUInt8($this->buffer);
        $this->playerType = NetworkPacket::unpackUInt16($this->buffer);
        $this->teamValue = NetworkPacket::unpackUInt16($this->buffer);
        $this->score->wins = NetworkPacket::unpackUInt16($this->buffer);
        $this->score->losses = NetworkPacket::unpackUInt16($this->buffer);
        $this->score->teamKills = NetworkPacket::unpackUInt16($this->buffer);
        $this->callsign = NetworkPacket::unpackString($this->buffer, NetworkProtocol::CALLSIGN_LEN);
        $this->motto = NetworkPacket::unpackString($this->buffer, NetworkProtocol::MOTTO_LEN);
    }
}
