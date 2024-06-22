<p align="center"><a href="https://wood.veskod.com/documentation/admin-panel" target="_blank">
<img src="https://wood.veskod.com/images/logo.png" alt="Laravel Logo">
</a></p>

<p align="center">
<a href="https://packagist.org/packages/bfg/admin-seo"><img src="https://img.shields.io/packagist/dt/bfg/admin-seo" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/bfg/admin-seo"><img src="https://img.shields.io/packagist/v/bfg/admin-seo" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/bfg/admin-seo"><img src="https://img.shields.io/packagist/l/bfg/admin-seo" alt="License"></a>
</p>

# Install
```
composer require bfg/admin-seo
```
# Admin install
```
php artisan admin:extension bfg/admin-seo --install
```
After successfully installing the extension, a new section called “SEO” will appear in the admin panel. Additionally, a new `Seoable` trait will be provided, designed to integrate with your models. To activate SEO functionality for a specific model, you need to connect the `Seoable` trait to it. This action will expand the ability to manage the model through the administrative panel by adding a new tab with settings. In this tab, you can easily add and configure meta tags for the corresponding model, thereby improving its SEO performance and providing higher visibility in search engines.

```php
use Admin\Extend\AdminSeo\Traits\Addressed;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Addressed;
    
    ...
}
```
Introducing a new tab to the form interface in the admin panel is a key step to expand content management functionality. This process involves developing and integrating an additional user interface element that provides easier access to specialized settings or features. The new tab can be customized to provide administrators with deeper interaction with system data and settings, thereby improving the overall usability of the control panel and making administrative procedures more efficient. Creating such a tab requires careful planning and design to ensure it is intuitive and easy to use for end users.
```php
...
public function matrix(Page $page, Card $card, Form $form, Tab $tab) : Page
{
    return $page->card(
        $card->form(
            $form->tabGeneral(
                ...
            ),
            $form->tabSeo() // SEO tab
        ),
        $card->footer_form(),
    );
}
...
```

# Admin menu
In the case where you need to change the location of the "SEO" menu item in the structure of the administrative panel of your application, there is a specialized method for achieving this goal. This method, called `bfg_admin_seo`, allows you to flexibly integrate the "SEO" menu item into any part of your site's management interface. Using this method, you get the opportunity to customize the layout of menu elements in accordance with the administration needs and navigation logic of your web application. Thus, `bfg_admin_seo` provides you with tools for optimizing the workspace of the administrative panel, thereby improving its usability and efficiency of working with the SEO settings of your site:
```php
class Navigator extends NavigatorExtensionProvider implements ActionWorkExtensionInterface
{
    /**
     * @return void
     */
    public function handle() : void
    {
        $this->bfg_admin_seo(); // SEO menu item
        
        // OR
        
        $this->group('Seo group', 'seo_group', function (NavGroup $group) {
            $group->bfg_admin_seo(); // SEO menu item in group
        })->icon_thumbtack();

        $this->makeDefaults();

        $this->makeExtensions();
    }
}
```
