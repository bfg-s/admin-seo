<?php

namespace Admin\Extend\AdminSeo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;

/**
 * Admin\Extend\AdminSeo\Models\SeoData
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Seo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seo query()
 * @property int $id
 * @property string $seoable_type
 * @property int $seoable_id
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string|null $robots
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereRobots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereSeoableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereSeoableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereUpdatedAt($value)
 * @property-read Model|\Eloquent $page
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereJsonContainsLocale(string $column, string $locale, ?mixed $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seo whereJsonContainsLocales(string $column, array $locales, ?mixed $value)
 * @mixin \Eloquent
 */
class Seo extends Model
{
    use HasTranslations;

    /**
     * @var string
     */
    protected $table = 'seo';

    /**
     * @var string[]
     */
    protected $fillable = [
        'seoable_type',
        'seoable_id',
        'title',
        'description',
        'keywords',
        'slug',
        'robots',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'seoable_type' => 'string',
        'seoable_id' => 'integer',
        'title' => 'array',
        'description' => 'array',
        'keywords' => 'array',
        'slug' => 'string',
        'robots' => 'string',
    ];

    /**
     * @var array
     */
    protected array $translatable = [
        'title',
        'description',
        'keywords',
    ];

    /**
     * @return MorphTo
     */
    public function page(): MorphTo
    {
        return $this->morphTo('seoable');
    }
}
