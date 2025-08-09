<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryParent implements ValidationRule
{
    private $category;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Category $category) {
        $this->category = $category;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->category->valid_parent($value)) {
            $fail('Не может быть родителем.');
        }
    }
}
