<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'post';
    protected $fillable = ['title', 'content', 'username'];
    protected $primaryKey = 'idpost';
    public $timestamps = false;
}
