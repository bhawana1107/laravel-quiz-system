<aside id="sidebar" class="hidden md:block w-72 sticky top-6 self-start rounded-2xl p-6 glass no-scrollbar"
    style="height: calc(100vh - 96px);">
    <div class="flex flex-col h-full justify-between">
        <div>
            <h3 class="text-white text-xl font-semibold mb-4 font-serif">Top Categories</h3>
            <ul class="space-y-1">
                @foreach ($categories as $key => $category)
                    <li>
                        <a href="/user-quiz-list/{{ $category->id }}/{{ str_replace(' ', '-', $category->name) }}"
                            class="group flex items-center gap-3 p-3 rounded-lg hover:bg-white/5 transition">
                            <span
                                class="icon-circle inline-flex items-center justify-center 
                   h-4 w-4 rounded-full border border-white/40 bg-transparent
                   transition-all duration-300 group-hover:bg-emerald-700 group-hover:border-emerald-700">
                            </span>
                            <span class="text-slate-100 font-medium">{{ $category->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="mt-6 border-t border-white/6 pt-6">
                <h4 class="text-lg text-slate-300 ">Top Quizzes</h4>
                <ul class="mt-3 space-y-2">
                    @foreach ($quizData as $key => $item)
                        <li class="text-slate-200 text-sm">
                            <a href="/start-quiz/{{ $item->id }}/{{ str_replace(' ', '-', $item->name) }}"
                                class="flex items-center justify-between p-2 rounded hover:bg-white/4">{{ $item->name }}
                                <span class="text-slate-400 text-xs">{{ $item->records_count }}</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</aside>
