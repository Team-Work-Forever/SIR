<?php

class RecipeIngredientModel
{
    private int $id;
    private string $recipe_id;
    private $ingredient;
    private int $quantity;
    private $unit;

    public function __construct(int $id, string $recipe_id, $ingredient, int $quantity, $unit)
    {
        $this->id = $id;
        $this->recipe_id = $recipe_id;
        $this->ingredient = $ingredient;
        $this->quantity = $quantity;
        $this->unit = $unit;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRecipeId(): string
    {
        return $this->recipe_id;
    }

    public function getIngredientId(): int
    {
        return $this->ingredient['id'];
    }

    public function getIngredientName(): string
    {
        return $this->ingredient['name'];
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getUnitId(): int
    {
        return $this->unit['id'];
    }

    public function getUnitName(): string
    {
        return $this->unit['name'];
    }
}
