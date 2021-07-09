<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624183826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $encoder = new MessageDigestPasswordEncoder();

        $password = $encoder->encodePassword('123456', null);

        $this->addSql("INSERT INTO user (`name`, `email`, `password`, `is_active`) 
VALUES ('Katia Correia', 'katia@email.com', '$password', 1);");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DELETE FROM user where 1");
    }
}
