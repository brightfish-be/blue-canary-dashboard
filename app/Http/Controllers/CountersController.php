<?php

namespace App\Http\Controllers;

use App\App;
use App\Counter;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountersController extends Controller
{
    /**
     * Display a listing of all counters of an app.
     * @param App $app
     * @return JsonResponse
     */
    public function index(App $app)
    {
        return $this->respond((new Counter)->newQuery()->where('app_id', $app->id)->get());
    }

    /**
     * Store a newly created counter in storage.
     * @param Request $request
     * @param App $app
     * @return JsonResponse
     */
    public function store(Request $request, App $app)
    {
        $attr = $this->validateCounterAttr($request);

        $counter = new Counter($attr);

        $counter->app_id = $app->id;

        $counter->save();

        return $this->respond($counter);
    }

    /**
     * Display the specified counter.
     * @param App $app
     * @param Counter $counter
     * @return JsonResponse
     */
    public function show(App $app, Counter $counter)
    {
        return $this->respond($counter);
    }

    /**
     * Update the specified counter in storage.
     * @param Request $request
     * @param App $app
     * @param Counter $counter
     * @return JsonResponse
     */
    public function update(Request $request, App $app, Counter $counter)
    {
        $counter->update($this->validateCounterAttr($request));

        return $this->respond($counter);
    }

    /**
     * Remove the specified counter from storage.
     * @param App $app
     * @param Counter $counter
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(App $app, Counter $counter)
    {
        return $this->respond($counter->delete());
    }

    /**
     * Same validation method for `store` and `update` methods.
     * @param Request $request
     * @return array
     */
    protected function validateCounterAttr(Request $request): array
    {
        $nameRegex = config('canary.settings.counter.name_validation');

        /** @noinspection PhpUndefinedMethodInspection */
        return $attr = $request->validate([
            'name' => "required|regex:/^$nameRegex$/i"
        ]);
    }
}
