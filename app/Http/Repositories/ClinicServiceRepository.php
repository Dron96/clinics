<?php

namespace App\Http\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClinicServiceRepository
{
    private ClinicRepository $clinicRepository;
    private DoctorRepository $doctorRepository;
    private ServiceRepository $serviceRepository;

    public function __construct(
        ClinicRepository $clinicRepository,
        DoctorRepository $doctorRepository,
        ServiceRepository $serviceRepository,
    )
    {
        $this->clinicRepository = $clinicRepository;
        $this->doctorRepository = $doctorRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function search(int $cityId, string $search, int $page): LengthAwarePaginator
    {
        $clinicsQuery = $this->clinicRepository->getSearchQuery($cityId, $search);
        $doctorQuery = $this->doctorRepository->getSearchQuery($cityId, $search);
        $serviceQuery = $this->serviceRepository->getSearchQuery($cityId, $search);

        $query = $clinicsQuery
            ->union($doctorQuery->toBase())
            ->union($serviceQuery->toBase())
            ->orderBy('name');

        return $query->paginate(50, page: $page);
    }
}
