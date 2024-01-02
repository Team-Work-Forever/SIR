<?php

require_once __DIR__ . '../../models/image-model.php';

function toImageModel($image)
{
    return new ImageModel($image['id'], $image['name'], $image['content'], $image['type'],);
}
