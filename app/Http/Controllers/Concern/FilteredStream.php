<?php

declare(strict_types=1);

namespace App\Http\Controllers\Concern;

use Atymic\Twitter\Twitter as TwitterContract;
use Twitter;

trait FilteredStream
{
    public function getStream(): void
    {
        $params = [
            TwitterContract::KEY_RESPONSE_FORMAT => TwitterContract::RESPONSE_FORMAT_ARRAY,
        ];

        $result = Twitter::getStream(...$params);

        dd($result);
    }

    public function getStreamRules(): void
    {
        $result = Twitter::getStreamRules();

        dd($result);
    }

    public function postStreamRules(): void
    {
        $params = [
            'add' => [
                [
                    'value' => 'meme has:images'
                ]
            ],
        ];

        // (OR)
        // $params = [
        //    'delete' => [
        //         'ids' => ['1375985006057766912']
        //    ]
        // ];

        $result = Twitter::postStreamRules($params);

        dd($result);
    }
}
