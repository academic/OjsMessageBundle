<?php

/*
 * This file is part of the OjsMessage MessageBundle
 *
 * (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OjsMessage\MessageBundle\Tests\Repository;

use OjsMessage\MessageBundle\Tests\TestBase;

class ThreadRepositoryTest extends TestBase
{
    public function testFindThreadWithAllEnvelopesByThreadIdAndUserId()
	{
		$this->purge();
		$user = $this->addNewUser('bob', 'bob@foo.com', 'root');
		$folders = $this->addFixturesForFolders(array($user));
		$messages = $this->addFixturesForMessages(array($user));
		$this->addFixturesForEnvelopes($messages, $folders, array($user));
		$threadFound = $this->getThreadModel()->findThreadWithAllEnvelopesByThreadIdAndUserId($messages[0]->getThread()->getId(), $user->getId());

		$this->assertNotNull($threadFound);
		$this->assertInstanceOf('OjsMessage\MessageBundle\Entity\Thread', $threadFound);
		$this->assertCount(5, $threadFound->getEnvelopes());
	}
}