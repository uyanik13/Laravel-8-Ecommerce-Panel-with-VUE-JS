<?php

namespace App\QueryFilters\Post;

use App\QueryFilters\Filter;

class Category extends Filter
{
    public function applyFilter($builder, array $categories)
    {
        return $builder->whereIn('category_id', $categories);
    }

    public function applyDefaultFilter($builder)
    {
        return $builder;
    }

    public function filterName()
    {
        return 'categories';
    }
}