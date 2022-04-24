<?php
/**
 * Auth Token operations.
 *
 * @package Simpler
 * @subpackage Security
 * @version 2.0
 */

namespace Simpler\Components\Security;

use Simpler\Components\Config;
use Simpler\Components\DateTime;
use Simpler\Components\Exceptions\AuthException;
use Simpler\Components\Exceptions\ResponseException;
use Simpler\Components\Facades\File;
use Simpler\Components\Security\Interfaces\AuthTokenInterface;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthToken implements AuthTokenInterface
{
    /** @var string|null */
    private static ?string $id = null;

    /** @var string */
    private static string $token;

    /** @var int */
    private static int $expire;

    /** @var string */
    private const ALGORITHM = 'HS512';

    /**
     * Generate authorization token.
     *
     * @param $user
     * @return AuthToken
     */
    public static function generate($user = null): AuthToken
    {
        try {
            $expire = DateTime::calc('now', Config::get('session.lifetime'), 'minutes')->getTimestamp();

            $data = [
                'iat' => now()->getTimestamp(),
                'iss' => url()->domain(),
                'nbf' => now()->getTimestamp(),
                'exp' => $expire,
                'id' => $user->id ?? null,
            ];

            self::$token = JWT::encode($data, self::getSecretString(), self::ALGORITHM);
            self::$expire = $expire;

            return (new self());
        } catch (Exception $e) {
            throw new ResponseException($e->getMessage());
        }
    }

    /**
     * Refresh authorization token.
     *
     * @return AuthToken
     */
    public static function refresh(): AuthToken
    {
        try {
            self::generate((object)['id' => self::id()]);

            return (new self());
        } catch (Exception $e) {
            throw new ResponseException($e->getMessage());
        }
    }

    /**
     * Check authorization token.
     *
     * @return void
     */
    public static function check(): void
    {
        $auth = response()->getHeader('Authorization') ?? '';

        if (!preg_match('/Bearer\s(\S+)/', $auth, $matches)) {
            throw new AuthException();
        }

        $jwt = $matches[1];

        if (!$jwt) {
            throw new AuthException('No token was able to be extracted from the authorization header');
        }

        $jwt = JWT::decode($jwt, new Key(self::getSecretString(), self::ALGORITHM));

        if (
            $jwt->iss !== url()->domain() ||
            $jwt->nbf > now()->getTimestamp() ||
            $jwt->exp < now()->getTimestamp()
        ) {
            throw new AuthException();
        }

        self::$id = $jwt->id;
    }

    /**
     * Get logged user id.
     *
     * @return string|null
     */
    public static function id(): ?string
    {
        return self::$id;
    }

    /**
     * Get generated JWT token.
     *
     * @return string
     */
    public function token(): string
    {
        return self::$token;
    }

    /**
     * Get expire generated JWT token.
     *
     * @return int
     */
    public function expire(): int
    {
        return self::$expire;
    }

    /**
     * Get secret JWT string.
     *
     * @return string
     */
    private static function getSecretString(): string
    {
        return File::content(storagePath('jwt-secret.key'));
    }
}
