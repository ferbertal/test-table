<?php

namespace app\components;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Yii;
use GuzzleHttp\Client;
use yii\base\BaseObject;

class GatewayClient extends BaseObject
{
    protected string $url;
    protected array $options;
    protected Client $client;

    /**
     * @return void
     */
    public function init(): void
    {
        $this->client = new Client();
        $this->url = 'https://poligon.cloud-b.ru/api/scoreboard/';
        $this->options = [
            'auth'    => Yii::$app->params['poligonAuth'],
            'headers' => [
                'Content-Type' => 'application/xml',
            ],
        ];
    }

    /**
     * @return ResponseInterface
     * @throws Exception
     */
    public function get(): ResponseInterface
    {
        try {
            $response = $this->client->get($this->url, $this->options);
        } catch (GuzzleException $e) {
            $message = 'GatewayClient::get error: ' . $e->getMessage();
            Yii::error($message);
        }

        if (empty($response)) {
            throw new Exception('Ошибка при получении данных');
        }

        if ((200 !== $response->getStatusCode())) {
            throw new Exception('Ошибка при получении данных');
        }

        return $response;
    }
}
