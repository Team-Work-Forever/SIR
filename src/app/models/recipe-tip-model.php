<?php

class RecipeTipModel
{
    private int $id;
    private string $recipe_id;
    private string $description;
    private $creator_id;
    private string $created_at;

    public function __construct(int $id, string $recipe_id, string $description, $creator_id, string $created_at)
    {
        $this->id = $id;
        $this->recipe_id = $recipe_id;
        $this->description = $description;
        $this->creator_id = $creator_id;
        $this->created_at = $created_at;
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

    public function getCreatorId()
    {
        return $this->creator_id;
    }

    public function getCreatedAt(): string
    {
        $dateString = $this->created_at;
        $dateTime = new DateTime($dateString);

        return $dateTime->format('d/m/Y H:i');
    }
}
