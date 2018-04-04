<?php

namespace Daulat\Taggy\Traits\Spam\Service\Exceptions;

use Exception;


class InvalidApiKeyException extends Exception
{
    
    protected $message = 'Your Service API key is invalid.';

}
