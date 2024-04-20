<?php

namespace Yormy\CoreToolsLaravel\Helpers;

class Timer
{
    private array $startTimes;

    private array $durations;

    public function __construct(string $tag)
    {
        $this->startTimes[$tag] = microtime(true);
    }

    public function end(string $tag, bool $asDieDump = false)
    {
        if (!array_key_exists($tag, $this->startTimes)) {
            dd('No start time set');
        }

        $startTime = $this->startTimes[$tag];
        $endTime = microtime(true);

        $duration = round(($endTime - $startTime) * 1000, 3);

        /** @psalm-suppress UndefinedConstant */
        $durationSinceStart = round(($endTime - LARAVEL_START) * 1000, 3);
        $this->durations[$tag] = $duration;

        $durationRating = '-';
        if ($duration > 10) {
            $durationRating = "***";
        } elseif ($duration > 5) {
            $durationRating = "**";
        } elseif ($duration > 1) {
            $durationRating = "*";
        }

        $message = "Timing of: \t$tag:\t" . $duration . "\t  ms";
        $message .= "  ($durationSinceStart ms since start) $durationRating";

        if ($duration > 0) {
            self::toFile($message);
        }
    }

    public static function ddSinceStart()
    {
        $endTime = microtime(true);

        /** @psalm-suppress UndefinedConstant */
        $durationSinceStart = round(($endTime - LARAVEL_START) * 1000, 3);

        $message = "  ($durationSinceStart ms since start)";
        dd($message);
    }

    public static function message(string $message)
    {
        self::toFile($message);
    }

    public static function reset()
    {
        //  unlink('log_timing.txt');
        $message = "-------------------RESET-----------------------------------";
        self::toFile($message);
    }

    //Log::debug is not always available in the early stages of loading
    public static function toFile($message)
    {
//        $time = date("Y-m-d H:i:s");
//        $fp = fopen('log_timing.log', 'a');//opens file in append mode.
//
//        fwrite($fp, $time . ": " . $message . PHP_EOL);
//        fclose($fp);
    }
}
