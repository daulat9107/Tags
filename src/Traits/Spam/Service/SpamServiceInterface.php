<?php

namespace Daulat\Taggy\Traits\Spam\Service;

interface SpamServiceInterface
{
    public function isSpam(array $parameters, array $additional = []);
    public function markAsSpam(array $parameters, array $additional = []);
    public function markAsHam(array $parameters, array $additional = []);
}
