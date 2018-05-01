<?php

namespace Yama\User\Mappers;

use Illuminate\Database\Eloquent\Model;
use Yama\Support\Mapper;

class UserMapperStripped extends Mapper
{
    /**
     * @param Model $user
     *
     * @return array
     */
    public static function single(Model $user): array
    {
        return [
            'id'          => (int) $user->id,
            'name'        => (string) $user->name,
            'gender'      => (string) $user->gender,
            'role'        => (string) $user->role,
            'avatar'      => (string) $user->avatar,
            'description' => (string) $user->description,
        ];
    }
}
