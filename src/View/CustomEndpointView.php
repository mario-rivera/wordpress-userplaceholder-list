<?php
namespace InpsydeTest\View;

use Psr\Container\ContainerInterface;

class CustomEndpointView
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(
        ContainerInterface $container
    ) {
        $this->container = $container;
    }

    /**
     * @param array $data
     * @return string|null
     */
    public function render(array $data = []): ?string
    {
        $config = $this->container->get('assets.config');
        $template = "{$config['dir']}/templates/users.html";
        $data['assets_url'] = $config['url'];

        $output = null;

        if (file_exists($template)) {
            ob_start();
            require_once($template);
            $output = ob_get_contents();
            ob_end_clean();
        }

        return $output;
    }
}
