<?php
namespace InpsydeTest\User;

/**
 * NOTE: I would love to use Guzzle for example.
 * But this is a simple operation and I created this curl wrapper
 * only to make this class testable.
 */
use InpsydeTest\Util\CurlWrapper;

class UserClient
{
    /**
     * @var string
     */
    private $url;

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
     * @param string $url
     * @return self
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        $data = $this->curlWrapper->get($this->url . '/users');
        return json_decode($data, true);
    }
}
