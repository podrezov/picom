<?php

namespace App\Models\Roles;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const MODERATOR = 'moderator';
    const AUTHOR = 'author';

    const ROLES = [
        self::MODERATOR,
        self::AUTHOR,
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function getByName($names): array
    {
        return self::whereIn('name', array_wrap($names))->pluck('id')->all();
    }
}
