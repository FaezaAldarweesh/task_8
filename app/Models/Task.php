<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
    ];

    //Mutators due_date
    public function setPublishedAtAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::parse($value)->format('Y-m-d H:i:s'); 
    }

}
