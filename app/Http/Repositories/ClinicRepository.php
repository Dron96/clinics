<?php

namespace App\Http\Repositories;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ClinicRepository
{
    private Clinic $model;

    public function __construct(Clinic $model)
    {
        $this->model = $model;
    }

    public function getSearchQuery(int $cityId, string $search): Builder
    {
        return $this->model->query()
            ->select([
                'clinics.id',
                'clinics.name',
                DB::raw('true as is_clinic'),
                DB::raw('false as is_doctor'),
                DB::raw('false as is_service'),
            ])
            ->rightJoin('clinic_services', 'clinics.id', '=', 'clinic_services.clinic_id')
            ->where('city_id', '=', $cityId)
            ->where('name', 'ILIKE', "%$search%");
    }
}
