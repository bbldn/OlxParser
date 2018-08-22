<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property string shortcut
 * @property Collection|District[] districts
 * @method static City|null find(integer $id)
 * @method static Collection|City[] all(array $columns = ['*'])
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static City create(array $attributes)
 */
class City extends Model
{
    /** @var string $table */
    protected $table = 'cities';

    /** @var string $primaryKey */
    protected $primaryKey = 'id';

    /** @var string[] $fillable */
    protected $fillable = [
        'id', 'name', 'shortcut',
    ];

    /** @var bool $timestamps */
    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'city_id', 'id');
    }
}
