<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentIndex extends Model
{
    protected $fillable = ['attributes','category','permalink'];
    protected $casts    = [
        'creator_id' => 'int',
        'entity_type_id' => 'int',
        'attributes' => 'array',
    ];
    protected $table      = 'contentIndex';
    protected $primaryKey = 'content_id';
    protected $appends    = [
        //'meta',
       // 'terms'
    ];
    public $timestamps = false;
    protected $hidden  = [];

}
