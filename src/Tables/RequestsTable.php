<?php

namespace Sarfraznawaz2005\Meter\Tables;

use Illuminate\Database\Eloquent\Builder;
use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Type;

class RequestsTable extends Table
{
    /**
     * Columns to be shown in table.
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'is_slow',
            'content',
            'created_at',
        ];
    }

    /**
     * Searchable columns in table
     *
     * @return array
     */
    public function searchColumns(): array
    {
        return $this->columns();
    }

    /**
     * Table Query
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return (new MeterModel)->type(Type::REQUEST);
    }

    /**
     * Transform data as we need.
     *
     * @param array $rows
     * @return array
     */
    public function transform(array $rows): array
    {
        $transformed = [];

        foreach ($rows as $row) {
            $data['created'] = $row['created_at'];
            $data['verb'] = $row['content']['method'];
            $data['path'] = $row['content']['uri'];
            $data['controller'] = $row['content']['controller_action'];
            $data['status'] = $row['content']['response_status'];
            $data['time'] = $row['content']['duration'];
            $data['slow'] = $row['is_slow'];

            $transformed[] = $data;
        }

        return $transformed;
    }
}
