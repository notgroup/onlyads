<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EntryType extends Model
{
    protected $fillable = [];
    protected $casts = ['attributes' => 'array'];
    protected $table      = 'entry_types';
    protected $primaryKey = 'type_id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];




}
