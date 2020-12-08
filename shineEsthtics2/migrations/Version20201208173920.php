<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208173920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_prestations ADD shop_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles_prestations ADD CONSTRAINT FK_170DEFB04D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('CREATE INDEX IDX_170DEFB04D16C4DD ON articles_prestations (shop_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_prestations DROP FOREIGN KEY FK_170DEFB04D16C4DD');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP INDEX IDX_170DEFB04D16C4DD ON articles_prestations');
        $this->addSql('ALTER TABLE articles_prestations DROP shop_id');
    }
}
