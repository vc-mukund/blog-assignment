<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;

class OldBlogDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Blog::whereDate('created_at', '<=', now()->subDays(30))->where('status', 0)->delete();
    }
}
