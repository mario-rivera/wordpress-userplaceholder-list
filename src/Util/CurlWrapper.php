<?php
namespace InpsydeTest\Util;

class CurlWrapper
{
    /**
     * @param string $url
     * @return string|null
     */
    public function get(string $url): ?string
    {
        $handle = curl_init();

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_URL, $url);

        $data = curl_exec($handle);
        curl_close($handle);

        return $data;
    }
}
