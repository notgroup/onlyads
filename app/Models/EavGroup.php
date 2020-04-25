<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\EavAttribute;
class EavGroup extends Model
{
    protected $fillable = [
        'attribute_group_name',
        'attribute_group_code',
        'is_primary',
        'status',
        'description',
        'set_group_id',
        'tab_group_id',
        'sort_order',
        'data',
        'places',
        'selected_attributes'
    ];
    protected $casts = [
        'data' => 'array',
        'selected_attributes' => 'array',
        'places' => 'array',
    ];
    protected $table      = 'eav_attribute_group';
    protected $primaryKey = 'attribute_group_id';
    protected $appends = [
        //'attribute_fields',
        'attribute_labels',
    ];
    public $timestamps    = false;
    protected $hidden = [];


    public function getDataAttribute($value)
    {
        return $value && json_decode($value) ? json_decode($value) : [];

    }
    public function getSelectedAttributesAttribute($value)
    {
        return $value && json_decode($value) ? json_decode($value) : [];

    }
    public function getPlacesAttribute($value)
    {
        //$this->attributes['places'] = $value ? $value : [];
        return $value && json_decode($value) ? json_decode($value) : [];
    }
    public function attributes()
    {
                return $this->hasMany('App\Models\EavAttribute', 'attribute_group_id', 'attribute_group_id');
        //return EavAttribute::where('attribute_group_id', $this->attribute_group_id)->get();
    }
    public function getAttributeFieldsAttribute()
    {
        return EavAttribute::where('attribute_group_id', $this->attribute_group_id)->get();
    }
    public function getAttributeLabelsAttribute()
    {
    return $this->attributes()->select(['attribute_group_id','attribute_code','frontend_label'])->pluck('frontend_label','attribute_code')->toArray();
    }
    public function getAttributeFieldsAttribute2()
    {
        return $this->selected_attributes ? EavAttribute::whereIn('attribute_id', $this->selected_attributes)->get() : [];
    }

}
