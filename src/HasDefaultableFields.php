<?php

namespace Inspheric\NovaDefaultable;

use Laravel\Nova\Http\Requests\NovaRequest;

trait HasDefaultableFields
{
    /**
     * Fill the given fields for the model.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Model     $model
     * @param \Illuminate\Support\Collection          $fields
     *
     * @return array
     */
    protected static function fillFields(NovaRequest $request, $model, $fields): array
    {
        $fields->filter(function($field) {
            return $field->meta['defaultLastValue'] ?? false;
        })->each(function($field) use ($request) {
            DefaultableField::cacheLastValue($request, $field);
        });

        return parent::fillFields($request, $model, $fields);
    }
}
