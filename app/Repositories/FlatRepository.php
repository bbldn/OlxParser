<?php

namespace App\Repositories;

use App\Flat;
use Illuminate\Support\Facades\DB;

class FlatRepository extends Repository
{
    /**
     * FlatRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(Flat::class);
    }

    /**
     * @param string $flatId
     * @param string $descriptionHash
     * @return Flat|null
     */
    public function findOneByFlatIdOrDescriptionHash(?string $flatId, string $descriptionHash): ?Flat
    {
        if (null !== $flatId) {
            /** @noinspection PhpUndefinedMethodInspection */
            return $this->className::where('flat_id', $flatId)->orWhere('description_hash', $descriptionHash)->first();
        }

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->className::orWhere('description_hash', $descriptionHash)->first();
    }
}
