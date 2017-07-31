<?php
namespace Codific\Vault\Services\Auth;

use Codific\Vault\Client;
use Codific\Vault\OptionsResolver;

/**
 * This service class handle all Vault HTTP API endpoints starting in /auth/token
 *
 */
class UserPassword extends AuthenticationAbstraction
{

    /**
     * Creates a new user with credentials.
     *
     * @see    https://www.vaultproject.io/docs/auth/userpass.html
     * @param  array  $body
     * @return mixed
     */
    public function create(array $body = [])
    {
        $body = OptionsResolver::resolve($body, [
                'username', 'password', 'policies', 'ttl','max_ttl'
        ]);

        $params = [
                'body' => json_encode($body)
        ];

        return $this->client->post('/v1/auth/userpass/users', $params);
    }

    /**
     * Returns the properties of an existing username.
     *
     * @see    https://www.vaultproject.io/docs/auth/userpass.html
     * @param  string $username
     * @return mixed
     */
    public function lookup($username)
    {
        return $this->client->get('/v1/auth/userpass/users/' . $username);
    }

    /**
     * Deletes single user from vault based on username
     *
     * @see    https://www.vaultproject.io/docs/auth/userpass.html
     * @param  string $username
     * @return mixed
     */
    public function deleteUser($username)
    {
        return $this->client->delete('/v1/auth/userpass/users/' . $username);
    }
    
    /**
     * Update the password for an existig user
     *
     * @see    https://www.vaultproject.io/docs/auth/userpass.html
     * @param  string $username
     * @return mixed
     */
    public function deleteUser($username, $password)
    {
        return $this->client->post('/v1/auth/userpass/users/' . $username . "/" . $password);
    }
    
    /**
     * Update the password for an existig user
     *
     * @see    https://www.vaultproject.io/docs/auth/userpass.html
     * @param  string $username
     * @return mixed
     */
    public function loginUser($username, $password)
    {
        $parameters = [ "passsword" => $password ];
        return $this->client->post('/v1/auth/userpass/login/' . $username , $parameters );
    }
}
