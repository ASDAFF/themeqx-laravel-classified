<?php

namespace App\Providers;

use App\Option;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        try {
            DB::connection()->getPdo();

            $options = Option::all()->pluck('option_value', 'option_key')->toArray();
            $allOptions = [];
            $allOptions['options'] = $options;
            config($allOptions);

            /**
             * Set dynamic configuration for third party services
             */
            $amazonS3Config = [
                'filesystems.disks.s3' =>
                    [
                        'driver' => 's3',
                        'key' => get_option('amazon_key'),
                        'secret' => get_option('amazon_secret'),
                        'region' => get_option('amazon_region'),
                        'bucket' => get_option('bucket'),
                    ]
            ];
            $facebookConfig = [
                'services.facebook' =>
                    [
                        'client_id' => get_option('fb_app_id'),
                        'client_secret' => get_option('fb_app_secret'),
                        'redirect' => url('login/facebook-callback'),
                    ]
            ];
            $googleConfig = [
                'services.google' =>
                    [
                        'client_id' => get_option('google_client_id'),
                        'client_secret' => get_option('google_client_secret'),
                        'redirect' => url('login/google-callback'),
                    ]
            ];
            config($amazonS3Config);
            config($facebookConfig);
            config($googleConfig);

            view()->composer('*', function ($view) {
                $enable_monetize = get_option('enable_monetize');
                $loggedUser = null;
                if (Auth::check()) {
                    $loggedUser = Auth::user();
                }
                $view->with(['lUser' => $loggedUser, 'enable_monetize' => $enable_monetize]);
            });

        }catch (\Exception $e){
            //echo $e->getMessage();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
