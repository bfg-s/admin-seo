<?php

namespace Admin\Extend\AdminSeo\Extension;

use Admin\Core\InstallExtensionProvider;
use Admin\Interfaces\ActionWorkExtensionInterface;
use Illuminate\Support\Facades\Schema;

/**
 * Class Install
 * @package Admin\Extend\AdminSeo\Extension
 */
class Install extends InstallExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->command->call('vendor:publish', [
            '--tag' => "admin-seo-lang",
            '--force' => true,
        ]);

        if (! Schema::hasTable('seo')) {

            $this->command->call('migrate', [
                '--path' => "vendor/bfg/admin-seo/migrations",
            ]);
        }
    }
}
