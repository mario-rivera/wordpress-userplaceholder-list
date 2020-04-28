<?php
namespace InpsydeTest\View;

use Psr\Container\ContainerInterface;
use InpsydeTest\Util\TemplateLoader;

class CustomEndpointView
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var TemplateLoader
     */
    private $templateLoader;

    public function __construct(
        ContainerInterface $container,
        TemplateLoader $templateLoader
    ) {
        $this->container = $container;
        $this->templateLoader = $templateLoader;
    }

    /**
     * @param array $data
     * @return string|null
     */
    public function render(array $data = []): ?string
    {
        $config = $this->container->get('assets.config');
        $data['assets_url'] = $config['url'];

        $output = $this->templateLoader->load("{$config['dir']}/templates/users.html", $data);

        return $output;
    }
}
