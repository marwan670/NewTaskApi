<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id'
    ];


    public function getDueDateAttribute($val)
    {
        return date('d/m/y h:i',strtotime($val));
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
