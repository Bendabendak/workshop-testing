<?php declare(strict_types=1);

namespace IW\Workshop\Client;

/**
 * Simple abstraction for cURL
 */
class Curl
{
    /**
     * Send post request to the provided URL
     *
     * @param string $url      Request URL
     * @param array  $postBody Post body
     * @param array  $options  Request options at this moment just content-type is supported.
     *
     * @return array Response in format [response code, response body]
     */
    public function post(string $url, string $postBody, array $options=[]) : array
    {
        $curlHandle = curl_init($url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $postBody);

        if (array_key_exists('content-type', $options)) {
            curl_setopt(
                $curlHandle,
                CURLOPT_HTTPHEADER,
                [
                    'Content-Type:'.$options['content-type']
                ]
            );
        }

        $httpBody = curl_exec($curlHandle);
        $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);

        curl_close($curlHandle);

        return [$httpCode, $httpBody];
    }
}
