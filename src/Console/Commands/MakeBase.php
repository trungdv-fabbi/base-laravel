<?php

namespace TrungDV\BaseLaravel\Console\Commands;

use Illuminate\Console\Command;
use TrungDV\BaseLaravel\Helper;
use Illuminate\Support\Facades\Artisan;

class MakeBase extends Command
{
    protected string $projectName;
    protected string $phpVersion;
    protected string $mysqlVersion;
    protected const DOCKER_FOLDER_PATH = 'docker';
    protected const INIT_DB_FOLDER_PATH = 'initdb';
    protected const MYSQL_FOLDER_PATH = 'mysql';
    protected const IGNORE_FILE = '.gitignore';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:base';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Base Test';

    public function __construct(private readonly Helper $helper)
    {
        parent::__construct();
        $this->projectName = config('base.project_name');
        $this->phpVersion = config('base.php_version');
        $this->mysqlVersion = config('base.mysql_version');
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->makeBaseDocker();
    }

    /**
     * makeBaseDocker
     *
     * @return void
     */
    private function makeBaseDocker(): void
    {
        $this->makeBaseDockerTemplates(
            [
                'docker-compose',
            ],
            DIRECTORY_SEPARATOR,
            [
                '{PROJECT_NAME}' => $this->projectName,
                '{MYSQL_VERSION}' => $this->mysqlVersion,
            ],
            '.yml'
        );
        $this->helper->createDirectoryIfNotExists(self::DOCKER_FOLDER_PATH);
        $this->helper->createDirectoryIfNotExists(self::DOCKER_FOLDER_PATH . DIRECTORY_SEPARATOR . self::INIT_DB_FOLDER_PATH);
        $this->createFile(
            self::DOCKER_FOLDER_PATH . DIRECTORY_SEPARATOR . self::INIT_DB_FOLDER_PATH . DIRECTORY_SEPARATOR . self::IGNORE_FILE,
            self::IGNORE_FILE
        );
        $this->helper->createDirectoryIfNotExists(self::DOCKER_FOLDER_PATH . DIRECTORY_SEPARATOR . self::MYSQL_FOLDER_PATH);
        $this->createFile(
            self::DOCKER_FOLDER_PATH . DIRECTORY_SEPARATOR . self::MYSQL_FOLDER_PATH . DIRECTORY_SEPARATOR . self::IGNORE_FILE,
            self::IGNORE_FILE
        );
        $this->makeBaseDockerTemplates(
            [
                'Dockerfile',
            ],
            self::DOCKER_FOLDER_PATH,
            [
                '{PHP_VERSION}' => $this->phpVersion,
            ],
            ''
        );
        $this->createFile(
            self::DOCKER_FOLDER_PATH . DIRECTORY_SEPARATOR . 'http-nginx.conf',
            'http-nginx.conf'
        );
        $this->createFile(
            self::DOCKER_FOLDER_PATH . DIRECTORY_SEPARATOR . 'php.ini',
            'php.ini'
        );
    }

    private function createFile(string $path, string $template): void
    {
        $newStub = $this->helper->replaceParamInTemplate(
            $template,
            []
        );
        $this->helper->createFile(
            $path,
            $newStub,
        );
    }

    /**
     * @param $names: Array | String
     * if $key of $names is string, output file name is $key
     * @return void
     */
    private function makeBaseDockerTemplates(array|string $names, string $path, array $replace = [], string $extension = '.php')
    {
        $names = is_array($names) ? $names : [$names];
        foreach($names as $k => $v) {
            $template = $this->helper->replaceParamInTemplate(
                $v,
                $replace
            );

            $newName = is_string($k) ? $k : $v;
            $this->helper->createFile(
                $path . DIRECTORY_SEPARATOR . "{$newName}" . $extension,
                $template
            );
        }
    }

    /**
     * @param $names: Array | String
     * if $key of $names is string, output file name is $key
     * @return void
     */
    private function makeBaseTemplates($names, $path, array $search = null, array $replace = null)
    {
        $names = is_array($names) ? $names : [$names];
        foreach($names as $k => $v) {
            $template = $this->helper->getTemplate(
                $v,
                $search,
                $replace
            );

            $newName = is_string($k) ? $k : $v;
            $this->helper->createFile(
                $path . DIRECTORY_SEPARATOR . "{$newName}.php",
                $template
            );
        }
    }
}
