<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'parent_id',
        'name',
        'content',
        'slug'
    ];

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
     * Проверяет что страницу не пытаются поместить внутрь себя самой
     */
    public function valid_parent($id)
    {
        $id = (integer)$id;
        return $id === $this->id;
    }

    public function children() : HasMany
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
