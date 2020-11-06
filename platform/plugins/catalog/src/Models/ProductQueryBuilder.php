<?php

namespace Botble\Catalog\Models;

use Illuminate\Database\Query\Builder;

class ProductQueryBuilder extends Builder
{
    public function distinct() {
        $args = func_get_args();

        if (count($args) === 0) {
            // Current behavior
            $this->distinct = true;
        } else {
            // New behavior
            $this->distinct = is_array($args[0]) || is_bool($args[0]) ? $args[0] : $args;
        }

        return $this;
    }

    public function getCountForPagination($columns = ['*'])
    {
        return parent::getCountForPagination(['catalog_products.id']);
    }
}
