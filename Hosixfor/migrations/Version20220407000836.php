<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407000836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, numc VARCHAR(255) NOT NULL, date_commande DATETIME NOT NULL, observation LONGTEXT DEFAULT NULL, totht DOUBLE PRECISION NOT NULL, tottva DOUBLE PRECISION NOT NULL, totttc DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_commande ADD article_id INT NOT NULL, ADD numc VARCHAR(50) NOT NULL, ADD prix_vente DOUBLE PRECISION NOT NULL, ADD tva INT NOT NULL');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B7294869C ON ligne_commande (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B7294869C');
        $this->addSql('DROP INDEX IDX_3170B74B7294869C ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande DROP article_id, DROP numc, DROP prix_vente, DROP tva');
    }
}
