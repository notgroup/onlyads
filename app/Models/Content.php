<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['entity_type_id', 'creator_id', 'entity_status', 'parent_id','meta'];
    protected $casts    = [
        'creator_id' => 'int',
        'entity_type_id' => 'int',
        //'entity_status' => 'int',
        'parent_id' => 'int',
        'meta' => 'array',
       // 'created_at' => 'date:U',
       // 'updated_at' => 'date:U'
    ];
    protected $table      = 'contents';
    protected $primaryKey = 'content_id';
    protected $appends    = [
        //'meta',
       // 'terms'
    ];
    //protected $dateFormat = 'U';
    public $timestamps = true;
    protected $hidden  = [];
  /*  public function scopeSetJoinMeta($query)
    {
        return $query->leftJoin('content_meta', 'contents.content_id', '=', 'content_meta.content_id');
    }*/
   /*     public function scopeSetJoinIndex($query)
    {
        return $query->leftJoin('contentIndex', 'contents.content_id', '=', 'contentIndex.content_id');
    }*/
    public function termList()
    {
        return $this->belongsToMany('App\Models\TermVariant', 'term_content', 'content_id', 'variant_id')
            ->setJoinTerm()
            ->setJoinTermType()
            ->select('*')->orderBy('level');
    }

    public function terms()
    {
        return $this->belongsToMany('App\Models\TermVariant', 'term_content', 'content_id', 'variant_id');
    }

    public function meta2()
    {
        return $this->hasOne('App\Models\ContentMeta', 'content_id', 'content_id');
        //->get()->pluck('meta_key','meta_value');
    }

    public function getMeta2Attribute()
    {
        return $this->meta2()->first()->toArray()['attributes'];
        //->get()->pluck('meta_key','meta_value');
    }
    public function getTermsAttribute()
    {
        return $this->terms()->get();
    }
}
