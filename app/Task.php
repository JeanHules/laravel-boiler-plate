<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'user_id', 'category_id', 'completed'];

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
