<?php

namespace Daulat\Taggy\Traits\Spam\Service\Exceptions;

use Exception;


class FailedToCheckSpamException extends Exception
{
    
    protected $message = 'Failed to check spam.';

}
