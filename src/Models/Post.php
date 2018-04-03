<?php

namespace Daulat\Taggy\Models;

use Daulat\Taggy\TaggableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use TaggableTrait;
}
