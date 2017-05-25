<?php namespace Xcms\Themes\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeThemeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:theme {alias : The alias of the theme}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new theme';

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * Array to store the configuration details.
     *
     * @var array
     */
    protected $container;

    protected $themeFolderName;

    /**
     * Create a new command instance.
     *
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->files = $filesystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->container['alias'] = snake_case($this->argument('alias'));

        $this->step1();
    }

    /**
     *
     */
    public function step1()
    {
        $this->themeFolderName = $this->ask('Please enter the folder for the theme:', $this->container['alias']);
        $this->container['name'] = $this->ask('Please enter the name of the theme:', studly_case($this->container['alias']));
        $this->container['author'] = $this->ask('Please enter the author for the theme:');
        $this->container['description'] = $this->ask('Please enter the description of the theme:', 'This is the description for the ' . $this->container['name'] . ' theme.');
        $this->container['version'] = $this->ask('Please enter the theme version:', '1.0.0');

        $this->step2();
    }

    public function step2()
    {
        $this->generatingTheme();

        $this->info("\nYour theme generated successfully.");
    }

    public function generatingTheme()
    {
        $pathType = $this->makeThemeFolder();
        $directory = $pathType($this->themeFolderName);

        /**
         * Make directory
         */
        $this->files->makeDirectory($directory);
        $this->files->copyDirectory($this->getStub(), $directory, null);

        /**
         * Modify the module.json information
         */
        \File::put($directory . '/theme.json', json_encode_pretify($this->container));
    }

    private function makeThemeFolder()
    {
        if (!$this->files->isDirectory(theme_base_path())) {
            $this->files->makeDirectory(theme_base_path());
        }
        return 'theme_base_path';

    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../../resources/stubs/_folder-structure';
    }
}
