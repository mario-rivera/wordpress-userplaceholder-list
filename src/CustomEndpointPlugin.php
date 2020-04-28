<?php
namespace InpsydeTest;

use Psr\Container\ContainerInterface;
use WP;

class CustomEndpointPlugin
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Util\Emitter
     */
    private $emitter;

    /**
     * @var Util\RouteExtractor
     */
    private $routeExtractor;

    public function __construct(
        ContainerInterface $container,
        Util\Emitter $emitter,
        Util\RouteExtractor $routeExtractor
    ) {
        $this->container = $container;
        $this->emitter = $emitter;
        $this->routeExtractor = $routeExtractor;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        add_action('parse_request', [$this, 'onRequest']);
    }

    /**
     * @param WP $wp
     * @return void
     */
    public function onRequest(WP $wp): void
    {
        try {
            $route = $this->routeExtractor->getRoute($wp);

            switch ($route) {
                case 'inpsyde-test':
                    $handler = $this->container->get(EndpointHandler\TestEndpointHandler::class);
                    $response = $handler->handle();

                    $this->emitter->emit($response);
                    break;
            }
        } catch(\Throwable $e) {
            $errorHandler = $this->container->get(ErrorHandler\GenericErrorHandler::class);
            $errorHandler->handleError($e);
        }
    }
}
