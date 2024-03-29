<?php

class IngredientModel
{
    private int $id;
    private string $name;
    private float $price;
    private $unit;

    public function __construct(int $id, string $name, float $price, $unit)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getUnit()
    {
        return $this->unit;
    }
}
