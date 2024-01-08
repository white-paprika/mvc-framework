<?php

use app\core\StringHelper;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{
    public function testGetBefore()
    {
        $stringHelper = new StringHelper;
        $this->assertEquals('Hello, my dear friend!', $stringHelper->getBefore('Hello, my dear friend!', 'Milk'));
        $this->assertEquals('', $stringHelper->getBefore('Hello, my dear friend!', 'H'));
        $this->assertEquals('Hello, my dear friend', $stringHelper->getBefore('Hello, my dear friend!', '!'));
        $this->assertEquals('Hello, m', $stringHelper->getBefore('Hello, my dear friend!', 'y'));
        $this->assertEquals('Hello, m', $stringHelper->getBefore('Hello, my dear friend!', 'y dear'));
        $this->assertEquals('Hello,', $stringHelper->getBefore('Hello, my dear friend!', ' '));
    }

    public function testGetBetween()
    {
        $stringHelper = new StringHelper;
        $this->assertEquals('_text_', $stringHelper->getBetween('sometextbefore_@open-tag_text_@close-tag_sometextafter', '@open-tag', '@close-tag'));
        $this->assertEquals('', $stringHelper->getBetween('sometextbefore_@open-tag@close-tag_sometextafter', '@open-tag', '@close-tag'));
        $this->assertEquals('', $stringHelper->getBetween('sometextbefore_@open-tag_text_@close-tag_sometextafter', '@NOTopen-tag', '@NOTclose-tag'));
    }
}
