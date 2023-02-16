<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203111120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enchere (id INT AUTO_INCREMENT NOT NULL, lot_id INT DEFAULT NULL, client_id INT DEFAULT NULL, montant NUMERIC(10, 2) NOT NULL, INDEX IDX_38D1870FA8CBA5F7 (lot_id), INDEX IDX_38D1870F19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE catégorie_de_vente');
        $this->addSql('DROP TABLE enchère');
        $this->addSql('ALTER TABLE cheval ADD client_id INT NOT NULL, ADD race_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cheval ADD CONSTRAINT FK_F286849D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE cheval ADD CONSTRAINT FK_F286849D6E59D40D FOREIGN KEY (race_id) REFERENCES race_de_cheval (id)');
        $this->addSql('CREATE INDEX IDX_F286849D19EB6921 ON cheval (client_id)');
        $this->addSql('CREATE INDEX IDX_F286849D6E59D40D ON cheval (race_id)');
        $this->addSql('ALTER TABLE client ADD pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_C7440455A6E44244 ON client (pays_id)');
        $this->addSql('ALTER TABLE lot ADD cheval_id INT DEFAULT NULL, ADD vente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291BC8BE953B FOREIGN KEY (cheval_id) REFERENCES cheval (id)');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('CREATE INDEX IDX_B81291BC8BE953B ON lot (cheval_id)');
        $this->addSql('CREATE INDEX IDX_B81291B7DC7170A ON lot (vente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catégorie_de_vente (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE enchère (id INT AUTO_INCREMENT NOT NULL, montant NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FA8CBA5F7');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F19EB6921');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('ALTER TABLE cheval DROP FOREIGN KEY FK_F286849D19EB6921');
        $this->addSql('ALTER TABLE cheval DROP FOREIGN KEY FK_F286849D6E59D40D');
        $this->addSql('DROP INDEX IDX_F286849D19EB6921 ON cheval');
        $this->addSql('DROP INDEX IDX_F286849D6E59D40D ON cheval');
        $this->addSql('ALTER TABLE cheval DROP client_id, DROP race_id');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A6E44244');
        $this->addSql('DROP INDEX IDX_C7440455A6E44244 ON client');
        $this->addSql('ALTER TABLE client DROP pays_id');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291BC8BE953B');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291B7DC7170A');
        $this->addSql('DROP INDEX IDX_B81291BC8BE953B ON lot');
        $this->addSql('DROP INDEX IDX_B81291B7DC7170A ON lot');
        $this->addSql('ALTER TABLE lot DROP cheval_id, DROP vente_id');
    }
}
