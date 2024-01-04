<?php
require_once __DIR__ . '../../db/connection.php';

function seed()
{
    try {

        $checkQuery = "SELECT COUNT(*) FROM genders";
        $checkStatement = $GLOBALS['pdo']->query($checkQuery);
        $dataExists = ($checkStatement->fetchColumn() > 0);

        if (!$dataExists) {
            $genders = ['Masculino', 'Feminino', 'Outro', 'Prefiro não divulgar'];

            $sqlCreate = "INSERT INTO 
            genders (
                name
                ) 
            VALUES (
                :name
            )";
            $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

            foreach ($genders as $gender) {
                $success = $PDOStatement->execute([
                    ':name' => $gender
                ]);
            }
        }

        $checkQuery = "SELECT COUNT(*) FROM categories";
        $checkStatement = $GLOBALS['pdo']->query($checkQuery);
        $dataExists = ($checkStatement->fetchColumn() > 0);

        if (!$dataExists) {
            $categories = ['Sobremesa', 'Peixe', 'Carne', 'Vegetariano'];

            $sqlCreate = "INSERT INTO 
        categories (
            name
            ) 
        VALUES (
            :name
        )";

            $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

            foreach ($categories as $category) {
                $success = $PDOStatement->execute([
                    ':name' => $category
                ]);
            }
        }

        $checkQuery = "SELECT COUNT(*) FROM units";
        $checkStatement = $GLOBALS['pdo']->query($checkQuery);
        $dataExists = ($checkStatement->fetchColumn() > 0);

        if (!$dataExists) {
            $units = [['Gramas', 'g'], ['Mililitros', 'ml'], ['Litros', 'l']];

            $sqlCreate = "INSERT INTO 
        units (
            name, 
            unit
            ) 
        VALUES (
            :name, 
            :unit
        )";

            $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

            foreach ($units as $unit) {
                $success = $PDOStatement->execute([
                    ':name' => $unit[0],
                    ':unit' => $unit[1]
                ]);
            }
        }

        $checkQuery = "SELECT COUNT(*) FROM ingredients";
        $checkStatement = $GLOBALS['pdo']->query($checkQuery);
        $dataExists = ($checkStatement->fetchColumn() > 0);

        if (!$dataExists) {
            $ingredients = [['Açucar', 1.99, 1], ['Leite Gordo', 2.49, 3], ['Leite Achocolatado', 0.99, 2]];

            $sqlCreate = "INSERT INTO
        ingredients (
            name,
            price,
            unit
            )
        VALUES (
            :name,
            :price,
            :unit
        )";

            $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

            foreach ($ingredients as $ingredient) {
                $success = $PDOStatement->execute([
                    ':name' => $ingredient[0],
                    ':price' => $ingredient[1],
                    ':unit' => $ingredient[2]
                ]);
            }
        }


        $checkQuery = "SELECT COUNT(*) FROM images";
        $checkStatement = $GLOBALS['pdo']->query($checkQuery);
        $dataExists = ($checkStatement->fetchColumn() > 0);

        if (!$dataExists) {

            $publicDirectory = dirname(__DIR__, 3) . '/public';

            $imageRelativePath = '/assets/default.jpg';

            $imagePath = $publicDirectory . $imageRelativePath;

            $imageData = file_get_contents($imagePath);

            $sqlCreate = "INSERT INTO
            images (
                id,
                name,
                content,
                type
                )
            VALUES (
                :id,
                :name,
                :content,
                :type
            )";

            $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

            $success = $PDOStatement->execute([
                ':id' => 'c93a0f1a-50fd-d119-f984-c7edd07ca624',
                ':name' => 'default.jpg',
                ':content' => $imageData,
                ':type' => 'image/jpeg'
            ]);
        }

        $checkQuery = "SELECT COUNT(*) FROM users";
        $checkStatement = $GLOBALS['pdo']->query($checkQuery);
        $dataExists = ($checkStatement->fetchColumn() > 0);

        if (!$dataExists) {
            $sqlCreate = "INSERT INTO users (
            id,
            email, 
            password, 
            salt, 
            display_name, 
            first_name, 
            last_name, 
            description, 
            avatar,
            birth_date,
            gender_id,
            is_admin
        ) VALUES (
            :id,
            :email, 
            :password, 
            :salt, 
            :display_name, 
            :first_name, 
            :last_name, 
            :description, 
            :avatar,
            :birth_date,
            :gender_id,
            :is_admin
        )";

            $password = password_hash('123456', PASSWORD_DEFAULT);
            $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);
            $success = $PDOStatement->execute([
                ':id' => '42bb9166-e055-fab5-7998-52a1ce7e80dc',
                ':email' => 'admin@ipvc.pt',
                ':password' => $password,
                ':salt' => $password,
                ':display_name' => 'Quim Barreiros',
                ':first_name' => 'Quim',
                ':last_name' => 'Barreiros',
                ':description' => '',
                ':avatar' => 'c93a0f1a-50fd-d119-f984-c7edd07ca624',
                ':birth_date' => '15/12/2023',
                ':gender_id' => 1,
                ':is_admin' => true
            ]);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
