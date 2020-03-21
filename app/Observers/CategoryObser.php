<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObser
{
    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        $category->children()->delete();
        $category->products()->detach();
    }
}
