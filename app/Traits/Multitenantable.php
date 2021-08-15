<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * This trait is for multi tenent application
 */
trait Multitenantable
{
    protected static function bootMultitenantable()
    {
        // Automatically fill up user_id when creating
        if (auth()->check()) {
                static::creating(function ($model) {
                    $model->user_id = auth()->id();
                });

            // if user is not administrator - 
            if (auth()->user()->is_admin != 1) {
                static::addGlobalScope('user_id', function (Builder $builder) {
                    $builder->where('user_id', auth()->id());
                });
            }
        }
    }

}
