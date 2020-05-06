<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = ['orderId', 'shipmentType', 'shipmentSubtype', 'senderId','meta'];
    protected $casts    = [
        'orderId' => 'int',
        'senderId' => 'int',
        'meta' => 'array',
        'orderMeta' => 'array',
    ];
    protected $table      = 'cargotracking';
    protected $primaryKey = 'id';
    protected $appends    = [
       // 'order'
    ];
    public $timestamps = false;
    protected $hidden  = [];


    public function order()
    {
        return $this->hasOne('App\Models\Content', 'content_id', 'orderId');
    }

    public function getOrderAttribute()
    {
        return $this->order()->first();
    }

}
