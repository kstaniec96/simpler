<?php

namespace Simpler\Components\Security\Interfaces;

interface AuthTokenInterface
{
    /**
     * @param $user
     * @return string
     */
    public static function generate($user = null): string;

    /**
     * @return string
     */
    public static function refresh(): string;

    /**
     * @return void
     */
    public static function check(): void;

    /**
     * @return string|null
     */
    public static function id(): ?string;
}
