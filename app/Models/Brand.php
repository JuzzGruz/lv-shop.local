<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    use Sluggable;
    use HasImage;

    protected $table = 'brands';
    protected $guarded = false;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Возвращает бренды по количеству продуктов
     */
    public static function popular()
    {
        return self::withCount('products')->orderByDesc('products_count')->limit(5)->get();
    }

    /**
     * Связь с продуктами один ко многим
     */
    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
