<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TermContent extends Model
{
    protected $fillable = ['content_id','variant_id'];
    protected $casts = ['attributes' => 'array'];
    protected $table      = 'term_content';
    protected $primaryKey = 'content_id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];

    public function scopeSetJoinEntity($query)
    {
      return $query->leftJoin('entity', 'term_entity.entity_id', '=',  'entity.entity_id');
   }
    public function scopeSetJoinContent($query)
    {
      return $query->leftJoin('contents', 'term_content.content_id', '=',  'contents.content_id');
   }

   public function entity()
   {
       return $this->hasOne('App\Models\Entity', 'entity_id', 'entity_id');
   }
   public function content()
   {
       return $this->hasOne('App\Models\Content', 'content_id', 'content_id');
   }
   
   public function terms()
   {
       return $this->hasMany('App\Models\TermVariant', 'variant_id', 'variant_id');
   }

}
