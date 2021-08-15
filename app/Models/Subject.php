<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'name',
        'code',
        'description',
        'slug',
        'subject_id'

    ];

    public function parentSubject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');

    }

    public function childSubjects()
    {
        return $this->hasMany(Subject::class, 'subject_id');

    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
