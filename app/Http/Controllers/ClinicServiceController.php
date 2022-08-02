<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClinicServiceIndexRequest;
use App\Http\Services\ClinicServiceService;
use App\Models\City;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ClinicServiceController extends Controller
{
    private ClinicServiceService $service;

    public function __construct(ClinicServiceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  ClinicServiceIndexRequest  $request
     * @return Application|Factory|View
     */
    public function index(ClinicServiceIndexRequest $request): Application|Factory|View
    {
        $cityId = $request->input('city_id');
        $search = $request->input('search');
        $page = $request->input('page', 1);

        $cities = City::all();

        if ($cityId && $search) {
            $result = $this->service->search($cityId, $search, $page);
        }

        return view('welcome', [
            'paginator' => isset($result) ?
                $result->appends(request()->input())
                : [],
            'cities' => $cities,
        ]);
    }
}
