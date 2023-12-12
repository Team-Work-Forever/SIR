CREATE TABLE units (
    id int AUTO_INCREMENT,
    name varchar(25) NOT NULL,
    unit varchar(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT NULL,
  	primary key (id)
);

CREATE TABLE ingredients (
    id int AUTO_INCREMENT,
    name varchar(25) NOT NULL,
    price float,
    unit int NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT NULL,
  	primary key (id),
    constraint check_price_is_positive check((`price` > 0)),
    constraint unit_id_fk
        foreign key (unit)
            references units (id)
);

-- Users Table
CREATE TABLE users (
    id VARCHAR(36),
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL,
    display_name VARCHAR(25) NOT NULL,
    first_name VARCHAR(25) NOT NULL,
    last_name VARCHAR(25) NOT NULL,
    description TEXT NOT NULL,
    avatar_url TEXT NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT NULL,
  	primary key (id)
);

CREATE INDEX idx_display_name ON users (display_name);

-- Recipe Table

CREATE TABLE recipes (
    id VARCHAR(36),
    title VARCHAR(20) UNIQUE NOT NULL,
    execution_time date NOT NULL,
    servings VARCHAR(10) NOT NULL,
    cover text NOT NULL,
    is_private boolean default true,
    creator_id VARCHAR(36) NOT NULL,
    category int default 0,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT NULL,
  	primary key (id),
    constraint creator_id_fk
        foreign key (creator_id)
            references users (id)
);

CREATE TABLE recipeTips (
    id int AUTO_INCREMENT,
    name varchar(25) NOT NULL,
    description text NOT NULL,
    recipe_id varchar(36) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT NULL,
    primary key (id),
    constraint recipe_id_fk
        foreign key (recipe_id)
            references recipes (id)
);

CREATE TABLE recipesIngredients (
    id int AUTO_INCREMENT NOT NULL,
    recipe_id varchar(36) NOT NULL,
    ingredient_id int NOT NULL,
    quantity int DEFAULT 0,
    unit int NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT NULL,
    primary key (id, recipe_id),
    constraint check_quantity_is_positive check((`quantity` > 0)),
    constraint recipe_id_fk1
        foreign key (recipe_id)
            references recipes (id),
    constraint ingredient_id_fk
        foreign key (ingredient_id)
            references ingredients (id),
    constraint unit_fk
        foreign key (unit)
            references units (id)
);

CREATE TABLE recipesSteps (
    id int AUTO_INCREMENT NOT NULL,
    recipe_id varchar(36) NOT NULL,
    name varchar(25) NOT NULL,
    step_number int NOT NULL,
    description text NOT NULL,
    parent_step_id int DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT NULL,
    primary key (id, recipe_id),
    constraint parent_step_id_fk
        foreign key (parent_step_id)
            references recipesSteps (id),
    constraint recipe_id_fk2
        foreign key (recipe_id)
            references recipes (id)
);