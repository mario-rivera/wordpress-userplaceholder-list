<?php
namespace InpsydeTest\ErrorHandler;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use InpsydeTest\Util\Emitter;
use InpsydeTest\Util\TemplateLoader;

use Throwable;

class GenericErrorHandler
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Emitter
     */
    private $emitter;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var TemplateLoader
     */
    private $templateLoader;

    public function __construct(
        ContainerInterface $container,
        ResponseInterface $response,
        Emitter $emitter,
        TemplateLoader $templateLoader
    ) {
        $this->container = $container;
        $this->emitter = $emitter;
        $this->response = $response;
        $this->templateLoader = $templateLoader;
    }

    public function handleError(Throwable $e)
    {
        $config = $this->container->get('assets.config');
        $template = "{$config['dir']}/templates/errors.html";

        $content = $this->templateLoader->load($template, ['e' => $e]);

        $this->response->getBody()->write($content);
        $this->emitter->emit($this->response);
    }
}
