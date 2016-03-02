<?php

namespace NineCells\Til;

use App;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider;
use NineCells\Auth\AuthServiceProvider;
use NineCells\Auth\MemberTab;
use NineCells\Admin\AdminServiceProvider;
use NineCells\Admin\PackageList;

use NineCells\Til\Models\TilCategory;
use NineCells\Til\Models\TilPost;
use NineCells\Til\Policies\TilPolicy;

use Mews\Purifier\PurifierServiceProvider;

class TilServiceProvider extends ServiceProvider
{
    private $policies = [
        TilCategory::class => TilPolicy::class,
        TilPost::class => TilPolicy::class,
    ];

    private function registerPolicies(GateContract $gate)
    {
        $gate->before(function ($user, $ability) {
            if ($ability === "til-write") {
                return $user;
            }
        });

        foreach ($this->policies as $key => $value) {
            $gate->policy($key, $value);
        }
    }

    public function boot(GateContract $gate, MemberTab $tab, PackageList $packages)
    {
        $this->registerPolicies($gate);

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
        App::register(AdminServiceProvider::class);
        App::register(PurifierServiceProvider::class);
    }
}
