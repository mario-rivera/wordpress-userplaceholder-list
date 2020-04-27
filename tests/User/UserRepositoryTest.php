<?php
use PHPUnit\Framework\TestCase;

use InpsydeTest\User\UserClient;
use InpsydeTest\User\UserRepository;

class UserRepositoryTest extends TestCase
{
    private $testInstance;

    private $userClientMock;

    public function setUp(): void
    {
        $this->userClientMock = $this->createMock(UserClient::class);

        $this->testInstance = $this->getMockBuilder(UserRepository::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([
            $this->userClientMock
        ])
        ->getMock();
    }

    public function testGetUsers()
    {
        $this->userClientMock->expects($this->once())
        ->method('getUsers')
        ->willReturn([
            'foo' => 'bar',
            'baz' => 'bat'
        ]);

        $result = $this->testInstance->getUsers();

        $this->assertIsArray($result);
    }
}
