<?php

namespace Admin\Extend\AdminSeo\Extension;

use Admin\Core\NavigatorExtensionProvider;
use Admin\Extend\AdminSeo\Controllers\SeosController;
use Admin\Interfaces\ActionWorkExtensionInterface;

/**
 * Class Navigator
 * @package Admin\Extend\AdminSeo\Extension
 */
class Navigator extends NavigatorExtensionProvider implements ActionWorkExtensionInterface {

    /**
     * @return void
     */
    public function handle(): void
    {
        $appSeosController = "App\\Admin\\Controllers\\SeosController";
        $this->item('SEO')
            ->resource('seo', class_exists($appSeosController) ? $appSeosController : SeosController::class)
            ->icon_thumbtack();
    }
}
