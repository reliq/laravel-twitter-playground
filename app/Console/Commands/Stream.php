<?php

namespace App\Console\Commands;

use Atymic\Twitter\Twitter as TwitterContract;
use Illuminate\Console\Command;
use Twitter;

class Stream extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:stream
                            {--s|sampled : Whether to use sampled stream}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stream some tweets';

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
     * @return int
     */
    public function handle(): int
    {
        $useSampledStream = $this->option('sampled');
        $params = [TwitterContract::KEY_STREAM_STOP_AFTER_COUNT => 3];
        $num = 0;

        if ($useSampledStream) {
            $this->comment('<info>✔</info> Using sampled stream: ' . PHP_EOL);
            Twitter::getSampledStream(
                function (string $tweet) use (&$num) {
                    $num++;
                    $this->info($num . '. ' . $tweet . PHP_EOL);
                },
                $params
            );

            return 0;
        }

        $this->comment('<info>✔</info> Using default stream: ' . PHP_EOL);
        Twitter::getStream(
            function (string $tweet) use (&$num) {
                $num++;
                $this->info($num . '. ' . $tweet . PHP_EOL);
            },
            $params
        );

        return 0;
    }
}
