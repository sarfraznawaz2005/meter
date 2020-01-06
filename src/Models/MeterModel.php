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
        return $query->where('type', $type);
    }

    /**
     * Scope the query for the given filter.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeFiltered($query): Builder
    {
        if (request()->has('all')) {
            $builder = $query;
        } elseif (request()->has('days')) {
            // not using "WHERE DATE(created_at)" since created_at is index column.
            $date = now()->subDays(request()->days)->toDateString();
            $builder = $query->whereRaw("created_at >= '$date 00:00:00'");
        } elseif (request()->has('slow')) {
            $builder = $query->where('is_slow', 1);
        } else {
            // default today
            $builder = $query->whereRaw("created_at >= '" . now()->toDateString() . " 00:00:00'");
        }

        /*
        if (!request()->expectsJson()) {
            dump(meterGetSql($builder));
        }
        */

        return $builder;
    }
}
