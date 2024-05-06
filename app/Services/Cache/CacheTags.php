<?php

namespace App\Services\Cache;

final class CacheTags
{
    public static function postPagination(): string
    {
        return 'post_pagination';
    }
}
