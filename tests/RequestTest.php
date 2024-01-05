<?php
use app\core\request\AppRequest;
use app\core\StringHelper;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testGetPath()
    {
        $request = new AppRequest(new StringHelper);

        $_SERVER['REQUEST_URI'] = null;
        $this->assertEquals('/', $request->getPath());

        $_SERVER['REQUEST_URI'] = '';
        $this->assertEquals('/', $request->getPath());
        
        $_SERVER['REQUEST_URI'] = '/';
        $this->assertEquals('/', $request->getPath());

        $_SERVER['REQUEST_URI'] = '/user/posts';
        $this->assertEquals('/user/posts', $request->getPath());

        $_SERVER['REQUEST_URI'] = '/user/posts?id=1';
        $this->assertEquals('/user/posts', $request->getPath());

        $_SERVER['REQUEST_URI'] = '/user/posts?status=avaliable&name=%test%';
        $this->assertEquals('/user/posts', $request->getPath());
    }

    public function testGetMethod()
    {
        $request = new AppRequest(new StringHelper);

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->assertEquals('get', $request->getMethod());

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertEquals('post', $request->getMethod());
    }
}
