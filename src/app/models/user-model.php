<?php

class UserModel
{
    private string $id;
    private string $email;
    private string $display_name;
    private string $first_name;
    private string $last_name;
    private string $description;
    private $avatar;

    public function __construct(string $id, string $email, string $display_name, string $first_name, string $last_name, string $description, $avatar)
    {
        $this->id = $id;
        $this->email = $email;
        $this->display_name = $display_name;
        $this->description = $description;
        $this->avatar = $avatar;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }
    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }
}
