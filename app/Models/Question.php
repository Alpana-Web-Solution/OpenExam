<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\AsCollection;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question',
        'type',
        'options',
        'media',
        'answer',
        'help',
        'point',
        'difficulty',
        'subject_id'
    ];

    protected $casts = [
    	// Casting json->array and return normally.
        'options' => AsCollection::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function subject()
    {
    	return $this->hasOne('\App\Models\Subject','id','subject_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
