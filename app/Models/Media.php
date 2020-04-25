<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'reference_id',
        'entity_type_id',
        'file_name',
        'storage_name',
        'data',
    ];
    protected $casts = ['data' => 'array'];
    protected $table      = 'files';
    protected $primaryKey = 'file_id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];

}
