<?php

namespace App\Providers;

use App\Repositories\Contracts\AboutCmsRepositoryInterface;
use App\Repositories\Eloquent\AboutCmsRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\BlogRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\AuditRepository;
use App\Repositories\Eloquent\KeywordRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\LanguageRepository;
use App\Repositories\Eloquent\BannerVideoRepository;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\AuditRepositoryInterface;
use App\Repositories\Contracts\KeywordRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\LanguageRepositoryInterface;
use App\Repositories\Contracts\ApplicationSettingsIntarface;
use App\Repositories\Eloquent\ApplicationSettingsRepository;
use App\Repositories\Contracts\BannerVideoRepositoryInterface;
use App\Repositories\Contracts\ContactRepositoryInterface;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Eloquent\ContactRepository;
use App\Repositories\Contracts\UserCategoryRepositoryInterface;
use App\Repositories\Eloquent\UserCategoryRepository;
use App\Repositories\Contracts\TikTokUserRepositoryInterface;
use App\Repositories\Eloquent\StudentRepository;
use App\Repositories\Eloquent\TikTokUserRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            AdminRepositoryInterface::class,
            AdminRepository::class,
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            ApplicationSettingsIntarface::class,
            ApplicationSettingsRepository::class
        );
        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class
        );

      
    }

    public function boot(): void
    {
        //
    }
}
