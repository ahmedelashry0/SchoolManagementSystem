<?php

namespace App\Traits;

use InvalidArgumentException;

trait Filter
{
    public function filter($model, $order_by, $request, array $properties, $order_direction = 'asc')
    {
        if (!class_exists($model)) {
            throw new InvalidArgumentException('Invalid model class provided');
        }

        if (!in_array($order_direction, ['asc', 'desc'])) {
            throw new InvalidArgumentException('Order direction must be either "asc" or "desc"');
        }

        $query = $model::query();
        $query->orderBy($order_by, $order_direction);

        foreach ($properties as $property => $condition) {
            if ($request->filled($property)) {
                if ($condition === 'like') {
                    $query->where($property, 'like', '%' . $request->$property . '%');
                } elseif ($condition === '=') {
                    $query->where($property, $request->$property);
                }
            }
        }

        return $query;
    }
}
