<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

class MovieNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('movie not found');
    }
}
