<?php

namespace Simpler\Components\Http\Routers\Interfaces;

interface ViewInterface
{
    /**
     * @return void
     */
    public static function init(): void;

    /**
     * @param string $view
     * @param array $params
     * @return void
     */
    public static function render(string $view, array $params = []): string;

    /**
     * @param string $view
     * @param string $blockName
     * @param array $params
     * @return string
     */
    public static function renderBlock(string $view, string $blockName, array $params = []): string;
}
