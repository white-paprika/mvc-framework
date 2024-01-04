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
}
