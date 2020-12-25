<?php

namespace App\QueryFilters;

abstract class Filter
{
    public function handle(
        array $data,
        \Closure $next
    ) {
        if (\array_key_exists($this->filterName(), $data['filters'])) {

            $data['query'] = $this->applyFilter(
                $data['query'],
                $data['filters'][$this->filterName()]
            );

            return $next($data);

        }
       
        $data['query'] = $this->applyDefaultFilter($data['query']);

        return $next($data);
    }

    abstract protected function filterName();

    abstract protected function applyFilter($builder, array $data);
    
    abstract protected function applyDefaultFilter($builder);

}