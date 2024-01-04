<?php

class UnitModel
{
    private int $id;
    private string $name;
    private string $unit;

    public function __construct(int $id, string $name, string $unit,)
    {
        $this->id = $id;
        $this->name = $name;
        $this->unit = $unit;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}
