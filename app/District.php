<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int id
 * @property string name
 * @property int city_id
 * @property City|null city
 * @method static District|null find(integer $id)
 * @method static Collection|District[] all(array $columns = ['*'])
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static District create(array $attributes)
 */
class District extends Model
{
    /** @var string $table */
    protected $table = 'districts';

    /** @var string $primaryKey */
    protected $primaryKey = 'id';

    /** @var string[] $fillable  */
    protected $fillable = [
        'id', 'name', 'city_id',
    ];

    /** @var bool $timestamps */
    public $timestamps = false;

    /**
     * @return HasOne
     */
    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
