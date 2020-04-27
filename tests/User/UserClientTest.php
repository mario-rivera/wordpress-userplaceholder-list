<?php
use PHPUnit\Framework\TestCase;

use InpsydeTest\User\UserClient;
use InpsydeTest\Util\CurlWrapper;

class UserClientTest extends TestCase
{
    private $testInstance;

    private $curlWrapperMock;

    public function setUp(): void
    {
        $this->curlWrapperMock = $this->createMock(CurlWrapper::class);

        $this->testInstance = $this->getMockBuilder(UserClient::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([
            $this->curlWrapperMock
        ])
        ->getMock();
    }

    public function testGetUsers()
    {
        $url = 'http://test.io';

        $this->testInstance->setUrl($url);

        $this->curlWrapperMock->expects($this->once())
        ->method('get')
        ->with($url . '/users')
        ->willReturn(json_encode([
            'foo' => 'bar',
            'baz' => 'bat'
        ]));

        $result = $this->testInstance->getUsers();

        $this->assertIsArray($result);
    }
}
