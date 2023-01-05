<?php

namespace FortniteApi;

use FortniteApi\Components\Endpoints\CosmeticsEndpoint;
use FortniteApi\Components\Endpoints\CreatorCodeEndpoint;
use FortniteApi\Components\Endpoints\NewsEndpoint;
use FortniteApi\Components\Endpoints\ShopEndpoint;

use GuzzleHttp\Client;

/**
 * Provides access to https://fortnite-api.com
 */
class FortniteApi
{
    private Client $client;
    public CosmeticsEndpoint $cosmetics;
    public ShopEndpoint $shop;
    public NewsEndpoint $news;
    public CreatorCodeEndpoint $creatorCode;

    public function __construct(
        private readonly ?string $apiKey = '',
    )
    {
        $this->client = new Client([
            'base_uri' => self::getBaseUri(),
            'allow_redirects' => true,
            'connect_timeout' => 30,
            'timeout' => 30,
            'headers' => [
                'x-api-key' => $this->apiKey
            ],
        ]);

        $this->cosmetics = new CosmeticsEndpoint($this->client);
        $this->shop = new ShopEndpoint($this->client);
        $this->news = new NewsEndpoint($this->client);
        $this->creatorCode = new CreatorCodeEndpoint($this->client);
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * Returns the base uri all requests use.
     *
     * @return string
     */
    public static function getBaseUri(): string
    {
        return "https://fortnite-api.com";
    }

    /**
     * Returns all supported languages that can be used with this api.
     */
    public static function getSupportedLanguages(): array
    {
        return [
            "ar",
            "de",
            "en",
            "es",
            "es-419",
            "fr",
            "it",
            "ja",
            "ko",
            "pl",
            "pt-BR",
            "ru",
            "tr",
            "zh-CN",
            "zh-Hant"
        ];
    }
}
