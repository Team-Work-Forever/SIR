<?php

class RecipeModel
{
    private string $id;
    private string $title;
    private int $execution_time;
    private int $servings;
    private $cover;
    private int $is_private;
    private string $creator_name;
    private string $creator_id;
    private string $category_id;
    private string $category;
    private string $description;
    private array $recipe_tips;
    private array $recipe_ingredients;
    private array $recipe_steps;
    private bool $is_favorite;
    private string $created_at;
    private string $updated_at;

    public function __construct(
        string $id,
        string $title,
        int $execution_time,
        int $servings,
        $cover,
        int $is_private,
        string $creator_name,
        string $creator_id,
        string $category_id,
        string $category,
        string $description,
        array $recipe_tips,
        array $recipe_ingredients,
        array $recipe_steps,
        bool $is_favorite,
        string $created_at,
        string $updated_at
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->execution_time = $execution_time;
        $this->servings = $servings;
        $this->cover = $cover;
        $this->is_private = $is_private;
        $this->creator_name = $creator_name;
        $this->creator_id = $creator_id;
        $this->category_id = $category_id;
        $this->category = $category;
        $this->description = $description;
        $this->recipe_tips = $recipe_tips;
        $this->recipe_ingredients = $recipe_ingredients;
        $this->recipe_steps = $recipe_steps;
        $this->is_favorite = $is_favorite;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getExecutionTimeFormatted(): string
    {
        return $this->getTimeString($this->execution_time);
    }

    public function getExecutionTime(): string
    {
        return $this->execution_time;
    }

    public function getServings(): int
    {
        return $this->servings;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function getIsPrivate(): int
    {
        return $this->is_private;
    }

    public function getCreatorName(): string
    {
        return $this->creator_name;
    }

    public function getCreatorId(): string
    {
        return $this->creator_id;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getRecipeTips(): array
    {
        return $this->recipe_tips;
    }

    public function getRecipeIngredients(): array
    {
        return $this->recipe_ingredients;
    }

    public function getRecipeSteps(): array
    {
        return $this->recipe_steps;
    }

    public function getIsFavorite(): bool
    {
        return $this->is_favorite;
    }

    private function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getCreatedAtFormatted(): string
    {
        $dateString = $this->created_at;
        $dateTime = new DateTime($dateString);

        return $dateTime->format('d/m/Y');
    }

    private function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function getLastModificationTimeText(): string
    {
        return $this->getCreatedAt() == $this->getUpdatedAt() ? 'Criado há' : 'Atualizado há';
    }

    private function getTimeDifference(): int
    {
        return (time() - strtotime($this->getUpdatedAt())) / 60;
    }

    public function getLastModificationTime(): string
    {
        return $this->getTimeString($this->getTimeDifference());
    }

    private function getTimeString($time): string
    {
        if ($time < 60) {
            if ($time == 1) {
                $unit = 'minuto';
            } else {
                $unit = 'minutos';
            }
        } elseif ($time < 1440) {
            $time_hour = floor($time / 60);
            if ($time_hour == 1) {
                $unit = 'hora';
            } else {
                $unit = 'horas';
            }

            $time_min = $time % 60;
            if (number_format($time_min) == 1) {
                $unit .= ' e 1 minuto';
            } elseif ($time_min > 1) {
                $unit .= ' e ' . $time_min . ' minutos';
            }
            return $time_hour . ' ' . $unit;
        } elseif ($time < 43200) {
            $time = number_format($time / 1440);
            if ($time == 1) {
                $unit = 'dia';
            } else {
                $unit = 'dias';
            }
        } elseif ($time < 518400) {
            $time = number_format($time / 43200);
            if ($time == 1) {
                $unit = 'mês';
            } else {
                $unit = 'meses';
            }
        } else {
            $time = number_format($time / 518400);
            if ($time == 1) {
                $unit = 'ano';
            } else {
                $unit = 'anos';
            }
        }

        return number_format($time, 0) . ' ' . $unit;
    }
}
