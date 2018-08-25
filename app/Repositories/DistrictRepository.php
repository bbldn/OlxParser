<?php

namespace App\Repositories;

use App\District;
use Illuminate\Support\Collection;

/**
 * @method District|null find(int $id)
 * @method Collection|District[] findAll()
 */
class DistrictRepository extends Repository
{
    /**
     * DistrictRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(District::class);
    }
}
