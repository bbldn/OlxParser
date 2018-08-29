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

    /**
     * @param string $field
     * @param int $districtId
     * @return array
     */
    public function getCountAndFieldAndDistrictId(string $field, int $districtId): array
    {
        $select = DB::raw("count(*) as 'count', $field");

        return (array)DB::table($this->getTable())
            ->select($select)
            ->where('district_id', $districtId)
            ->groupBy($field)
            ->get();
    }

    /**
     * @param int $districtId
     * @return float
     */
    public function getMaxByDistrictId(int $districtId): float
    {
        return (float)DB::table($this->getTable())
            ->select(DB::raw("ifnull(max(price), 0) as 'max'"))
            ->where('district_id', $districtId)
            ->first()
            ->max;
    }

    /**
     * @param int $districtId
     * @return float
     */
    public function getMinByDistrictId(int $districtId): float
    {
        return (float)DB::table($this->getTable())
            ->select(DB::raw("ifnull(min(price), 0) as 'min'"))
            ->where('district_id', $districtId)
            ->where('price', '>', 999)
            ->first()
            ->min;
    }

    /**
     * @param int $districtId
     * @return float
     */
    public function getAverageByDistrictId(int $districtId): float
    {
        return (float)DB::table($this->getTable())
            ->select(DB::raw("ifnull(avg(price), 0) as 'avg'"))
            ->where('district_id', $districtId)
            ->where('price', '>', 999)
            ->first()
            ->avg;
    }

    /**
     * @param int $districtId
     * @return float
     */
    public function getMedianByDistrictId(int $districtId): float
    {
        $count = DB::table($this->getTable())
            ->where('district_id', $districtId)
            ->where('price', '>', 999)
            ->count();

        $offset = (int)($count / 2) - 1;

        if ($offset < 1) {
            return 0.0;
        }

        return (float)DB::table($this->getTable())
            ->select('ifnull(price, 0)')
            ->where('district_id', $districtId)
            ->where('price', '>', 999)
            ->orderBy('price', 'asc')
            ->offset($offset)
            ->limit(1)
            ->first()
            ->price;
    }
}
