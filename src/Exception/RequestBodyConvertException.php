<?php

declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

class RequestBodyConvertException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Error while unmarshalling request  body');
    }
}
