<?php

declare(strict_types=1);

namespace App\Module1;

class AuthorizationService
{
    private TokenGenerator $tokenGenerator;
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository, TokenGenerator $tokenGenerator)
    {
        $this->clientRepository = $clientRepository;
        $this->tokenGenerator = $tokenGenerator;
    }

    public function authorize(string $clientId, string $clientSecret): AuthorizationToken
    {
        $client = $this->clientRepository->findClientById($clientId);

        if ($client->clientSecret() !== $clientSecret) {
            throw FailedToAuthorizeClient::becauseClientSecretIsInvalid($clientId);
        }

        $token = $this->tokenGenerator->generate();

        return new AuthorizationToken($clientId, $token);
    }
}
