<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Base controller.
 *
 * @package App\Http\Controllers
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolsaet@brightfish.be>
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Default app route, render the base blade template.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function layout()
    {
        return view('layout', [
            'appGlobals' => [],
        ]);
    }

    /**
     * Standard 200 OK json output.
     * @param mixed $data
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public static function respond($data = [], int $status = 200, array $headers = []): JsonResponse
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        if ($data instanceof Model) {
            $data = $data->toArray();
        }

        $data = [
            'status' => $status,
            'data' => $data,
            'error' => null,
        ];

        return (new JsonResponse($data, $status, $headers))
            ->setEncodingOptions(static::getJsonEncodingOptions());
    }

    /**
     * Standard json output with error(s).
     * @param mixed $error
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    public static function respondWithError($error, int $status = 500, array $headers = []): JsonResponse
    {
        if (is_string($error)) {
            $error = ['message' => $error];
        }

        $data = [
            'status' => $status,
            'data' => null,
            'error' => $error,
        ];

        return (new JsonResponse($data, $status, $headers))
            ->setEncodingOptions(static::getJsonEncodingOptions());
    }

    /**
     * Health check endpoint method.
     * @return Response
     */
    public function health(): Response
    {
        return new Response('OK', 200, ['Content-Type' => 'text/plain']);
    }

    /**
     * Api fallback route.
     * @return Response
     */
    public function api404(): Response
    {
        return $this->respondWithError('This route does not exist.', 404);
    }

    /**
     * Set the JSON encoding based on the current env.
     * @return int
     */
    protected static function getJsonEncodingOptions(): int
    {
        return app()->environment('production')
            ? JSON_UNESCAPED_SLASHES
            : JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES;
    }
}
