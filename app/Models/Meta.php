<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = [];
    protected $casts = ['attributes' => 'array'];
    protected $table      = 'meta';
    protected $primaryKey = 'meta_id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];
}
