<?php
namespace InpsydeTest\User;

use InpsydeTest\Util\CurlWrapper;

class UserClientFactory
{
    /**
     * @var CurlWrapper
     */
    private $curlWrapper;

    public function __construct(
        CurlWrapper $curlWrapper
    ) {
        $this->curlWrapper = $curlWrapper;
    }

    /**
     * @param array $options
     * @return UserClient
     */
    public function create(array $options = [])
    {
        if (!isset($options['base_url'])) {
            throw new \InvalidArgumentException("Base url option is required.");
        }

        $parsed_url = parse_url($options['base_url']);
        $url = $parsed_url['scheme'] . '://' . $parsed_url['host'];

        $client = (new UserClient($this->curlWrapper))->setUrl($url);

        return $client;
    }
}
