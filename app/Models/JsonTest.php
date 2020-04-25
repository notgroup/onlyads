<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class JsonTest extends Model
{

    protected $fillable = [];
    protected $casts = [
        'meta' => 'array',
        'media' => 'array',
];
    protected $table      = 'json_test';
    protected $primaryKey = 'ID';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];




}
