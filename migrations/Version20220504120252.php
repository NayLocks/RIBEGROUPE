<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504120252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_client ADD type_client INT');
        $this->addSql('ALTER TABLE fiche_client ADD engagement NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD code_service NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD adr_facture NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD adr_fac_code_postal NVARCHAR(10)');
        $this->addSql('ALTER TABLE fiche_client ADD adr_fac_ville NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD stat1 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD stat2 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD stat3 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD stat4 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD stat5 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ALTER COLUMN cp_fl INT');
        $this->addSql('ALTER TABLE fiche_client ALTER COLUMN cp45_g INT');
        $this->addSql('ALTER TABLE fiche_client ALTER COLUMN cp_maree INT');
        $this->addSql('ALTER TABLE fiche_client ALTER COLUMN cp_bof INT');
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
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN type_client');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN engagement');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN code_service');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN adr_facture');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN adr_fac_code_postal');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN adr_fac_ville');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN stat1');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN stat2');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN stat3');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN stat4');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN stat5');
        $this->addSql('ALTER TABLE fiche_client ALTER COLUMN cp_fl INT NOT NULL');
        $this->addSql('ALTER TABLE fiche_client ALTER COLUMN cp45_g INT NOT NULL');
        $this->addSql('ALTER TABLE fiche_client ALTER COLUMN cp_maree INT NOT NULL');
        $this->addSql('ALTER TABLE fiche_client ALTER COLUMN cp_bof INT NOT NULL');
    }
}
