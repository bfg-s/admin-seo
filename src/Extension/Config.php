<?php

namespace Admin\Extend\AdminSeo\Extension;

use Admin\Core\ConfigExtensionProvider;
use Admin\Delegates\Form;
use Admin\Delegates\Tab;

/**
 * Class Config
 * @package Admin\Extend\AdminSeo\Extension
 */
class Config extends ConfigExtensionProvider {

    public function boot()
    {
        parent::boot();

        Form::macro('tabSeo', function (...$delegates) {

            $tab = new Tab();
            return $this->tab(
                $tab->title('SEO')->icon_thumbtack(),
                $tab->input('seo[slug]', 'admin-seo.slug')
                    ->nullable()
                    ->unique_if(! $this->isType('edit'), 'seo', 'slug'),
                $tab->lang()->input('seo[title]', 'admin-seo.title')->vertical(),
                $tab->lang()->textarea('seo[description]', 'admin-seo.description')->vertical(),
                $tab->lang()->textarea('seo[keywords]', 'admin-seo.keywords')->vertical(),
                $tab->input('seo[robots]', 'admin-seo.robots')
                    ->default('index, follow')
                    ->info(__('admin-seo.robots_info')),
                ...$delegates
            );
        });
    }
}
