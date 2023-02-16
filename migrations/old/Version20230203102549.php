<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203102549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catégorie_de_vente (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cheval (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, race_id INT DEFAULT NULL, nom VARCHAR(40) NOT NULL, sire INT NOT NULL, sexe VARCHAR(1) NOT NULL, prix_de_depart NUMERIC(2, 2) DEFAULT NULL, INDEX IDX_F286849D19EB6921 (client_id), INDEX IDX_F286849D6E59D40D (race_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(40) NOT NULL, prenom VARCHAR(40) NOT NULL, date_de_naissance DATE NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchère (id INT AUTO_INCREMENT NOT NULL, montant NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lot (id INT AUTO_INCREMENT NOT NULL, cheval_id INT DEFAULT NULL, vente_id INT DEFAULT NULL, mise_à_prix NUMERIC(10, 2) NOT NULL, INDEX IDX_B81291BC8BE953B (cheval_id), INDEX IDX_B81291B7DC7170A (vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race_de_cheval (id INT AUTO_INCREMENT NOT NULL, libellle VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE DEFAULT NULL, date_vente DATE DEFAULT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cheval ADD CONSTRAINT FK_F286849D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE cheval ADD CONSTRAINT FK_F286849D6E59D40D FOREIGN KEY (race_id) REFERENCES race_de_cheval (id)');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291BC8BE953B FOREIGN KEY (cheval_id) REFERENCES cheval (id)');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cheval DROP FOREIGN KEY FK_F286849D19EB6921');
        $this->addSql('ALTER TABLE cheval DROP FOREIGN KEY FK_F286849D6E59D40D');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291BC8BE953B');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291B7DC7170A');
        $this->addSql('DROP TABLE catégorie_de_vente');
        $this->addSql('DROP TABLE cheval');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE enchère');
        $this->addSql('DROP TABLE lot');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE race_de_cheval');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
