<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201201315 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sous_cathegories (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_prestations ADD cathegories_id INT DEFAULT NULL, ADD sous_cathegories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles_prestations ADD CONSTRAINT FK_170DEFB0DC6AF8AB FOREIGN KEY (cathegories_id) REFERENCES cathegories (id)');
        $this->addSql('ALTER TABLE articles_prestations ADD CONSTRAINT FK_170DEFB0A150011F FOREIGN KEY (sous_cathegories_id) REFERENCES sous_cathegories (id)');
        $this->addSql('CREATE INDEX IDX_170DEFB0DC6AF8AB ON articles_prestations (cathegories_id)');
        $this->addSql('CREATE INDEX IDX_170DEFB0A150011F ON articles_prestations (sous_cathegories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_prestations DROP FOREIGN KEY FK_170DEFB0A150011F');
        $this->addSql('DROP TABLE sous_cathegories');
        $this->addSql('ALTER TABLE articles_prestations DROP FOREIGN KEY FK_170DEFB0DC6AF8AB');
        $this->addSql('DROP INDEX IDX_170DEFB0DC6AF8AB ON articles_prestations');
        $this->addSql('DROP INDEX IDX_170DEFB0A150011F ON articles_prestations');
        $this->addSql('ALTER TABLE articles_prestations DROP cathegories_id, DROP sous_cathegories_id');
    }
}
