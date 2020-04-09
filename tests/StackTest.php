<?php
use PHPUnit\Framework\TestCase;
use Diva\Core\Config;

class StackTest extends TestCase
{
    
    public function testPushAndPop()
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }

    public function testReadConfig()
    {
        $con = new Config();
        $this->assertEquals($con->get('log'), "/var/log/bookstore.log");
        //$this->assertEquals($con->get('db')['password'], "vuanh123");
    }

    public function testAppConfig()
    {
        $con = new Config();
        //$this->assertEquals($con->get('log'), "/var/log/bookstore.log");
        $this->assertEquals($con->get('db')['password'], "vuanh123");
    }

   
}
