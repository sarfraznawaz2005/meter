<?php

namespace Sarfraznawaz2005\Meter\Tables;

use Carbon\Carbon;
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
            $data['created'] = withHtmlTitle(Carbon::parse($row['created_at'])->diffForHumans(), $row['created_at']);

            $data['verb'] = badge($row['content']['method']);
            $data['path'] = $row['content']['uri'];
            $data['controller'] = $row['content']['controller_action'];

            $data['status'] = autoBadge($row['content']['response_status'], [
                'success' => ($row['content']['response_status'] < 400),
                'warning' => ($row['content']['response_status'] >= 400) && ($row['content']['response_status'] < 500),
                'danger' => ($row['content']['response_status'] >= 500),
            ]);

            $data['time'] = $row['content']['duration'] . 'ms';

            $data['slow'] = autoBadge($row['is_slow'], [
                'secondary' => $row['is_slow'] === 'No',
                'danger' => $row['is_slow'] === 'Yes'
            ]);

            $transformed[] = $data;
        }

        return $transformed;
    }
}
