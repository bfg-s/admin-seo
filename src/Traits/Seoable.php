<?php

namespace Admin\Extend\AdminSeo\Traits;

use Admin\Extend\AdminSeo\Models\Seo;

trait Seoable
{
    /**
     * @return mixed
     */
    public function seo(): mixed
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
