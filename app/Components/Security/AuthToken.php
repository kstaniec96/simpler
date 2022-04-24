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
use Simpler\Components\Security\Interfaces\AuthTokenInterface;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthToken implements AuthTokenInterface
{
    /** @var string|null */
    private static ?string $id = null;

    /**
     * Generate authorization token.
     *
     * @param $user
     * @return string
     */
    public static function generate($user = null): string
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

            return JWT::encode($data, env('JWT_SECRET_KEY'), env('JWT_ALGORITHM'));
        } catch (Exception $e) {
            throw new ResponseException($e->getMessage());
        }
    }

    /**
     * Refresh authorization token.
     *
     * @return string
     */
    public static function refresh(): string
    {
        try {
            return self::generate((object)['id' => self::id()]);
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

        $jwt = JWT::decode($jwt, new Key(env('JWT_SECRET_KEY'), env('JWT_ALGORITHM')));

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
}
