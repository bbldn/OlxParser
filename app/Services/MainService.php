<?php

namespace App\Services;

use App\Repositories\DistrictRepository;
use App\Repositories\FlatRepository;

class MainService extends Service
{
    /** @var FlatRepository $flatRepository */
    protected $flatRepository;

    /** @var DistrictRepository $districtRepository */
    protected $districtRepository;

    /**
     * MainService constructor.
     * @param FlatRepository $flatRepository
     * @param DistrictRepository $districtRepository
     */
    public function __construct(
        FlatRepository $flatRepository,
        DistrictRepository $districtRepository
    )
    {
        $this->flatRepository = $flatRepository;
        $this->districtRepository = $districtRepository;
    }

    /**
     * @param string $field
     * @return array
     */
    protected function getCountByField(string $field): array
    {
        $districts = $this->districtRepository->findAll();
        $max = -1;
        foreach ($districts as $district) {
            $arr = [];
            $flats = $this->flatRepository->getCountAndFieldAndDistrictId($field, $district->id);
            $i = 0;
            foreach ($flats as $item) {
                $arr[$item->$field] = $item->count;
                $i++;
            }
            $district->data = $arr;
            if ($i > $max) {
                $max = $i;
            }
        }

        return ['districts' => $districts, 'max' => $max];
    }

    /**
     * @param int $districtId
     * @return array
     */
    protected function getPricesByDistrictId(int $districtId): array
    {
        $result = [
            'Максимальная' => $this->flatRepository->getMaxByDistrictId($districtId),
            'Минимальная' => $this->flatRepository->getMinByDistrictId($districtId),
            'Средняя' => $this->flatRepository->getAverageByDistrictId($districtId),
            'Медианная' => $this->flatRepository->getMedianByDistrictId($districtId),
        ];

        return $result;
    }

    /**
     * @return array
     */
    public function numberOfRooms(): array
    {
        return $this->getCountByField('number_of_rooms');
    }

    /**
     * @return array
     */
    public function numberOfStoreys(): array
    {
        return $this->getCountByField('number_of_storeys');
    }

    /**
     * @return array
     */
    public function level(): array
    {
        return $this->getCountByField('level');
    }

    /**
     * @return array
     */
    public function area(): array
    {
        return $this->getCountByField('area');
    }

    /**
     * @return array
     */
    public function price(): array
    {
        $districts = $this->districtRepository->findAll();

        $result = [];
        foreach ($districts as $district) {
            $result[] = [
                'name' => $district->name,
                'data' => $this->getPricesByDistrictId($district->id),
            ];
        }

        return ['result' => $result];
    }

    /**
     * @param string|null $item
     * @return array
     */
    public function index(?string $item = null): array
    {
        switch ($item) {
            case '1':
                $src = route('numberOfRooms');
                break;
            case '2':
                $src = route('numberOfStoreys');
                break;
            case '3':
                $src = route('level');
                break;
            case '4':
                $src = route('area');
                break;
            case '5':
                $src = route('price');
                break;
            default:
                $src = route('price');
                break;
        }

        return ['src' => $src];
    }
}
