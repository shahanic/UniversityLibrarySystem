<?php

namespace Tightenco\Ziggy;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Tightenco\Ziggy\Output\File;
use Tightenco\Ziggy\Output\Types;
use Tightenco\Ziggy\Ziggy;

class CommandRouteGenerator extends Command
{
    protected $signature = 'ziggy:generate
                            {path? : Path to the generated JavaScript file. Default: `resources/js/ziggy.js`.}
                            {--types : Generate a TypeScript declaration file.}
                            {--types-only : Generate only a TypeScript declaration file.}
                            {--url=}
                            {--group=}';

    protected $description = 'Generate a JavaScript file containing Ziggy’s routes and configuration.';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $ziggy = new Ziggy($this->option('group'), $this->option('url') ? url($this->option('url')) : null);

        $this->makeDirectory(
            $path = $this->argument('path') ?? config('ziggy.output.path', 'resources/js/ziggy.js')
        );

        if (! $this->option('types-only')) {
            $output = config('ziggy.output.file', File::class);

            $this->files->put(base_path($path), new $output($ziggy));
        }

        if ($this->option('types') || $this->option('types-only')) {
            $types = config('ziggy.output.types', Types::class);

            $this->files->put(base_path(Str::replaceLast('.js', '.d.ts', $path)), new $types($ziggy));
        }

        $this->info('Files generated!');
    }

    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname(base_path($path)))) {
            $this->files->makeDirectory(dirname(base_path($path)), 0755, true, true);
        }

        return $path;
    }
}
