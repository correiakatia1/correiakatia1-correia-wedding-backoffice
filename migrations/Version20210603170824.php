<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603170824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO dress_category (name)
VALUES ('Princesa'),('Sereia'),('Fluido'),('Linha A'),('Curto');");

        $this->addSql("INSERT INTO color (code)
VALUES ('#ffffff'),('#fffff0'),('#cc2525'),('#259acc'),('#cc25a8');");

        $this->addSql("INSERT INTO detail (name)
VALUES ('Brilho'),('Cetim'),('Renda'),('Ilusão'),('tule'),('Pérola'),('Costas em V'),('Costas Fechadas'),('Costas ilusão'),('Decote emv'),('Decote coração'),('Com flores');");

        $this->addSql("INSERT INTO size (name) VALUES('XS'),('S'),('M'),('L'),('XL'),('XXL');");
    }


    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
