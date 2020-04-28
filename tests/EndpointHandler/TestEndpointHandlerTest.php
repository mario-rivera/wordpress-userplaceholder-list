<?php
use PHPUnit\Framework\TestCase;

use InpsydeTest\EndpointHandler\TestEndpointHandler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use InpsydeTest\User\UserRepository;
use InpsydeTest\View\CustomEndpointView;

class TestEndpointHandlerTest extends TestCase
{
    private $testInstance;

    private $responseMock;

    private $userRepositoryMock;

    private $customEndpointViewMock;

    public function setUp(): void
    {
        $this->responseMock = $this->createMock(ResponseInterface::class);
        
        $this->userRepositoryMock = $this->createMock(UserRepository::class);

        $this->customEndpointViewMock = $this->createMock(CustomEndpointView::class);

        $this->testInstance = $this->getMockBuilder(TestEndpointHandler::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([
            $this->responseMock,
            $this->userRepositoryMock,
            $this->customEndpointViewMock
        ])
        ->getMock();
    }

    public function testHandle()
    {
        $users = [
            ['id' => 'foo'],
            ['id' => 'bar']
        ];

        $responseBodyMock = $this->createMock(StreamInterface::class);

        $this->userRepositoryMock->expects($this->once())
        ->method('getUsers')
        ->willReturn($users);

        $this->customEndpointViewMock->expects($this->once())
        ->method('render')
        ->willReturn('string');

        $this->responseMock->expects($this->once())
        ->method('getBody')
        ->willReturn($responseBodyMock);

        $responseBodyMock->expects($this->once())
        ->method('write')
        ->with('string');

        $result = $this->testInstance->handle();

        $this->assertInstanceOf(ResponseInterface::class, $result);
    }
}
