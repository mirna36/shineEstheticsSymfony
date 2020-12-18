<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218112054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD entreprise VARCHAR(255) DEFAULT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD cpostal VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD pays VARCHAR(255) NOT NULL, ADD telephone VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP nom, DROP prenom, DROP entreprise, DROP adresse, DROP cpostal, DROP ville, DROP pays, DROP telephone');
    }
}
