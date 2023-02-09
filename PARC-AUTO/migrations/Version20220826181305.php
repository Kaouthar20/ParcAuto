<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220826181305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE facture ADD mission_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission_cab (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE866410BE6CAE90 ON facture (mission_id)');
    }

    public function down(Schema $schema): void
    {

        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410BE6CAE90');
        $this->addSql('DROP INDEX UNIQ_FE866410BE6CAE90 ON facture');
        $this->addSql('ALTER TABLE facture DROP mission_id');
    }
}
