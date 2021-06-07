<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210530124716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
CREATE TABLE user (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    is_active TINYINT DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE accessory_category(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE accessory (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    price DOUBLE(10 , 2 ),
    size VARCHAR(5),
    description TEXT,
    accessory_category_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (accessory_category_id)
        REFERENCES accessory_category (id)
);

CREATE TABLE dress_category (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE dress (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price DOUBLE(10 , 2 ),
    description TEXT,
    dress_category_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (dress_category_id)
        REFERENCES dress_category (id)
);

CREATE TABLE color (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE detail (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE promotion (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE dress_image (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
   dress_id int not null,
    foreign key (dress_id) references dress(id)
);

CREATE TABLE accessory_image (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
   accessory_id int not null,
    foreign key (accessory_id) references accessory(id)
);

CREATE TABLE dress_detail(
	dress_id int not null,
    detail_id int not null,
    foreign key (dress_id) references dress(id),
    foreign key (detail_id) references detail(id)
);

CREATE TABLE dress_promotion(
dress_id int not null,
promotion_id int not null,
foreign key(dress_id) references dress(id),
foreign key (promotion_id) references promotion(id) 
);

CREATE TABLE dress_category_promotion(
dress_category_id int not null,
promotion_id int not null,
foreign key(dress_category_id) references dress_category(id), 
foreign key(promotion_id) references promotion(id) 
);

CREATE TABLE dress_color(
	dress_id int not null,
    color_id int not null,
    foreign key (dress_id) references dress(id),
    foreign key (color_id) references color(id)
);

CREATE TABLE accessory_color(
accessory_id int not null,
color_id int not null,
foreign key (accessory_id) references accessory(id),
foreign key (color_id) references color(id)
);

CREATE TABLE accessory_detail(
accessory_id int not null,
detail_id int not null,
foreign key (accessory_id) references accessory(id),
foreign key (detail_id) references detail(id)
);

CREATE TABLE accessory_category_promotion (
    accessory_category_id INT NOT NULL,
    promotion_id INT NOT NULL,
    FOREIGN KEY (accessory_category_id)
        REFERENCES accessory_category (id),
    FOREIGN KEY (promotion_id)
        REFERENCES promotion (id)
);

CREATE TABLE accessory_promotion (
    accessory_id INT NOT NULL,
    promotion_id INT NOT NULL,
    FOREIGN KEY (accessory_id)
        REFERENCES accessory (id),
    FOREIGN KEY (promotion_id)
        REFERENCES promotion (id)
);

CREATE  TABLE size(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE dress_size(
    dress_id INT NOT NULL,
    size_id INT NOT NULL,
    FOREIGN KEY (dress_id) REFERENCES dress(id),
    FOREIGN KEY (size_id) REFERENCES size(id)
);
");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE `accessory_promotion`;");
        $this->addSql("DROP TABLE `accessory_category_promotion`;");
        $this->addSql("DROP TABLE `accessory_detail`;");
        $this->addSql("DROP TABLE `accessory_color`;");
        $this->addSql("DROP TABLE `dress_color`;");
        $this->addSql("DROP TABLE `dress_category_promotion`;");
        $this->addSql("DROP TABLE `dress_promotion`;");
        $this->addSql("DROP TABLE `dress_detail`;");
        $this->addSql("DROP TABLE `accessory_image`;");
        $this->addSql("DROP TABLE `dress_image`;");
        $this->addSql("DROP TABLE `promotion`;");
        $this->addSql("DROP TABLE `detail`;");
        $this->addSql("DROP TABLE `color`;");
        $this->addSql("DROP TABLE `dress`;");
        $this->addSql("DROP TABLE `dress_category`;");
        $this->addSql("DROP TABLE `accessory`;");
        $this->addSql("DROP TABLE `accessory_category`;");
        $this->addSql("DROP TABLE `user`;");
    }
}
