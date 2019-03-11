<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $counter = 0;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        echo "Constructor called " . $this->counter;
        echo "<br>";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for($i=0; $i<100000000; $i++)
        {
            $this->counter = $this->counter + 1;
        }
        $this->counter = $this->counter + 1;
        echo "asaxasxaxasxax " . $this->counter;
    }
}
