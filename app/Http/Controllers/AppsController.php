<?php

namespace App\Http\Controllers;

use App\App;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AppsController extends Controller
{
    /**
     * Display a listing of all apps of a tenant.
     * @return JsonResponse
     */
    public function index()
    {
        return $this->respond((new App)->newQuery()->get());
    }

    /**
     * Store a newly created app in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $attr = $this->validateAppAttr($request);

        $app = (new App)->newQuery()->create($attr);

        return $this->respond($app);
    }

    /**
     * Display the specified app.
     * @param App $app
     * @return JsonResponse
     */
    public function show(App $app)
    {
        return $this->respond($app);
    }

    /**
     * Update the specified app in storage.
     * @param Request $request
     * @param App $app
     * @return JsonResponse
     */
    public function update(Request $request, App $app)
    {
        $app->update($this->validateAppAttr($request));

        return $this->respond($app);
    }

    /**
     * Remove the specified app from storage.
     * @param App $app
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(App $app)
    {
        return $this->respond($app->delete());
    }

    /**
     * Same validation method for `store` and `update` methods.
     * @param Request $request
     * @return array
     */
    protected function validateAppAttr(Request $request): array
    {
        $config = config('canary.settings.app');

        $min = $config['name_length_min'];
        $max = $config['name_length_max'];

        /** @noinspection PhpUndefinedMethodInspection */
        return $attr = $request->validate([
            'name' => "required|min:$min|max:$max"
        ]);
    }
}
