<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class JsonTable extends Model
{
    protected $connection= 'maridbtest';
    protected $fillable = [];
    protected $casts = [
        'attr' => 'array',
        'data' => 'array',
];
    protected $table      = 'attribute_groups';
    protected $primaryKey = 'id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];


    public function termList()
    {
        return $this->belongsToMany('App\Models\TermVariant', 'term_entity', 'entity_id', 'variant_id')
        ->setJoinTerm()
        ->select('*');
    }

}
