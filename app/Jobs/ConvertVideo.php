<?php

namespace App\Jobs;

use App\Models\Video;
use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ConvertVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $video;
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $low = (new X264('aac'))->setKiloBitrate(500);
        $height = (new X264('aac'))->setKiloBitrate(1000);
        $destination = '/' . $this->video->uid . '/' . $this->video->uid . '.m3u8';

        FFMpeg::fromDisk('public-videos')
            ->open($this->video->path)
            ->exportForHLS()
            ->addFormat($low, function ($filters) {
                $filters->resize(640, 480);
            })
            ->addFormat($height, function ($filters) {
                $filters->resize(1280, 720);
            })
            ->onProgress(function ($progress) {
                $this->video->update([
                    'processing_percentage' => $progress
                ]);
            })
            ->toDisk('public-videos')
            ->save($destination);

        $this->video->update([
            'processed' => true,
            'processed_file' => $this->video->uid . '.m3u8'
        ]);
    }
}
