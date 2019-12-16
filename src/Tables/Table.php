<?php
/**
 * Created by PhpStorm.
 * User: Sarfraz
 * Date: 12/12/2019
 * Time: 2:10 PM
 */

namespace Sarfraznawaz2005\Meter\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

abstract class Table
{
    /**
     * Columns to be shown in table.
     *
     * @return array
     */
    abstract public function columns(): array;

    /**
     * Searchable columns in table
     *
     * @return array
     */
    abstract public function searchColumns(): array;

    /**
     * Table Query
     *
     * @return Builder
     */
    abstract public function builder(): Builder;

    /**
     * Returns data for DataTable
     *
     * @return array
     */
    public function getData(): array
    {
        $entries = null;
        $columns = $this->columns();
        $searchColumns = $this->searchColumns();
        $builder = $this->builder();

        $draw = request()->draw;
        $start = request()->start;
        $length = request()->length;
        $orderColumn = request()->order[0]['column'];
        $dir = request()->order[0]['dir'];
        $searchValue = trim(request()->search['value']);

        // sets the current page
        Paginator::currentPageResolver(static function () use ($start, $length) {
            return ($start / $length + 1);
        });

        if ($searchValue) {
            $where = '';

            foreach ($searchColumns as $searchColumn) {
                $where .= "`$searchColumn` like '%$searchValue%' OR ";
            }

            $where = rtrim($where, 'OR ');
            $builder->whereRaw("($where)");
        }

        $builder->select($columns);

        if ($orderColumn) {
            $builder->orderBy($columns[$orderColumn], $dir);
        }

        $rows = $builder->paginate($length);

        $entries = $rows->toArray()['data'];

        if (method_exists($this, 'transform')) {
            $entries = $this->transform($entries);
        }

        return $entries ? [
            'draw' => $draw,
            'recordsTotal' => $rows->total(),
            'recordsFiltered' => $rows->total(),
            'data' => $entries
        ] : [
            'draw' => 0,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
        ];
    }
}
