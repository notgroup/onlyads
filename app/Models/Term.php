<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['name','slug'];
    protected $casts = [];
    protected $table      = 'terms';
    protected $primaryKey = 'term_id';
    protected $appends = [];
    public $timestamps    = false;
    protected $hidden = [];

    public function scopeSetJoinTermVariant($query)
    {
        return $query->leftJoin('term_variant', 'terms.term_id', '=', 'term_variant.term_id');
    }

    public function termVariant()
    {
        return $this->belongsTo('App\Models\TermVariant', 'term_id', 'term_id');
    }



}
