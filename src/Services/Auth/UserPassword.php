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
        $username = $body['username'];
        $params = [
            'body' => json_encode($body)
        ];

        return $this->client->post('/v1/auth/userpass/users/'.$username, $params);
    }


    /**
     * Update the password for an existing user
     *
     * @see      https://www.vaultproject.io/docs/auth/userpass.html
     * @param array $body
     * @return mixed
     * @internal param string $username
     */
    public function update(array $body = [])
    {
        $body = OptionsResolver::resolve($body, [
            'username', 'password'
        ]);
        $username = $body['username'];
        $params = [
            'body' => json_encode($body)
        ];

        return $this->client->post('/v1/auth/userpass/users/'.$username, $params);
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
     * login with existing user
     *
     * @see    https://www.vaultproject.io/docs/auth/userpass.html
     * @param  string $username
     * @param  string $password
     * @return mixed
     */
    public function loginUser($username, $password)
    {
        $params = [
            'body'=> json_encode(["password" => $password])
        ];
        return $this->client->post('/v1/auth/userpass/login/' . $username , $params );
    }
}
