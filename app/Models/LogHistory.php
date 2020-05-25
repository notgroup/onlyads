<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Content;

class LogHistory extends Model
{
    protected $fillable = ['subject_id','object_id','log_type','action_type','content'];
    protected $casts = ['content' => 'array'];
    protected $table      = 'log_history';
    protected $primaryKey = 'id';
    protected $appends = [];
    public $timestamps    = true;
    protected $hidden = [];




}
