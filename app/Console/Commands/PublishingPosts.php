<?php

namespace App\Console\Commands;

use App\Services\Blog\PostServices;
use Illuminate\Console\Command;

class PublishingPosts extends Command
{
    /** @var PostServices */
    private $postServices;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publishing-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Запуск отложенной публикации постов';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->postServices = new PostServices();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = now();

        $this->comment('Processing');

        $this->postServices->startPublishingProcess();

        $time = $start->diffInSeconds(now());

        $this->info(
            sprintf('Процедура публикации отложенных постов - завершена. И составила %s сек', $time)
        );
    }
}
