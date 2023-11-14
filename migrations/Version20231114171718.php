<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114171718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD update_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE product DROP image');
        $this->addSql('COMMENT ON COLUMN product.update_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product DROP image_name');
        $this->addSql('ALTER TABLE product DROP image_size');
        $this->addSql('ALTER TABLE product DROP update_at');
    }
}
