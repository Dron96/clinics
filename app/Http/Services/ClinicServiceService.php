<?php

namespace App\Http\Services;

use App\Http\Repositories\ClinicServiceRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClinicServiceService
{
    private ClinicServiceRepository $repository;

    public function __construct(ClinicServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search(int $cityId, string $search, int $page): LengthAwarePaginator
    {
        $result = $this->repository->search($cityId, $search, $page);

        return $result;
    }
}
