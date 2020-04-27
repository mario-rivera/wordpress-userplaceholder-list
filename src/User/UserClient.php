<?php
namespace InpsydeTest\User;

class UserClient
{
    /**
     * @var string
     */
    private $url;

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
        $handle = curl_init();

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_URL, $this->url . '/users');

        $data = curl_exec($handle);
        curl_close($handle);

        return json_decode($data, true);
    }
}
