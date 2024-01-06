<?php

function isStepValid($req)
{
    foreach ($req as $key => $value) {
        $req[$key] =  trim($req[$key]);
    }

    if (empty($req['step_description'])) {
        $errors['step_description'] = 'The description field cannot be empty.';
    }

    if (empty($req['step_number'])) {
        $errors['step_number'] = 'The number of the step is required.';
    }

    if (filter_var($req['step_number'], FILTER_VALIDATE_INT) === false || filter_var($req['step_number'], FILTER_VALIDATE_INT) <= 0) {
        $errors['step_number'] = 'The number of the step must be a positive integer.';
    }

    if (isset($errors)) {
        return ['invalid' => $errors];
    }

    return $req;
}
