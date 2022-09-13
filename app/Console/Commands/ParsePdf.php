<?php

namespace App\Console\Commands;

use App\Models\Meet;
use Illuminate\Console\Command;

class ParsePdf extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'pdf:parse {file}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Parse the given file';

    /**
     * Execute the console command.
     * @return int
     */
    public function handle()
    {
        $file = $this->argument('file');
        Meet::createFromPdf('programs/' . $file);
    }
}
