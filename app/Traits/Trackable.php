<?php
namespace App\Traits;
use Illuminate\Support\Facades\Log;


trait Trackable
{
        public static function boot() {



        parent::boot();




        static::created(function($item) {

            Log::info('Gokhan user profile for user: ');

        });



        static::updated(function($item) {

            Log::info('Gokhan user profile for user: ');

        });





        static::deleted(function($item) {

            Log::info('Gokhan user profile for user: ');

        });

                static::creating(function ($model) {
            Log::info('Gokhan user profile for user: ');
        });





        static::saving(function ($user) {

            Log::info('event saving');
        });

                static::saved(function($item) {

            Log::info('Gokhan user profile for user: ' . $item);

        });

      /*  static::restoring(function ($user) {
            Log::info('event saving');
        });
        static::restored(function ($user) {
            Log::info('event saving');
        });*/







    }

   /* public function save(array $options = array()) {
        $changed = $this->isDirty() ? $this->getDirty() : false;
        parent::save();
        if($changed) {
          Log::info('event saving' . $changed);
        }
    }*/

}
