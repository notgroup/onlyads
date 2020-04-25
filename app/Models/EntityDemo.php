<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EntityDemo extends Model
{
    protected $fillable = ['entity_type_id','owner_id','parent_id','status'];
    protected $casts = [
        'created_at' => 'date:U',
        'updated_at' => 'date:U'
    ];
    protected $table      = 'entity_demo01';
    protected $primaryKey = 'entity_id';
    protected $dateFormat = 'U';
    protected $dates = [
      //'created_at',
    ];
    protected $appends = [
        //'meta'
    ];
    //public $timestamps    = false;
    protected $hidden = [
        //'attributes'
    ];
   /* public function setCreatedAtAttribute( $value ) {
        $this->attributes['created_at'] = strtotime("now");
        return strtotime("now");
      }*/

    public function termList()
    {
        return $this->belongsToMany('App\Models\TermVariant', 'term_entity', 'entity_id', 'variant_id')
        ->setJoinTerm()
        ->setJoinTermType()
        ->select('*')->orderBy('level');
    }

    public function meta()
    {
        return $this->hasMany('App\Models\Meta', 'entity_id', 'entity_id')->select(['meta_id','entity_id', 'meta_option_id', 'meta_value']);
        //->get()->pluck('meta_key','meta_value');
    }

    public function getMetaAttribute()
    {
        return $this->meta()->pluck('meta_value', 'meta_option_id');
        //->get()->pluck('meta_key','meta_value');
    }

}
