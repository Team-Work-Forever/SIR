<?php

class RecipeTipImageModel
{
    private int $id;
    private $image;
    private string $recipe_id;
    private string $description;

    public function __construct(int $id, $image, string $recipe_id, string $description)
    {
        $this->id = $id;
        $this->image = $image;
        $this->recipe_id = $recipe_id;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
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
