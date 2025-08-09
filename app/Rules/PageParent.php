<?php

namespace App\Rules;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PageParent implements ValidationRule
{
    private $page;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Page $page) {
        $this->page = $page;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->page->valid_parent($value)) {
            $fail('Не может быть родителем.');
        }
    }
}
