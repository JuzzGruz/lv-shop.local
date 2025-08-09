<?php

namespace App\Models;

use App\Models\Traits\HasImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use HasImage;
    
    protected $table = 'categories';
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

    protected $fillable = [
        'name',
        'content',
        'parent_id',
        'slug',
        'image'
    ];

    /**
     * Возвращает список корневых категорий каталога товаров
     */
    public static function roots()
    {
        return self::where('parent_id', 0)->with('children')->get();
    }

    /**
     * Связь «один ко многим» таблицы `categories` с таблицей `categories`
     */
    public function children() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    /**
     * Возвращает всех потомков категории с идентификатором $id
     */
    public function get_all_children($id)
    {
        // получаем прямых потомков категории с идентификатором $id
        $children = self::where('parent_id', $id)->with('children')->get();
        $ids = [];
        foreach ($children as $child) {
            $ids[] = $child->id;
            // для каждого прямого потомка получаем его прямых потомков
            if ($child->children->count()) {
                $ids = array_merge($ids, $this->get_all_children($child->id));
            }
        }
        return $ids;
    }

    /**
     * Проверяет, что переданный идентификатор id может быть родителем
     * этой категории, и что категорию не пытаются поместить внутрь себя
     */
    public function valid_parent($id)
    {
        $id = (int)$id;
        $ids = $this->get_all_children($this->id);
        $ids[] = $this->id;
        return in_array($id, $ids);
    }

    /**
     * Связь с продуктами, один ко многим
     */
    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
