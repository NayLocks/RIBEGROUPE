<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505073108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_client ADD ct_dir_nom NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_dir_tel NVARCHAR(30)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_dir_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_compta_nom NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_compta_tel NVARCHAR(30)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_compta_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_com_nom NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_com_tel NVARCHAR(30)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_com_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_qua_nom NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_qua_tel NVARCHAR(30)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_qua_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_sec_nom NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_sec_tel NVARCHAR(30)');
        $this->addSql('ALTER TABLE fiche_client ADD ct_sec_mail NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD tr_lundi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD tr_mardi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD tr_mercredi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD tr_jeudi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD tr_vendredi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD tr_samedi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD rg_lundi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD rg_mardi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD rg_mercredi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD rg_jeudi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD rg_vendredi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD rg_samedi NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD plage_horaire NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD latitude NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD longitude NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD bp NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD bl NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_dir_nom');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_dir_tel');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_dir_mail');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_compta_nom');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_compta_tel');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_compta_mail');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_com_nom');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_com_tel');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_com_mail');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_qua_nom');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_qua_tel');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_qua_mail');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_sec_nom');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_sec_tel');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ct_sec_mail');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN tr_lundi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN tr_mardi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN tr_mercredi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN tr_jeudi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN tr_vendredi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN tr_samedi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN rg_lundi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN rg_mardi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN rg_mercredi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN rg_jeudi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN rg_vendredi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN rg_samedi');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN plage_horaire');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN latitude');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN longitude');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN bp');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN bl');
    }
}
