<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use FFMpeg;
use FFProbe;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        /** video duration validation  'video:25' */
        Validator::extend('video_length', function($attribute, $value, $parameters, $validator) {

            // validate the file extension
            if(!empty($value->getClientOriginalExtension()) && ($value->getClientOriginalExtension() == 'mp4')){

               #$ffprobe = FFMpeg\FFProbe::create();
                $ffprobe = FFMpeg\FFProbe::create();
                $duration = $ffprobe
                    ->format($value->getRealPath()) // extracts file information
                    ->get('duration');
                return(round($duration) > $parameters[0]) ?false:true;
            }else{
                return false;
            }
        });
        //Schema::defaultStringLength(191);
        date_default_timezone_set('America/Merida');

    }
}
