<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231112102949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE promo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, admin_id INT NOT NULL, category_id INT NOT NULL, promo_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(2, 2) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD642B8210 ON product (admin_id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADD0C07AFF ON product (promo_id)');
        $this->addSql('CREATE TABLE promo (id INT NOT NULL, date_start DATE NOT NULL, date_finish DATE NOT NULL, pourcentage DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN promo.date_start IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN promo.date_finish IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADD0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE promo_id_seq CASCADE');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD642B8210');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADD0C07AFF');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE promo');
    }
}
