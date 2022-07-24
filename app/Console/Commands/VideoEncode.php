<?php

namespace App\Console\Commands;

use FFMpeg\Format\Video\X264;
use Illuminate\Console\Command;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class VideoEncode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video-encode:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test video encoding';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $low = (new X264('aac'))->setKiloBitrate(500);
        $height = (new X264('aac'))->setKiloBitrate(1000);
        FFMpeg::fromDisk('public-videos')
            ->open('162c8846ccceef.mp4')
            ->exportForHLS()
            ->addFormat($low, function ($filters) {
                $filters->resize(640, 480);
            })
            ->addFormat($height, function ($filters) {
                $filters->resize(1280, 720);
            })
            ->onProgress(function ($progress) {
                $this->info($progress);
            })
            ->toDisk('public-videos')
            ->save('/test/file.m3u8');
    }
}
