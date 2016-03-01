<?php

namespace NineCells\Til;

use App;
use Illuminate\Support\ServiceProvider;
use NineCells\Auth\AuthServiceProvider;
use NineCells\Auth\MemberTab;
use NineCells\Admin\PackageList;

use Mews\Purifier\PurifierServiceProvider;

class TilServiceProvider extends ServiceProvider
{
    public function boot(MemberTab $tab, PackageList $packages)
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ncells');

        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $tab->addMemberTabItemInfo('til', 'TIL', function($member_id) {
            return route('ncells::url.til.member_til', $member_id);
        });

        $packages->addPackageInfo('qna', 'Q&A', function() {
            return 'TilServiceProvider.php를 수정하세요';
        });
    }

    public function register()
    {
        App::register(AuthServiceProvider::class);
        App::register(PurifierServiceProvider::class);
    }
}
