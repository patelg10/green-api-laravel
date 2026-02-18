<?php

namespace YourName\GreenApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array sendMessage(string $chatId, string $message)
 * @method static array sendFileByUrl(string $chatId, string $urlFile, string $fileName, string $caption = '')
 * * @see \YourName\GreenApi\GreenApiService
 */
class GreenApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'greenapi';
    }
}