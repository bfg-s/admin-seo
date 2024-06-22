<?php

namespace Admin\Extend\AdminSeo;

use Admin\Delegates\Form;
use Admin\Delegates\Tab;
use Admin\ExtendProvider;
use Admin\Core\ConfigExtensionProvider;
use Admin\Extend\AdminSeo\Extension\Config;
use Admin\Extend\AdminSeo\Extension\Install;
use Admin\Extend\AdminSeo\Extension\Navigator;
use Admin\Extend\AdminSeo\Extension\Uninstall;
use Admin\Extend\AdminSeo\Extension\Permissions;
use Exception;

/**
 * Class ServiceProvider
 * @package Admin\Extend\AdminSeo
 */
class ServiceProvider extends ExtendProvider
{
    /**
     * Extension ID name
     * @var string
     */
    public static string $name = "bfg/admin-seo";

    /**
     * Extension call slug
     * @var string
     */
    static string $slug = "bfg_admin_seo";

    /**
     * Extension description
     * @var string
     */
    public static string $description = "Admin controls for SEO data";

    /**
     * @var string
     */
    protected string $navigator = Navigator::class;

    /**
     * @var string
     */
    protected string $install = Install::class;

    /**
     * @var string
     */
    protected string $uninstall = Uninstall::class;

    /**
     * @var ConfigExtensionProvider|string
     */
    protected string|ConfigExtensionProvider $config = Config::class;

    /**
     * @return void
     * @throws Exception
     */
    public function boot(): void
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        /**
         * Register publishers lang.
         */
        $this->publishes([
            __DIR__.'/../translations/en' => lang_path('en'),
            __DIR__.'/../translations/ru' => lang_path('ru'),
            __DIR__.'/../translations/ua' => lang_path('ua'),
        ], ['admin-seo-lang']);
    }
}

