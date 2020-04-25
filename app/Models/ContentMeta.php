<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ContentMeta extends Model
{
    protected $fillable = ['content_id','attributes'];
    protected $casts = ['attributes' => 'array'];
    protected $table      = 'content_meta';
    protected $primaryKey = 'content_id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];


    public function scopeSetJoinContent($query)
    {
        return $query->leftJoin('contents', 'contents.content_id', '=', 'content_meta.content_id');
    }

}
