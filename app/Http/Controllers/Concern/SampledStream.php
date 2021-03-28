<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Twitter;

trait SampledStream
{
    public function getSampledStream(): void
    {
        $result = Twitter::getSampledStream();

        dd($result);
    }
}
