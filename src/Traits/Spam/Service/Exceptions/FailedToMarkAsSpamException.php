<?php

namespace Daulat\Taggy\Traits\Spam\Service\Exceptions;

use Exception;

/**
* 
*/
class FailedToMarkAsSpamException extends Exception
{
    
    protected $message = 'Failed to mark as spam.';

}
