<?php

namespace App\Http\Repositories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DoctorRepository
{
    private Doctor $model;

    public function __construct(Doctor $model)
    {
        $this->model = $model;
    }

    public function getSearchQuery(int $cityId, string $search): Builder
    {
        return $this->model->query()
            ->select([
                'doctors.id',
                'doctors.name',
                DB::raw('false as is_clinic'),
                DB::raw('true as is_doctor'),
                DB::raw('false as is_service'),
            ])
            ->rightJoin('clinic_services', 'doctors.id', '=', 'clinic_services.doctor_id')
            ->where('city_id', '=', $cityId)
            ->where('name', 'ILIKE', "%$search%");
    }
}
