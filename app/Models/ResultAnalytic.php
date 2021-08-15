<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class ResultAnalytic extends Model
{
    use HasFactory;

    protected $casts = [
    	// Casting json->array and return normally.
        'right' => AsCollection::class,
        'wrong' => AsCollection::class,
        'skipped' => AsCollection::class,
    ];
}
