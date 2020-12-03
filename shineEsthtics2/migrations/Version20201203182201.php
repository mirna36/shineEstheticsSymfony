<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203182201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_prestations DROP FOREIGN KEY FK_170DEFB0A150011F');
        $this->addSql('ALTER TABLE articles_prestations DROP FOREIGN KEY FK_170DEFB0DC6AF8AB');
        $this->addSql('DROP INDEX IDX_170DEFB0DC6AF8AB ON articles_prestations');
        $this->addSql('DROP INDEX IDX_170DEFB0A150011F ON articles_prestations');
        $this->addSql('ALTER TABLE articles_prestations ADD categories_id INT DEFAULT NULL, ADD sous_categories_id INT DEFAULT NULL, DROP cathegories_id, DROP sous_cathegories_id');
        $this->addSql('ALTER TABLE articles_prestations ADD CONSTRAINT FK_170DEFB0A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE articles_prestations ADD CONSTRAINT FK_170DEFB09F751138 FOREIGN KEY (sous_categories_id) REFERENCES sous_categories (id)');
        $this->addSql('CREATE INDEX IDX_170DEFB0A21214B7 ON articles_prestations (categories_id)');
        $this->addSql('CREATE INDEX IDX_170DEFB09F751138 ON articles_prestations (sous_categories_id)');
        $this->addSql('ALTER TABLE piece_jointe CHANGE image_name image_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_prestations DROP FOREIGN KEY FK_170DEFB0A21214B7');
        $this->addSql('ALTER TABLE articles_prestations DROP FOREIGN KEY FK_170DEFB09F751138');
        $this->addSql('DROP INDEX IDX_170DEFB0A21214B7 ON articles_prestations');
        $this->addSql('DROP INDEX IDX_170DEFB09F751138 ON articles_prestations');
        $this->addSql('ALTER TABLE articles_prestations ADD cathegories_id INT DEFAULT NULL, ADD sous_cathegories_id INT DEFAULT NULL, DROP categories_id, DROP sous_categories_id');
        $this->addSql('ALTER TABLE articles_prestations ADD CONSTRAINT FK_170DEFB0A150011F FOREIGN KEY (sous_cathegories_id) REFERENCES sous_categories (id)');
        $this->addSql('ALTER TABLE articles_prestations ADD CONSTRAINT FK_170DEFB0DC6AF8AB FOREIGN KEY (cathegories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_170DEFB0DC6AF8AB ON articles_prestations (cathegories_id)');
        $this->addSql('CREATE INDEX IDX_170DEFB0A150011F ON articles_prestations (sous_cathegories_id)');
        $this->addSql('ALTER TABLE piece_jointe CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
