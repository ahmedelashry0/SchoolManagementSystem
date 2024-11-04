<?php

namespace App\Traits;

use InvalidArgumentException;

trait Filter
{
    public function filter($model, $order_by, $order_direction = 'asc',  $condition , $request ,...$properities )
    {
        if (!class_exists($model)) {
            throw new InvalidArgumentException('Invalid model class provided');
        }

        if (!in_array($order_direction, ['asc', 'desc'])) {
            throw new InvalidArgumentException('Order direction must be either "asc" or "desc"');
        }
        $query = $model::query();
        $query->orderBy($order_by, $order_direction);
        foreach ($properities as $property) {
            if ($request->filled($property)) {
                switch($condition){
                    case 'like':
                        $query->where($property, 'like', '%' . $request->$property . '%');
                        break;
                    case '=':
                        $query->where($property, $request->$property);
                        break;
                }
            }
        }
        return $query;
    }
}
