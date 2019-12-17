<?php

namespace Sarfraznawaz2005\Meter\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MeterModel extends Model
{
    protected $table = 'meter_entries';

    protected $fillable = ['type', 'is_slow', 'content'];

    protected $casts = [
        'content' => 'json',
    ];

    const UPDATED_AT = null;

    /**
     * Scope the query for the given type.
     *
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    public function scopeType($query, $type): Builder
    {
        return $query->where('type', $type)->orderBy('id', 'DESC');
    }

    /**
     * Accessor for is_slow
     *
     * @param $value
     * @return string
     */
    public function getIsSlowAttribute($value)
    {
        return ucfirst($value);
    }
}
