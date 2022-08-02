<?php

namespace App\Http\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ServiceRepository
{
    private Service $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    public function getSearchQuery(int $cityId, string $search): Builder
    {
        return $this->model->query()
            ->select([
                'services.id',
                'services.name',
                DB::raw('false as is_clinic'),
                DB::raw('false as is_doctor'),
                DB::raw('true as is_service'),
            ])
            ->rightJoin('clinic_services', 'services.id', '=', 'clinic_services.service_id')
            ->where('city_id', '=', $cityId)
            ->where('name', 'ILIKE', "%$search%");
    }
}
