<?php

/*
 * This file is part of the OjstrMessage MessageBundle
 *
 * (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OjstrMessage\MessageBundle\Tests\Repository;

use OjstrMessage\MessageBundle\Tests\TestBase;
use OjstrMessage\MessageBundle\Entity\Folder;

class FolderManagerTest extends TestBase
{
	public function testSaveFolder()
	{
		$this->purge();
		
		$user = $this->addNewUser('bob', 'bob@foo.com', 'root');
		
		$folder = $this->addNewFolder('new folder', $user, Folder::SPECIAL_TYPE_INBOX, false, false);
		
		$folder = $this->getFolderModel()->saveFolder($folder);
		$folders = $this->getFolderModel()->findAllFoldersForUserById($user->getId());
		
		$found = false;
		foreach ($folders as $folderTest) {
			if ($folder->getId() == $folderTest->getId()) {
				$found = true;
			}
		}
		
		$this->assertTrue($found);
	}

    public function testSetupDefaults()
    {
		$this->purge();
		
		$user = $this->addNewUser('bob', 'bob@foo.com', 'root');
		$this->getFolderModel()->setupDefaults($user);
		
		$folders = $this->getFolderModel()->findAllFoldersForUserById($user->getId());
		
		$this->assertNotNull($folders);
		$this->assertCount(count(Folder::$defaultSpecialTypes), $folders);
    }
}
