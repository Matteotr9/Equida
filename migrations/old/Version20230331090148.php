<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331090148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cheval ADD image LONGTEXT NOT NULL, CHANGE prix_de_depart prix_de_depart DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE lot ADD mise_aprix DOUBLE PRECISION NOT NULL, DROP mise_à_prix');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cheval DROP image, CHANGE prix_de_depart prix_de_depart NUMERIC(2, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE lot ADD mise_à_prix NUMERIC(10, 2) NOT NULL, DROP mise_aprix');
    }
}
