<?php
use PHPUnit\Framework\TestCase;

use InpsydeTest\User\UserClientFactory;
use InpsydeTest\User\UserClient;
use InpsydeTest\Util\CurlWrapper;

class UserClientFactoryTest extends TestCase
{
    private $testInstance;

    public function setUp(): void
    {
        $this->testInstance = $this->getMockBuilder(UserClientFactory::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([
            $this->createMock(CurlWrapper::class)
        ])
        ->getMock();
    }

    public function testCreate()
    {
        $options = [
            'base_url' => 'http://test.io'
        ];

        $result = $this->testInstance->create($options);

        $this->assertInstanceOf(UserClient::class, $result);
    }

    public function testCreateWithInvalidArgument()
    {
        $options = [];

        $this->expectException(\InvalidArgumentException::class);
        $this->testInstance->create($options);
    }
}
