<?php

namespace YourName\GreenApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class GreenApiService
{
    protected string $host;
    protected string $idInstance;
    protected string $apiTokenInstance;
    protected Client $httpClient;

    public function __construct(array $config)
    {
        $this->host = rtrim($config['host'], '/');
        $this->idInstance = $config['id_instance'];
        $this->apiTokenInstance = $config['api_token_instance'];

        // Initialize Guzzle with a base URI to keep requests clean
        $this->httpClient = new Client([
            'base_uri' => "{$this->host}/waInstance{$this->idInstance}/",
            'timeout'  => 30.0,
        ]);
    }

    /**
     * Send a basic text message.
     * * @param string $chatId (e.g., "123456789@c.us")
     * @param string $message
     * @return array
     */
    public function sendMessage(string $chatId, string $message): array
    {
        return $this->request('POST', 'sendMessage', [
            'json' => [
                'chatId' => $chatId,
                'message' => $message,
            ],
        ]);
    }

    /**
     * Send a file via a public URL.
     * * @param string $chatId
     * @param string $urlFile
     * @param string $fileName
     * @param string $caption
     * @return array
     */
    public function sendFileByUrl(string $chatId, string $urlFile, string $fileName, string $caption = ''): array
    {
        return $this->request('POST', 'sendFileByUrl', [
            'json' => [
                'chatId' => $chatId,
                'urlFile' => $urlFile,
                'fileName' => $fileName,
                'caption' => $caption,
            ],
        ]);
    }

    /**
     * Internal helper to handle all API requests.
     */
    protected function request(string $method, string $uri, array $options = []): array
    {
        try {
            // The Green API requires the token at the end of the URI
            $endpoint = "{$uri}/{$this->apiTokenInstance}";
            
            $response = $this->httpClient->request($method, $endpoint, $options);
            
            return json_decode($response->getBody()->getContents(), true) ?? [];
            
        } catch (GuzzleException $e) {
            // In a real package, you might want to throw a custom GreenApiException
            throw new Exception("Green API Request Failed: " . $e->getMessage());
        }
    }
}