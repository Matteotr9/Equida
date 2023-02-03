<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203111521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_de_vente (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_de_vente_vente (categorie_de_vente_id INT NOT NULL, vente_id INT NOT NULL, INDEX IDX_78EF2443D6B4FBAF (categorie_de_vente_id), INDEX IDX_78EF24437DC7170A (vente_id), PRIMARY KEY(categorie_de_vente_id, vente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_categorie_de_vente (client_id INT NOT NULL, categorie_de_vente_id INT NOT NULL, INDEX IDX_9605F6319EB6921 (client_id), INDEX IDX_9605F63D6B4FBAF (categorie_de_vente_id), PRIMARY KEY(client_id, categorie_de_vente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_de_vente_vente ADD CONSTRAINT FK_78EF2443D6B4FBAF FOREIGN KEY (categorie_de_vente_id) REFERENCES categorie_de_vente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_de_vente_vente ADD CONSTRAINT FK_78EF24437DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_categorie_de_vente ADD CONSTRAINT FK_9605F6319EB6921 FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_categorie_de_vente ADD CONSTRAINT FK_9605F63D6B4FBAF FOREIGN KEY (categorie_de_vente_id) REFERENCES categorie_de_vente (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_de_vente_vente DROP FOREIGN KEY FK_78EF2443D6B4FBAF');
        $this->addSql('ALTER TABLE categorie_de_vente_vente DROP FOREIGN KEY FK_78EF24437DC7170A');
        $this->addSql('ALTER TABLE client_categorie_de_vente DROP FOREIGN KEY FK_9605F6319EB6921');
        $this->addSql('ALTER TABLE client_categorie_de_vente DROP FOREIGN KEY FK_9605F63D6B4FBAF');
        $this->addSql('DROP TABLE categorie_de_vente');
        $this->addSql('DROP TABLE categorie_de_vente_vente');
        $this->addSql('DROP TABLE client_categorie_de_vente');
    }
}
