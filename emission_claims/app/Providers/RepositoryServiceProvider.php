<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
	           'App\Repositories\Interfaces\UAInterface',
	           'App\Repositories\UARepository'
	    );
	    $this->app->bind(
	           'App\Repositories\Interfaces\BrowserDetectionInterface',
	           'App\Repositories\BrowserDetectionRepository'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\MobileDetectInterface',
            'App\Repositories\MobileDetectRepository'
        );
        $this->app->bind(
               'App\Repositories\Interfaces\CommonSplitsInterface',
               'App\Repositories\CommonSplitsRepository'
        );
        
        $this->app->bind(      
               'App\Repositories\Interfaces\VisitorInterface',
               'App\Repositories\VisitorRepository'
        );
        $this->app->bind(      
               'App\Repositories\Interfaces\UserInterface',
               'App\Repositories\UserRepository'
        );
        $this->app->bind(      
            'App\Repositories\Interfaces\PixelFireInterface',
            'App\Repositories\PixelFireRepository'
        );
        
        $this->app->bind(      
            'App\Repositories\Interfaces\RedirectInterface',
            'App\Repositories\RedirectRepository'
        );
        $this->app->bind(      
            'App\Repositories\Interfaces\LogInterface',
            'App\Repositories\LogRepository'
        );
        $this->app->bind(      
            'App\Repositories\Interfaces\ValidationInterface',
            'App\Repositories\ValidationRepository'
        );

        $this->app->bind(
            'App\Repositories\Interfaces\PreviousDetailsInterface',
            'App\Repositories\PreviousDetailsRepository'
        );
        $this->app->bind(      
            'App\Repositories\Interfaces\CakeInterface',
            'App\Repositories\CakeRepository'
        );
        $this->app->bind(   
            'App\Repositories\Interfaces\CommonFunctionsInterface',
            'App\Repositories\CommonFunctionsRepository'
        );

        $this->app->bind(      
            'App\Repositories\Interfaces\EmailInterface',
            'App\Repositories\EmailRepository'
        );
        $this->app->bind(      
            'App\Repositories\Interfaces\LiveSessionInterface',
            'App\Repositories\LiveSessionRepository'
        );
        $this->app->bind(      
            'App\Repositories\Interfaces\HistoryInterface',
            'App\Repositories\HistoryRepository'
        );

        $this->app->bind(      
            'App\Repositories\Interfaces\QuestionnairesInterface',
            'App\Repositories\QuestionnairesRepository'
        );

        $this->app->bind(      
            'App\Repositories\Interfaces\FollowupInterface',
            'App\Repositories\FollowupRepository'
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
