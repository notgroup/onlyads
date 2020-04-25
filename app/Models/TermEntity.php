<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TermEntity extends Model
{
    protected $fillable = [];
    protected $casts = ['attributes' => 'array'];
    protected $table      = 'term_entity';
    protected $primaryKey = 'entity_id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];

    public function scopeSetJoinEntity($query)
    {
      return $query->leftJoin('entity', 'term_entity.entity_id', '=',  'entity.entity_id');
   }

   public function entity()
   {
       return $this->hasOne('App\Models\Entity', 'entity_id', 'entity_id');
   }
   
   public function categories()
   {
       return $this->hasMany('App\Models\TermVariant', 'variant_id', 'variant_id');
   }

}
