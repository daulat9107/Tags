<?php

namespace Daulat\Taggy\Models;

use Daulat\Taggy\Traits\Scopes\TagUsedScopesTrait;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use TagUsedScopesTrait;
}
