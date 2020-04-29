<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
/**
 * Trait ModelEvents
 * @package App\Traits
 */
trait ModelEvents
{

    /**
     * Register model events
     */
    protected static function boot()
    {
                parent::boot();
        foreach (static::registerModelEvents() as $eventName) {
            static::$eventName(function($model) use ($eventName) {
                 Log::info($eventName . ' | Gokhan: ' . $model);
               // event(strtolower(class_basename(static::class)) . ".$eventName", $model);
            });
        }
    }

    /**
     * Returns an array of default registered model events
     * @return array
     */
    protected static function registerModelEvents(): array
    {
        return [
            'created',
            'updated',
            'deleted',
            'saving',
            'saved',
        ];
    }
}
