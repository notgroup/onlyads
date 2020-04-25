<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Entities extends Model
{
    protected $fillable = [];
    protected $casts = ['data' => 'array'];
    protected $table      = 'entities';
    protected $primaryKey = 'id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];




}
