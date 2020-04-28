<?php
use PHPUnit\Framework\TestCase;

use InpsydeTest\Util\RouteExtractor;

class RouteExtractorTest extends TestCase
{
    private $testInstance;

    private $wpMock;

    public function setUp(): void
    {
        $this->wpMock = $this->createMock(WP::class);

        $this->testInstance = $this->getMockBuilder(RouteExtractor::class)
        ->disableOriginalConstructor()
        ->disableOriginalClone()
        ->setMethods(null)
        ->getMock();
    }

    public function testGetRouteNoPermalinks()
    {
        $this->wpMock->did_permalink = false;
        $this->wpMock->query_vars['pagename'] = '/test';

        $result = $this->testInstance->getRoute($this->wpMock);

        $this->assertEquals('test', $result);
    }

    public function testGetRouteWithPermalinks()
    {
        $this->wpMock->did_permalink = true;
        $this->wpMock->request = '/test';

        $result = $this->testInstance->getRoute($this->wpMock);

        $this->assertEquals('test', $result);
    }

    public function testGetRouteReturnNull()
    {
        $this->wpMock->query_vars['pagename'] = null;

        $result = $this->testInstance->getRoute($this->wpMock);
        $this->assertEquals(null, $result);
    }
}
