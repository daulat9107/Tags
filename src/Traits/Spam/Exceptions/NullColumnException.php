<?php

namespace Daulat\Taggy\Traits\Spam\Exceptions;
use Exception;
/**
* 
*/
class NullColumnException extends Exception
{
    protected $message = 'You must define at least one column to check.';
}
