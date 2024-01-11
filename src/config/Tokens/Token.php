<?php

namespace Config\Tokens;

require_once __DIR__ . '/../../utils/uuid.php';

use Config\Twig\Twig;

enum TokenType
{
    case forgot;
}

class Token
{
    private $type;

    public function __construct(TokenType $type = TokenType::forgot)
    {
        $this->type = $type;
    }

    public function generate()
    {
        return createUUID();
    }

    public function getTokenType()
    {
        return $this->type->name;
    }
}
