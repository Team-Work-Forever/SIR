<?php

class RecipeStepModel
{
    private int $id;
    private string $recipe_id;
    private string $name;
    private int $step_number;
    private string $description;

    public function __construct(int $id, string $recipe_id, string $name, int $step_number, string $description)
    {
        $this->id = $id;
        $this->recipe_id = $recipe_id;
        $this->name = $name;
        $this->step_number = $step_number;
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

    public function getStepName(): string
    {
        return $this->name;
    }

    public function getStepNumber(): int
    {
        return $this->step_number;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
