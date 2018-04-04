<?php

namespace Daulat\Taggy\Models;

use Daulat\Taggy\Models\User;
use Daulat\Taggy\Traits\Scopes\TagUsedScopesTrait;
use Daulat\Taggy\Traits\Spam\Spammable;
use Daulat\Taggy\Traits\TaggableTrait;
use Illuminate\Database\Eloquent\Model;


class Topic extends Model
{
    use TaggableTrait, TagUsedScopesTrait,Spammable;
    protected $fillable = [
        'title', 'body', 'slug',
    ];
    public function getSpamColumns()
    {
        return [
            'body' => 'body',
            'author' => 'user.name',
            'author_email' => 'user.email',
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
