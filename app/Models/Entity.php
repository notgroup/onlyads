<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $fillable = [];
    protected $casts = ['attributes' => 'array'];
    protected $table      = 'entity';
    protected $primaryKey = 'entity_id';
    protected $appends = [
        //'meta'
    ];
    public $timestamps    = false;
    protected $hidden = [
        //'attributes'
    ];


    public function termList()
    {
        return $this->belongsToMany('App\Models\TermVariant', 'term_content', 'content_id', 'variant_id')
        ->setJoinTerm()
        ->setJoinTermType()
        ->select('*')->orderBy('level');
    }

    public function requirementsOfEntity()
    {
        return [
            "content" => [
                "entity_type_id",
                "status",
                "creator_id",
                "parent_id",
                "created_at",
                "updated_at",
            ],
            "comment" => [

            ]
        ];
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
