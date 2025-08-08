<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait PaginatesCollection
{
    /**
     * Paginate a collection.
     *
     * @param Collection $items
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    protected function paginateCollection(Collection $items, int $perPage = 15): LengthAwarePaginator
    {
        $page = request()->input('page', 1);

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }
}
