<?php

namespace TrungDV\BaseLaravel\Facades;

use Illuminate\Support\Facades\Facade;
use TrungDV\BaseLaravel\Helper;

/**
 * @method static string realPath(string $path = '')
 * @method static void makePath(string $path = '')
 * @method static void createDirectoryIfNotExists($params)
 * @method static string getTemplate($templateFileName, $search = null, $replace = null)
 * @method static string replaceParamInTemplate(string $templateFileName, array $patternReplacement)
 * @method static void createFile($files, $template)
 * @method static void put($path, $tmp)
 * @method static \Illuminate\Http\JsonResponse response($resource, $status = 200)
 */
class BaseLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'base-laravel';
    }
}
