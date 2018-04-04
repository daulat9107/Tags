<?php

namespace Daulat\Taggy\Traits\Spam;

use Illuminate\Support\Facades\Facade;

use Daulat\Taggy\Traits\Spam\Service\SpamServiceInterface;

class Spam extends Facade
{
   protected static function getFacadeAccessor()
   {
        return SpamServiceInterface::class;
   }
}
