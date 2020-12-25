<?php

namespace App\QueryFilters\Post;

use App\QueryFilters\Filter;

class Order extends Filter
{
    public function applyFilter(
        $builder,
        array $order
    ) {
        return $builder->orderBy(
            $order['by'],
            $order['type']
        );
    }

    public function applyDefaultFilter($builder)
    {
        return $builder->orderBy('created_at', 'desc');
    }

    public function filterName()
    {
        return 'order';
    }
}