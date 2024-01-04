<?php
@require_once __DIR__ . '../../../helpers/session.php';
require_once __DIR__ . '../../db/connection.php';
require_once __DIR__ . '../../../utils/uuid.php';

function createRecipe($recipe)
{
    $userId = userId();
    $idUUID = createUUID();

    $sqlCreate = "INSERT INTO
    recipes (
        id,
        title,
        execution_time,
        servings,
        cover,
        is_private,
        creator_id,
        category_id,
        description
        )
    VALUES (
        :id,
        :title,
        :execution_time,
        :servings,
        :cover,
        :is_private,
        :creator_id,
        :category_id,
        :description
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    $success = $PDOStatement->execute([
        ':id' => $idUUID,
        ':title' => $recipe['name'],
        ':execution_time' => $recipe['execution_time'],
        ':servings' => $recipe['servings'],
        ':cover' => 'c93a0f1a-50fd-d119-f984-c7edd07ca624',
        ':is_private' => 0,
        ':creator_id' => $userId,
        ':category_id' => $recipe['category_id'],
        ':description' => $recipe['description']
    ]);

    if ($success) {
        return $idUUID;
    }
    return null;
}


function getAllRecipesFromAuthenticatedUser()
{
    $userId = userId();

    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipes WHERE creator_id = ? and deleted_at is null;');
    $PDOStatement->bindValue(1, $userId);
    $PDOStatement->execute();
    $recipes = [];
    while ($recipesLits = $PDOStatement->fetch()) {
        $recipes[] = $recipesLits;
    }

    return $recipes;
}

function getPrivateRecipesByUserId($userId)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipes WHERE creator_id = ? and is_private = 1 and deleted_at is null;');
    $PDOStatement->bindValue(1, $userId);
    $PDOStatement->execute();
    $recipes = [];
    while ($recipesLits = $PDOStatement->fetch()) {
        $recipes[] = $recipesLits;
    }

    return $recipes;
}

function getRemovedRecipesByUserId($userId)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipes WHERE creator_id = ? and deleted_at is not null;');
    $PDOStatement->bindValue(1, $userId);
    $PDOStatement->execute();
    $recipes = [];
    while ($recipesLits = $PDOStatement->fetch()) {
        $recipes[] = $recipesLits;
    }

    return $recipes;
}

function getRecipesByUserId($userId)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipes WHERE creator_id = ? and is_private = 0 and deleted_at is null;');
    $PDOStatement->bindValue(1, $userId);
    $PDOStatement->execute();
    $recipes = [];
    while ($recipesLits = $PDOStatement->fetch()) {
        $recipes[] = $recipesLits;
    }

    return $recipes;
}

function getRecipeById($id)
{
    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipes WHERE id = ? and deleted_at is null;');
    $PDOStatement->bindValue(1, $id);
    $PDOStatement->execute();
    return $PDOStatement->fetch();
}

function getAllPublicRecipes()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM recipes WHERE is_private = 0 and deleted_at is null;');
    $recipes = [];
    while ($recipesLits = $PDOStatement->fetch()) {
        $recipes[] = $recipesLits;
    }

    return $recipes;
}

function getAllPrivatesRecipes()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM recipes WHERE is_private = 1 and deleted_at is null;');
    $recipes = [];
    while ($recipesLits = $PDOStatement->fetch()) {
        $recipes[] = $recipesLits;
    }

    return $recipes;
}

function getAllRemovedRecipes()
{
    $PDOStatement = $GLOBALS['pdo']->query('SELECT * FROM recipes WHERE deleted_at is not null;;');
    $recipes = [];
    while ($recipesLits = $PDOStatement->fetch()) {
        $recipes[] = $recipesLits;
    }

    return $recipes;
}

function updateRecipe($recipe)
{
    $sqlUpdate = "UPDATE  
            recipes SET
                title = :title, 
                description = :description,
                servings = :servings,
                execution_time = :execution_time,
                category_id = :category_id
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);
    return $PDOStatement->execute([
        ':id' => $recipe['recipe_id'],
        ':title' => $recipe['name'],
        ':description' => $recipe['description'],
        ':servings' => $recipe['servings'],
        ':execution_time' => $recipe['execution_time'],
        ':category_id' => $recipe['category_id']
    ]);
}

function updateRecipeDate($id)
{
    $sqlUpdate = "UPDATE  
            recipes SET
                updated_at = CURRENT_TIMESTAMP
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    return $PDOStatement->execute([
        ':id' => $id
    ]);
}

function getAllFavoriteRecipesFromAuthenticatedUser()
{
    $userId = userId();

    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT *
                                                FROM recipes
                                                WHERE id IN (
                                                    SELECT recipe_id
                                                    FROM recipesFavorites
                                                    WHERE user_id = ? AND deleted_at IS NULL
                                                );');
    $PDOStatement->bindValue(1, $userId);
    $PDOStatement->execute();
    $recipes = [];
    while ($recipesLits = $PDOStatement->fetch()) {
        $recipes[] = $recipesLits;
    }

    return $recipes;
}

function isRecipeFavorite($id)
{
    $userId = userId();

    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipesFavorites WHERE user_id = ? and recipe_id = ? and deleted_at is null LIMIT 1;');
    $PDOStatement->bindValue(1, $userId);
    $PDOStatement->bindValue(2, $id);
    $PDOStatement->execute();

    $recipe = $PDOStatement->fetch();

    return $recipe;
}

function getFavoriteRecipeById($id)
{
    $userId = userId();

    $PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM recipesFavorites WHERE user_id = ? and recipe_id = ? LIMIT 1;');
    $PDOStatement->bindValue(1, $userId);
    $PDOStatement->bindValue(2, $id);
    $PDOStatement->execute();

    $recipe = $PDOStatement->fetch();

    return $recipe;
}

function changeFavoriteRecipe($id)
{
    $recipe = getFavoriteRecipeById($id);

    if ($recipe) {
        if ($recipe['deleted_at'] == null) {
            $success = removeFavoriteRecipe($id);
        } else {
            $success = updateFavoriteRecipe($id);
        }
    } else {
        $success = addFavoriteRecipe($id);
    }

    return $success;
}

function addFavoriteRecipe($id)
{
    $userId = userId();

    $sqlCreate = "INSERT INTO 
    recipesFavorites (
        user_id,
        recipe_id
        ) 
    VALUES (
        :user_id,
        :recipe_id
    )";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
    $success = $PDOStatement->execute([
        ':user_id' => $userId,
        ':recipe_id' => $id
    ]);

    return $success;
}

function updateFavoriteRecipe($id)
{
    $userId = userId();

    $sqlUpdate = "UPDATE  
            recipesFavorites SET
                deleted_at = null
            WHERE recipe_id = :recipe_id and user_id = :user_id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':recipe_id' => $id,
        ':user_id' => $userId
    ]);

    return $success;
}

function updateRecipeImage($user, $image)
{
    $sqlUpdate = "UPDATE  
            recipes SET
                cover = :cover
            WHERE id = :id ;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':cover' => $image,
        ':id' => $user
    ]);

    return $success;
}

function removeFavoriteRecipe($id)
{
    $userId = userId();

    $sqlUpdate = "UPDATE  
            recipesFavorites SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE recipe_id = :recipe_id and user_id = :user_id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':recipe_id' => $id,
        ':user_id' => $userId
    ]);

    return $success;
}

function deleteRecipe($id)
{
    $sqlUpdate = "UPDATE  
            recipes SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':id' => $id
    ]);

    $sqlUpdate = "UPDATE  
            recipesFavorites SET
                deleted_at = CURRENT_TIMESTAMP
            WHERE recipe_id = :recipe_id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':recipe_id' => $id
    ]);

    return $success;
}

function changeRecipeStatus($req)
{
    $sqlUpdate = "UPDATE  
            recipes SET
                deleted_at = null
            WHERE id = :id and creator_id = :creator_id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':id' => $req['recipe_id'],
        ':creator_id' => $req['creator_id']
    ]);

    return $success;
}

function changeStateRecipe($id)
{
    $sqlUpdate = "UPDATE  
        recipes SET
            is_private = CASE WHEN is_private = true THEN false ELSE true END
        WHERE id = :id;";

    $PDOStatement = $GLOBALS['pdo']->prepare($sqlUpdate);

    $success = $PDOStatement->execute([
        ':id' => $id
    ]);

    return $success;
}
