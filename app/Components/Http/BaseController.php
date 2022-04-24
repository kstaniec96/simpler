<?php
/**
 * This class for Controllers.
 *
 * @package Simpler
 * @version 2.0
 */

namespace Simpler\Components\Http;

use Simpler\Components\Enums\HttpStatus;
use Simpler\Components\Http\Routers\View;
use Simpler\Components\Interfaces\BaseControllerInterface;

abstract class BaseController implements BaseControllerInterface
{
    /**
     * Render view template.
     *
     * @param string $view
     * @param array $params
     * @return void
     */
    public function render(string $view, array $params = []): string
    {
        return View::render($view, $params);
    }

    /**
     * Render block template.
     *
     * @param string $view
     * @param string $blockName
     * @param array $params
     * @return void
     */
    public function renderBlock(string $view, string $blockName, array $params = []): string
    {
        return View::renderBlock($view, $blockName, $params);
    }

    /**
     * Success json response
     *
     * @param mixed $data
     * @param int $status
     * @return string
     */
    public function success($data = null, int $status = HttpStatus::OK): string
    {
        return response()->json($data, $status);
    }

    /**
     * Error json response
     *
     * @param mixed $data
     * @param int $status
     * @return string
     */
    public function error($data = null, int $status = HttpStatus::UNPROCESSABLE_ENTITY): string
    {
        return response()->json($data, $status);
    }
}
