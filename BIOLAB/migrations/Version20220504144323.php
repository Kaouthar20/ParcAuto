<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504144323 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE banque (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(5) NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE corresp_analyse (id INT AUTO_INCREMENT NOT NULL, organisme_id INT NOT NULL, groupe INT NOT NULL, nbre INT NOT NULL, nbr_b INT NOT NULL, libelle VARCHAR(50) DEFAULT NULL, code_analyse VARCHAR(50) DEFAULT NULL, INDEX IDX_A42F34585DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devise (id INT AUTO_INCREMENT NOT NULL, devise_name VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_lg (id INT AUTO_INCREMENT NOT NULL, code_analyse_id INT NOT NULL, dossier_id BIGINT DEFAULT NULL, libelle VARCHAR(50) NOT NULL, statut_hn VARCHAR(20) NOT NULL, lettre VARCHAR(5) NOT NULL, nbre_b DOUBLE PRECISION NOT NULL, nbre INT NOT NULL, code_tarif INT NOT NULL, tarif_prix DOUBLE PRECISION NOT NULL, montant DOUBLE PRECISION NOT NULL, extern VARCHAR(50) NOT NULL, lieu_ext VARCHAR(50) NOT NULL, code_nomenc INT NOT NULL, taux_tp INT NOT NULL, pec TINYINT(1) DEFAULT NULL, maj TINYINT(1) DEFAULT NULL, remboursemment TINYINT(1) NOT NULL, date_syst DATE DEFAULT NULL, INDEX IDX_8562A9A93650FB59 (code_analyse_id), INDEX IDX_8562A9A9611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossiers (id BIGINT AUTO_INCREMENT NOT NULL, organisme_id INT NOT NULL, tarif_id INT NOT NULL, user_id INT DEFAULT NULL, date_dossier DATE NOT NULL, heure DATETIME NOT NULL, ipp INT NOT NULL, titre VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_nais DATE NOT NULL, age INT DEFAULT NULL, sex VARCHAR(10) NOT NULL, cin VARCHAR(20) DEFAULT NULL, telephone VARCHAR(16) NOT NULL, adress1 VARCHAR(255) DEFAULT NULL, adress2 VARCHAR(255) DEFAULT NULL, ville VARCHAR(30) DEFAULT NULL, prescripteur VARCHAR(20) DEFAULT NULL, organisme_nom VARCHAR(255) NOT NULL, tarif_org VARCHAR(255) NOT NULL, nbre_b INT NOT NULL, prix_b DOUBLE PRECISION NOT NULL, motif INT NOT NULL, obs VARCHAR(50) DEFAULT NULL, montant_isd DOUBLE PRECISION NOT NULL, mont_pre DOUBLE PRECISION NOT NULL, mont_sup DOUBLE PRECISION NOT NULL, mont_div DOUBLE PRECISION NOT NULL, mont_lab DOUBLE PRECISION NOT NULL, mont_ext DOUBLE PRECISION NOT NULL, montant_hnso DOUBLE PRECISION NOT NULL, mont_total DOUBLE PRECISION NOT NULL, mont_idt DOUBLE PRECISION NOT NULL, mont_cl DOUBLE PRECISION NOT NULL, mont_org DOUBLE PRECISION NOT NULL, annuler TINYINT(1) NOT NULL, date_sys DATE DEFAULT NULL, INDEX IDX_A38E22E45DDD38F5 (organisme_id), INDEX IDX_A38E22E4357C0A59 (tarif_id), INDEX IDX_A38E22E4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motif_imp (id INT AUTO_INCREMENT NOT NULL, motif VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mtencreg (id INT AUTO_INCREMENT NOT NULL, operation_id INT NOT NULL, paiement_id INT NOT NULL, som_montant DOUBLE PRECISION NOT NULL, INDEX IDX_FD6A463444AC3583 (operation_id), INDEX IDX_FD6A46342A4C4478 (paiement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operations (id INT AUTO_INCREMENT NOT NULL, dossier_id BIGINT DEFAULT NULL, organisme_id INT DEFAULT NULL, part_id INT DEFAULT NULL, user_id INT DEFAULT NULL, typ_ope VARCHAR(100) NOT NULL, date_ope DATE NOT NULL, heure_ope DATETIME NOT NULL, remise DOUBLE PRECISION NOT NULL, sens INT NOT NULL, montant DOUBLE PRECISION NOT NULL, be INT DEFAULT NULL, date_be DATE DEFAULT NULL, statut_chq_avc TINYINT(1) NOT NULL, date_syst DATE NOT NULL, INDEX IDX_28145348611C0C56 (dossier_id), INDEX IDX_281453485DDD38F5 (organisme_id), INDEX IDX_281453484CE34BEC (part_id), INDEX IDX_28145348A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, lebelle VARCHAR(255) NOT NULL, tiers VARCHAR(255) NOT NULL, remise DOUBLE PRECISION DEFAULT NULL, pec TINYINT(1) DEFAULT NULL, rectif TINYINT(1) DEFAULT NULL, x_facture TINYINT(1) DEFAULT NULL, date_syst DATE DEFAULT NULL, INDEX IDX_DD0F4533A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme_lg (id INT AUTO_INCREMENT NOT NULL, organisme_id INT NOT NULL, tarif DOUBLE PRECISION DEFAULT NULL, part_adherent DOUBLE PRECISION DEFAULT NULL, part_organisme DOUBLE PRECISION DEFAULT NULL, INDEX IDX_B9A39D0A5DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, mode VARCHAR(20) NOT NULL, code VARCHAR(50) NOT NULL, statut TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pbordereau_pec (id INT AUTO_INCREMENT NOT NULL, dossier_id BIGINT NOT NULL, operation_id INT NOT NULL, statut_id INT NOT NULL, user_id INT NOT NULL, be INT DEFAULT NULL, date_be DATE DEFAULT NULL, motif VARCHAR(100) DEFAULT NULL, obs VARCHAR(50) DEFAULT NULL, date_sys DATE DEFAULT NULL, INDEX IDX_A9C44376611C0C56 (dossier_id), INDEX IDX_A9C4437644AC3583 (operation_id), INDEX IDX_A9C44376F6203804 (statut_id), UNIQUE INDEX UNIQ_A9C44376A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ppec (id INT AUTO_INCREMENT NOT NULL, dossier_id BIGINT NOT NULL, user_id INT NOT NULL, num_pec VARCHAR(50) NOT NULL, date_pec DATE NOT NULL, matricule VARCHAR(50) NOT NULL, adherent VARCHAR(50) NOT NULL, beneficiaire VARCHAR(255) NOT NULL, reference VARCHAR(100) NOT NULL, date_sys DATE NOT NULL, INDEX IDX_D2BBB8D0611C0C56 (dossier_id), INDEX IDX_D2BBB8D0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pstatut_pec (id INT AUTO_INCREMENT NOT NULL, statut VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reglement (id INT AUTO_INCREMENT NOT NULL, opration_id INT NOT NULL, devise_id INT DEFAULT NULL, paiement_id INT DEFAULT NULL, banque_id INT DEFAULT NULL, statut_user_id INT DEFAULT NULL, date_oper DATE NOT NULL, heure DATETIME NOT NULL, date_regl DATE NOT NULL, heur_regl DATETIME NOT NULL, sens INT DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, date_cheq DATE NOT NULL, date_ech DATE NOT NULL, place VARCHAR(50) DEFAULT NULL, reference VARCHAR(50) DEFAULT NULL, reference_regl VARCHAR(50) NOT NULL, titulaire VARCHAR(50) DEFAULT NULL, type_regl VARCHAR(50) DEFAULT NULL, impayer TINYINT(1) DEFAULT NULL, statut_cheq_avec VARCHAR(100) NOT NULL, be_banq VARCHAR(255) DEFAULT NULL, date_be_banq DATE DEFAULT NULL, be_repart_banq VARCHAR(255) DEFAULT NULL, littrage VARCHAR(255) DEFAULT NULL, date_littrage DATE DEFAULT NULL, date_remise DATE DEFAULT NULL, date_valeur DATE DEFAULT NULL, reference_relv VARCHAR(255) DEFAULT NULL, INDEX IDX_EBE4C14CF2B1CBD8 (opration_id), INDEX IDX_EBE4C14CF4445056 (devise_id), INDEX IDX_EBE4C14C2A4C4478 (paiement_id), INDEX IDX_EBE4C14C37E080D9 (banque_id), UNIQUE INDEX UNIQ_EBE4C14CCBDFC9D9 (statut_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rubrique (id INT AUTO_INCREMENT NOT NULL, rubrique VARCHAR(255) NOT NULL, part TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, lettre VARCHAR(5) NOT NULL, tarif DOUBLE PRECISION NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, sur_nom VARCHAR(50) DEFAULT NULL, mot_pass VARCHAR(20) NOT NULL, ordre INT NOT NULL, demarrage VARCHAR(30) NOT NULL, date_syst DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE corresp_analyse ADD CONSTRAINT FK_A42F34585DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id)');
        $this->addSql('ALTER TABLE dossier_lg ADD CONSTRAINT FK_8562A9A93650FB59 FOREIGN KEY (code_analyse_id) REFERENCES corresp_analyse (id)');
        $this->addSql('ALTER TABLE dossier_lg ADD CONSTRAINT FK_8562A9A9611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossiers (id)');
        $this->addSql('ALTER TABLE dossiers ADD CONSTRAINT FK_A38E22E45DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id)');
        $this->addSql('ALTER TABLE dossiers ADD CONSTRAINT FK_A38E22E4357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('ALTER TABLE dossiers ADD CONSTRAINT FK_A38E22E4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mtencreg ADD CONSTRAINT FK_FD6A463444AC3583 FOREIGN KEY (operation_id) REFERENCES operations (id)');
        $this->addSql('ALTER TABLE mtencreg ADD CONSTRAINT FK_FD6A46342A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
        $this->addSql('ALTER TABLE operations ADD CONSTRAINT FK_28145348611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossiers (id)');
        $this->addSql('ALTER TABLE operations ADD CONSTRAINT FK_281453485DDD38F5 FOREIGN KEY (organisme_id) REFERENCES operations (id)');
        $this->addSql('ALTER TABLE operations ADD CONSTRAINT FK_281453484CE34BEC FOREIGN KEY (part_id) REFERENCES organisme_lg (id)');
        $this->addSql('ALTER TABLE operations ADD CONSTRAINT FK_28145348A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE organisme ADD CONSTRAINT FK_DD0F4533A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE organisme_lg ADD CONSTRAINT FK_B9A39D0A5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id)');
        $this->addSql('ALTER TABLE pbordereau_pec ADD CONSTRAINT FK_A9C44376611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossiers (id)');
        $this->addSql('ALTER TABLE pbordereau_pec ADD CONSTRAINT FK_A9C4437644AC3583 FOREIGN KEY (operation_id) REFERENCES operations (id)');
        $this->addSql('ALTER TABLE pbordereau_pec ADD CONSTRAINT FK_A9C44376F6203804 FOREIGN KEY (statut_id) REFERENCES pstatut_pec (id)');
        $this->addSql('ALTER TABLE pbordereau_pec ADD CONSTRAINT FK_A9C44376A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ppec ADD CONSTRAINT FK_D2BBB8D0611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossiers (id)');
        $this->addSql('ALTER TABLE ppec ADD CONSTRAINT FK_D2BBB8D0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14CF2B1CBD8 FOREIGN KEY (opration_id) REFERENCES operations (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14CF4445056 FOREIGN KEY (devise_id) REFERENCES devise (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C2A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C37E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14CCBDFC9D9 FOREIGN KEY (statut_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C37E080D9');
        $this->addSql('ALTER TABLE dossier_lg DROP FOREIGN KEY FK_8562A9A93650FB59');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14CF4445056');
        $this->addSql('ALTER TABLE dossier_lg DROP FOREIGN KEY FK_8562A9A9611C0C56');
        $this->addSql('ALTER TABLE operations DROP FOREIGN KEY FK_28145348611C0C56');
        $this->addSql('ALTER TABLE pbordereau_pec DROP FOREIGN KEY FK_A9C44376611C0C56');
        $this->addSql('ALTER TABLE ppec DROP FOREIGN KEY FK_D2BBB8D0611C0C56');
        $this->addSql('ALTER TABLE mtencreg DROP FOREIGN KEY FK_FD6A463444AC3583');
        $this->addSql('ALTER TABLE operations DROP FOREIGN KEY FK_281453485DDD38F5');
        $this->addSql('ALTER TABLE pbordereau_pec DROP FOREIGN KEY FK_A9C4437644AC3583');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14CF2B1CBD8');
        $this->addSql('ALTER TABLE corresp_analyse DROP FOREIGN KEY FK_A42F34585DDD38F5');
        $this->addSql('ALTER TABLE dossiers DROP FOREIGN KEY FK_A38E22E45DDD38F5');
        $this->addSql('ALTER TABLE organisme_lg DROP FOREIGN KEY FK_B9A39D0A5DDD38F5');
        $this->addSql('ALTER TABLE operations DROP FOREIGN KEY FK_281453484CE34BEC');
        $this->addSql('ALTER TABLE mtencreg DROP FOREIGN KEY FK_FD6A46342A4C4478');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C2A4C4478');
        $this->addSql('ALTER TABLE pbordereau_pec DROP FOREIGN KEY FK_A9C44376F6203804');
        $this->addSql('ALTER TABLE dossiers DROP FOREIGN KEY FK_A38E22E4357C0A59');
        $this->addSql('ALTER TABLE dossiers DROP FOREIGN KEY FK_A38E22E4A76ED395');
        $this->addSql('ALTER TABLE operations DROP FOREIGN KEY FK_28145348A76ED395');
        $this->addSql('ALTER TABLE organisme DROP FOREIGN KEY FK_DD0F4533A76ED395');
        $this->addSql('ALTER TABLE pbordereau_pec DROP FOREIGN KEY FK_A9C44376A76ED395');
        $this->addSql('ALTER TABLE ppec DROP FOREIGN KEY FK_D2BBB8D0A76ED395');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14CCBDFC9D9');
        $this->addSql('DROP TABLE banque');
        $this->addSql('DROP TABLE corresp_analyse');
        $this->addSql('DROP TABLE devise');
        $this->addSql('DROP TABLE dossier_lg');
        $this->addSql('DROP TABLE dossiers');
        $this->addSql('DROP TABLE motif_imp');
        $this->addSql('DROP TABLE mtencreg');
        $this->addSql('DROP TABLE operations');
        $this->addSql('DROP TABLE organisme');
        $this->addSql('DROP TABLE organisme_lg');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE pbordereau_pec');
        $this->addSql('DROP TABLE ppec');
        $this->addSql('DROP TABLE pstatut_pec');
        $this->addSql('DROP TABLE reglement');
        $this->addSql('DROP TABLE rubrique');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('DROP TABLE user');
    }
}
