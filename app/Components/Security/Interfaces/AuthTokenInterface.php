<?php

namespace Simpler\Components\Security\Interfaces;

use Simpler\Components\Security\AuthToken;

interface AuthTokenInterface
{
    /**
     * @param $user
     * @return AuthToken
     */
    public static function generate($user = null): AuthToken;

    /**
     * @return AuthToken
     */
    public static function refresh(): AuthToken;

    /**
     * @return void
     */
    public static function check(): void;

    /**
     * @return string|null
     */
    public static function id(): ?string;

    /**
     * @return string
     */
    public function token(): string;

    /**
     * @return int
     */
    public function expire(): int;
}
