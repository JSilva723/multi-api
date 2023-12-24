<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getCacheDir(): string
    {
        if (!empty($_SERVER) && array_key_exists('HTTP_HOST', $_SERVER)) {
            $tenant = explode('.', $_SERVER['HTTP_HOST'])[0];

            return dirname(__DIR__).'/var/cache/'.$tenant.'/'.$this->getEnvironment();
        }

        return parent::getCacheDir();
    }

    public function getLogDir(): string
    {
        if (!empty($_SERVER) && array_key_exists('HTTP_HOST', $_SERVER)) {
            $tenant = explode('.', $_SERVER['HTTP_HOST'])[0];

            return dirname(__DIR__).'/var/logs/'.$tenant;
        }

        return $_SERVER['APP_LOG_DIR'] ?? parent::getLogDir();
    }
}
