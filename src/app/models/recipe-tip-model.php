<?php

class RecipeTipModel
{
    private int $id;
    private string $recipe_id;
    private string $description;

    public function __construct(int $id, string $recipe_id, string $description)
    {
        $this->id = $id;
        $this->recipe_id = $recipe_id;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRecipeId(): string
    {
        return $this->recipe_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
