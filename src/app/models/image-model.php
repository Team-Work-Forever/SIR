<?php

class ImageModel
{
    private string $id;
    private string $name;
    private $blob;
    private string $type;

    public function __construct(string $id, string $name, $blob, string $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->blob = $blob;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent()
    {
        return base64_encode($this->blob);
    }

    public function getType(): string
    {
        return $this->type;
    }
}
