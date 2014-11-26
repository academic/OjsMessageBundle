<?php

/*
 * This file is part of the Okulbilisim MessageBundle
 *
 * (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Okulbilisim\MessageBundle\Model\FrontModel;

use Okulbilisim\MessageBundle\Model\FrontModel\BaseModel;
use Okulbilisim\MessageBundle\Model\FrontModel\ModelInterface;

/**
 *
 * @category Okulbilisim
 * @package  MessageBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * 
 *
 */
class ThreadModel extends BaseModel implements ModelInterface
{
    /**
     *
     * @access public
     * @return \Okulbilisim\MessageBundle\Entity\Thread
     */
    public function createThread()
    {
        return $this->getManager()->createThread();
    }

    /**
     *
     * @access public
     * @param  int                                        $envelopeId
     * @param  int                                        $userId
     * @return \Okulbilisim\MessageBundle\Entity\Envelope
     */
    public function findThreadWithAllEnvelopesByThreadIdAndUserId($threadId, $userId)
    {
        return $this->getRepository()->findThreadWithAllEnvelopesByThreadIdAndUserId($threadId, $userId);
    }
}
