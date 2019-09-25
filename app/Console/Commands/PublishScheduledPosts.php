<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:scheduled-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes any scheduled posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $posts = Post::where('is_published', false)->get();

        foreach ($posts as $post) {
            if ($post->publish_at >= Carbon::now()) {
                $post->is_published = true;
                $post->save();
            }
        }
    }
}
