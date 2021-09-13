<?php namespace Foostart\Crawler\Commands;

use Foostart\Crawler\Scripts\Work\Jobs;
use Illuminate\Console\Command;

class JobCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crawler:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler jobs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($call_wrapper = null, $db_seeder = null)
    {
        parent::__construct();
    }


    public function handle()
    {
        $jobs = new Jobs();
        $jobs->crawler();
    }
}
