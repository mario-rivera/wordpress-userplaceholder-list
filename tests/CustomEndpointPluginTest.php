<?php
use PHPUnit\Framework\TestCase;

use Psr\Container\ContainerInterface;
use InpsydeTest\Util\Emitter;

use InpsydeTest\CustomEndpointPlugin;
use InpsydeTest\Util\RouteExtractor;
use InpsydeTest\EndpointHandler\TestEndpointHandler;
use Psr\Http\Message\ResponseInterface;

class CustomEndpointPluginTest extends TestCase
{
    private $testInstance;

    private $containerMock;

    private $emitterMock;

    private $routeExtractorMock;

    public function setUp(): void
    {
        $this->containerMock = $this->createMock(ContainerInterface::class);

        $this->emitterMock = $this->createMock(Emitter::class);

        $this->routeExtractorMock = $this->createMock(RouteExtractor::class);

        $this->testInstance = $this->getMockBuilder(CustomEndpointPlugin::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([
            $this->containerMock,
            $this->emitterMock,
            $this->routeExtractorMock
        ])
        ->getMock();

    }

    public function testOnRequest()
    {
        $wpMock = $this->createMock(WP::class);
        $responsemock = $this->createMock(ResponseInterface::class);
        $handlerMock = $this->createMock(TestEndpointHandler::class);

        $this->routeExtractorMock->expects($this->once())
        ->method('getRoute')
        ->with($wpMock)
        ->willReturn('inpsyde-test');

        $handlerMock->expects($this->once())
        ->method('handle')
        ->willReturn($responsemock);

        $this->containerMock->expects($this->once())
        ->method('get')
        ->with(InpsydeTest\EndpointHandler\TestEndpointHandler::class)
        ->willReturn($handlerMock);

        $this->emitterMock->expects($this->once())
        ->method('emit')
        ->with($responsemock);

        $this->testInstance->onRequest($wpMock);
    }
}
