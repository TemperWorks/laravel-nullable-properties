<?php declare(strict_types=1);

namespace Temper\NullableProperties;

use Illuminate\Database\Eloquent\Model;

class NullableObserver
{
    public function saving(Model $model): bool
    {
        if (!$model->nullable) return true;

        foreach ($model->toArray() as $property => $value) {
            if ($value === '' && $model->isDirty($property) && in_array($property, $model->nullable, true)) {
                $model->$property = null;
            }
        }

        return true;
    }
}
