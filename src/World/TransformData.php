<?php declare(strict_types=1);

/*
 * (c) Vladimir "allejo" Jimenez <me@allejo.io>
 *
 * For the full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 */

namespace allejo\bzflag\networking\World;

class TransformData
{
    /** @var int */
    public $type;

    /** @var int */
    public $index;

    /** @var float[4] */
    public $data;
}
