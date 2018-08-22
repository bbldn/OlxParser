<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property string flat_id
 * @property string description_hash
 * @property int number_of_storeys
 * @property int level
 * @property int area
 * @property int number_of_rooms
 * @property int price
 * @property int district_id
 * @property District|null district
 * @method static Flat|null find(integer $id)
 * @method static Collection|Flat[] all(array $columns = ['*'])
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Flat create(array $attributes)
 */
class Flat extends Model
{
    /** @var string $table */
    protected $table = 'flats';

    /** @var string $primaryKey */
    protected $primaryKey = 'id';

    /** @var string[] $fillable  */
    protected $fillable = [
        'id', 'flat_id', 'description_hash',
        'number_of_storeys', 'level', 'area',
        'number_of_rooms', 'price', 'district_id'
    ];

    /**
     * @return HasOne
     */
    public function district(): HasOne
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }
}
