<?php
namespace Codific\Vault\Services\Auth;

use Codific\Vault\Client;
use Codific\Vault\OptionsResolver;

/**
 * This service class handle all Vault HTTP API endpoints starting in /auth/token
 *
 */
class AuthenticationAbstraction
{
    /**
     * Client instance
     *
     * @var Client
     */
    private $client;

    /**
     * Create a new Sys service with an optional Client
     *
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

}
