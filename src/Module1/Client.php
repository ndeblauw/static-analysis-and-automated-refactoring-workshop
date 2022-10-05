<?php

declare(strict_types=1);

namespace App\Module1;

class Client
{
    private string $apiKey;

    public function __construct(?string $apiKey)
    {
        if($apiKey === null) {
            throw new \InvalidArgumentException('...');
        };

        $this->apiKey = $apiKey;
    }

    public function clientSecret(): string
    {
        return $this->apiKey;
    }
}
