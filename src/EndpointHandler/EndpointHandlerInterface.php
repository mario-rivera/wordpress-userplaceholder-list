<?php
namespace InpsydeTest\EndpointHandler;

interface EndpointHandlerInterface
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(): \Psr\Http\Message\ResponseInterface;
}
