<?php

namespace Sarfraznawaz2005\Meter\Tables;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Sarfraznawaz2005\Meter\Models\MeterModel;
use Sarfraznawaz2005\Meter\Type;

class CommandsTable extends Table
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
        return (new MeterModel)->type(Type::COMMAND)->orderBy('id', 'desc');
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
            $data['Happened'] = meterWithHtmlTitle(Carbon::parse($row['created_at'])->diffForHumans(), $row['created_at']);

            $data['Command'] = $row['content']['command'];
            $data['Exit Code'] = meterCenter(meterAutoBadge($row['content']['exit_code'], [
                'success' => $row['content']['exit_code'] === 0,
                'warning' => $row['content']['exit_code'] !== 0,
            ]));

            // additional for details button
            // additional for details button
            $details['Arguments'] = '<pre class="json">' . json_encode($row['content']['arguments'], JSON_PRETTY_PRINT) . '</pre>';
            $details['Options'] = '<pre class="json">' . json_encode($row['content']['options'], JSON_PRETTY_PRINT) . '</pre>';

            $data['More'] = meterCenter(meterDetailsButton($details));

            $transformed[] = $data;
        }

        return $transformed;
    }
}
