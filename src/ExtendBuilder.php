<?php

namespace Lingxi\AliOpenSearch;

class ExtendBuilder extends \Laravel\Scout\Builder
{
    public $rawWheres;
    public $rawQuerys;

    /**
     * Add a constraint to the search query.
     *
     * @param  string  $field
     * @param  array  $values
     * @return $this
     */
    public function whereIn($field, array $values = [])
    {
        $this->rawWheres[] = '(' . collect($values)->map(function($item) use ($field) {
            $item = !is_numeric($item) && is_string($item) ? '"' . $item . '"' : $item;
            return $field . '=' . $item;
        })->implode(' OR ') . ')';

        return $this;
    }

    public function whereRaw($rawWhere)
    {
        $this->rawWheres[] = $rawWhere;

        return $this;
    }

    public function searchRaw($rawQuerys)
    {
        $this->rawQuerys[] = $rawQuerys;

        return $this;
    }
}
