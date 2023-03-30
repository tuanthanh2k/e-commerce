<?php

namespace App\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{
    protected $category;
    /**
     * Create a new profile composer.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('categories', $this->category->getParents());
    }
}
