<?php

require_once __DIR__ . '../../models/user-model.php';
require_once __DIR__ . '../../mappers/image-mapper.php';
require_once __DIR__ . '../../../infra/repositories/images-repository.php';


function toUserModel($user)
{
    return new UserModel(
        $user['id'],
        $user['email'],
        $user['display_name'],
        $user['first_name'],
        $user['last_name'],
        $user['description'],
        toImageModel(getImageById($user['avatar'])),
    );
}

function toUserModelList($users)
{

    $list = [];

    foreach ($users as $user) {
        $list[] = new UserModel(
            $user['id'],
            $user['email'],
            $user['display_name'],
            $user['first_name'],
            $user['last_name'],
            $user['description'],
            toImageModel(getImageById($user['avatar'])),
        );
    }
    return $list;
}
