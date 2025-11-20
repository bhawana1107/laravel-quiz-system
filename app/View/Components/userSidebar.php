<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
use App\Models\Quiz;

class userSidebar extends Component
{
 public $categories;
    public $quizData;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Top categories by quiz count
        $this->categories = Category::withCount('quizzes')
            ->orderBy('quizzes_count', 'desc')
            ->take(5)
            ->get();

        // Top quizzes based on attempts or records
        $this->quizData = Quiz::withCount('mcqs')
            ->orderBy('id', 'desc')
            ->take(8)
            ->get();
    }

    // public function __construct()
    // {
    //     //
    // }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.userSidebar');
    }
}
