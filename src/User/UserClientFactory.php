<?php
namespace InpsydeTest\User;

class UserClientFactory
{
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

        $client = (new UserClient)->setUrl($url);

        return $client;
    }
}
