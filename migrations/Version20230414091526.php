<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230414091526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente ADD categorie_de_ventes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CA1CEB7A7 FOREIGN KEY (categorie_de_ventes_id) REFERENCES categorie_de_vente (id)');
        $this->addSql('CREATE INDEX IDX_888A2A4CA1CEB7A7 ON vente (categorie_de_ventes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4CA1CEB7A7');
        $this->addSql('DROP INDEX IDX_888A2A4CA1CEB7A7 ON vente');
        $this->addSql('ALTER TABLE vente DROP categorie_de_ventes_id');
    }
}
