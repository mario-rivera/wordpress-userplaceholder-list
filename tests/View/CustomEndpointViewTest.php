<?php
use PHPUnit\Framework\TestCase;

use Psr\Container\ContainerInterface;
use InpsydeTest\View\CustomEndpointView;
use InpsydeTest\Util\TemplateLoader;

class CustomEndpointViewTest extends TestCase
{
    private $testInstance;

    private $containerMock;

    private $templateLoaderMock;

    public function setUp(): void
    {
        $this->containerMock = $this->createMock(ContainerInterface::class);

        $this->templateLoaderMock = $this->createMock(TemplateLoader::class);

        $this->testInstance = $this->getMockBuilder(CustomEndpointView::class)
        ->disableOriginalClone()
        ->setMethods(null)
        ->setConstructorArgs([
            $this->containerMock,
            $this->templateLoaderMock,
        ])
        ->getMock();
    }

    public function testRender()
    {
        $assetsConfig = [
            'dir' => 'test',
            'url' => 'test'
        ];

        $this->containerMock->expects($this->once())
        ->method('get')
        ->with('assets.config')
        ->willReturn($assetsConfig);

        $this->templateLoaderMock->expects($this->once())
        ->method('load')
        ->with(
            $this->isType('string'),
            $this->isType('array')
        )
        ->willReturn('template');

        $result = $this->testInstance->render(['foo' => 'bar']);

        $this->assertIsString($result);
    }
}
