<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504134529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_client ADD phone_standard NVARCHAR(30)');
        $this->addSql('ALTER TABLE fiche_client ADD phone_standard_tel INT');
        $this->addSql('ALTER TABLE fiche_client ADD phone_portable NVARCHAR(30)');
        $this->addSql('ALTER TABLE fiche_client ADD phone_portable_tel INT');
        $this->addSql('ALTER TABLE fiche_client ADD fax_standard NVARCHAR(30)');
        $this->addSql('ALTER TABLE fiche_client ADD email_standard NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD appel_client INT');
        $this->addSql('ALTER TABLE fiche_client ADD appel_lundi INT');
        $this->addSql('ALTER TABLE fiche_client ADD horaire_lundi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD appel_mardi INT');
        $this->addSql('ALTER TABLE fiche_client ADD horaire_mardi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD appel_mercredi INT');
        $this->addSql('ALTER TABLE fiche_client ADD horaire_mercredi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD appel_jeudi INT');
        $this->addSql('ALTER TABLE fiche_client ADD horaire_jeudi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD appel_vendredi INT');
        $this->addSql('ALTER TABLE fiche_client ADD horaire_vendredi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD appel_samedi INT');
        $this->addSql('ALTER TABLE fiche_client ADD horaire_samedi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD email_facture NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD tarif_client NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD envoi_tarif_auto INT');
        $this->addSql('ALTER TABLE fiche_client ADD date1_livraison DATE');
        $this->addSql('ALTER TABLE fiche_client ADD pvc INT');
        $this->addSql('ALTER TABLE fiche_client ADD coef_pvc NVARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN phone_standard');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN phone_standard_tel');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN phone_portable');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN phone_portable_tel');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN fax_standard');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN email_standard');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN appel_client');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN appel_lundi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN horaire_lundi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN appel_mardi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN horaire_mardi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN appel_mercredi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN horaire_mercredi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN appel_jeudi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN horaire_jeudi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN appel_vendredi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN horaire_vendredi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN appel_samedi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN horaire_samedi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN email_facture');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN tarif_client');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN envoi_tarif_auto');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN date1_livraison');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN pvc');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN coef_pvc');
    }
}
