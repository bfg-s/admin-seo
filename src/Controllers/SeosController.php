<?php

namespace Admin\Extend\AdminSeo\Controllers;

use Admin\Delegates\Tab;
use Admin\Extend\AdminSeo\Models\Seo;
use Admin\Page;
use Admin\Controllers\Controller;
use Admin\Delegates\Card;
use Admin\Delegates\Form;
use Admin\Delegates\SearchForm;
use Admin\Delegates\ModelTable;
use Admin\Delegates\ModelInfoTable;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * CityController Class
 * @package App\Admin\Controllers
 */
class SeosController extends Controller
{
    /**
     * Static variable Model
     * @var string
     */
    static $model = Seo::class;

    public function defaultTools($type)
    {
        return $type !== 'add';
    }

    /**
     * @param  Page  $page
     * @param  Card  $card
     * @param  SearchForm  $searchForm
     * @param  ModelTable  $modelTable
     * @return Page
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Page $page, Card $card, SearchForm $searchForm, ModelTable $modelTable) : Page
    {
        return $page->card(
            $card->search_form(
                $searchForm->id(),
                $searchForm->input('title', 'admin-seo.title'),
                $searchForm->input('description', 'admin-seo.description'),
                $searchForm->input('slug', 'admin-seo.slug'),
                $searchForm->input('keywords', 'admin-seo.keywords'),
                $searchForm->input('robots', 'admin-seo.robots'),
                $searchForm->at(),
            ),
            $card->model_table(
                $modelTable->id(),
                $modelTable->col('admin-seo.title', 'title')->sort,
                $modelTable->col('admin-seo.description', 'description')->sort->str_limit(50),
                $modelTable->col('admin-seo.slug', 'slug')->sort->copied,
                $modelTable->col('admin-seo.keywords', 'keywords')->sort,
                $modelTable->col('admin-seo.robots', 'robots')->sort,
                $modelTable->at(),
            ),
        );
    }

    /**
     * @param  Page  $page
     * @param  Card  $card
     * @param  Form  $form
     * @param  Tab  $tab
     * @return Page
     */
    public function matrix(Page $page, Card $card, Form $form, Tab $tab) : Page
    {
        return $page->card(
            $card->form(
                $form->tabGeneral(
                    $tab->ifEdit()->info('seoable_type', 'admin-seo.model'),
                    $tab->ifEdit()->info('seoable_id', 'admin-seo.model_id'),
                    $tab->lang()->input('title', 'admin-seo.title')
                        ->required()
                        ->vertical()
                        ->duplication_how_slug('#input_slug'),
                    $tab->input('slug', 'admin-seo.slug'),
                    $tab->lang()->textarea('description', 'admin-seo.description')->vertical(),
                    $tab->lang()->textarea('keywords', 'admin-seo.keywords')->vertical(),
                    $tab->input('robots', 'admin-seo.robots')
                        ->default('index, follow')
                        ->info(__('admin-seo.robots_info')),
                )
            ),
            $card->footer_form(),
        );
    }

    /**
     * @param Page $page
     * @param Card $card
     * @param ModelInfoTable $modelInfoTable
     * @return Page
     */
    public function show(Page $page, Card $card, ModelInfoTable $modelInfoTable) : Page
    {
        return $page->card(
            $card->model_info_table(
                $modelInfoTable->rowDefault(
                    $modelInfoTable->row('admin-seo.model', 'seoable_type'),
                    $modelInfoTable->row('admin-seo.model_id', 'seoable_id')->badge,
                    $modelInfoTable->row('admin-seo.title', 'title'),
                    $modelInfoTable->row('admin-seo.description', 'description'),
                    $modelInfoTable->row('admin-seo.slug', 'slug')->copied,
                    $modelInfoTable->row('admin-seo.keywords', 'keywords'),
                    $modelInfoTable->row('admin-seo.robots', 'robots'),
                )
            ),
        );
    }
}
