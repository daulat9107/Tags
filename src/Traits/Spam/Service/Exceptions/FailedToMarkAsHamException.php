<?php

namespace Daulat\Taggy\Traits\Spam\Service\Exceptions;

use Exception;

class FailedToMarkAsHamException extends Exception
{
    
    protected $message = 'Failed to mark as ham.';

}
