<?php

namespace App\Console\Commands;

use App\Parsers\MainParser;
use Illuminate\Console\Command;

class ParseCommand extends Command
{
    /** @var string $signature */
    protected $signature = 'parse';

    /** @var string $description */
    protected $description = 'run parse';

    /**
     * @param MainParser $parseService
     */
    public function handle(MainParser $parseService): void
    {
        $parseService->handle();
    }
}
