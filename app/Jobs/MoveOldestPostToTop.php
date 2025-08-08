<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;

class MoveOldestPostToTop implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $allPosts = Post::where('status', 'approved')
            ->orderBy('created_at', 'asc')
            ->pluck('id')
            ->toArray();

        if (empty($allPosts)) return;

        $currentIndex = Cache::get('current_post_index', 0);

        $nextPostId = $allPosts[$currentIndex];

        Cache::put('top_post_id', $nextPostId, now()->addMinutes(6));

        $nextIndex = $currentIndex + 1;
        if ($nextIndex >= count($allPosts)) {
            $nextIndex = 0;
        }
        Cache::put('current_post_index', $nextIndex, now()->addMinutes(35));

        \Log::info("Post {$nextPostId} moved to top (Index: $currentIndex)");
    }
}