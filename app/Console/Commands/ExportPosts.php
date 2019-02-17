<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\ExportPostsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ExportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export posts in xml';

    /**
     * @var ExportPostsService
     */
    private $exportPostsService;

    /**
     * Create a new command instance.
     *
     * @param ExportPostsService $exportPostsService
     */
    public function __construct(ExportPostsService $exportPostsService)
    {
        parent::__construct();

        $this->exportPostsService = $exportPostsService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Storage::disk('local')->put('export/posts.xml', $this->exportPostsService->xml(Post::all()));
    }
}
