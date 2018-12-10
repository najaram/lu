<?php

namespace App\Console\Commands;

use App\Service\Search;
use Illuminate\Console\Command;

class SearchCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'search:amazon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uses Amazon search suggest and save it to the database.';

    /**
     * The search service.
     *
     * @var Search
     */
    private $search;


    public function __construct(Search $search)
    {
        parent::__construct();

        $this->search = $search;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start saving into the database...');

        $this->output->progressStart(676);

        $this->search->run($this->output);

        $this->output->progressFinish();

        $this->info('Done!');
    }
}
