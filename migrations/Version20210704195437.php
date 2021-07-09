<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210704195437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }


    public function up(Schema $schema): void
    {
        $this->addSql("
         CREATE TABLE schedule(
          id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
          name varchar(255) not null,
          last_name varchar(255) not null,
          email varchar(255) not null,
          contact varchar(255) not null,
          date datetime,
          wedding_date datetime,
          message text,
          dress_id int not null,
           foreign key (dress_id) references dress(id) 
         );
        ");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("drop table schedule");

    }
}
