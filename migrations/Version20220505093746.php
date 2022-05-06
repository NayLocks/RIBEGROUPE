<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505093746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_client ADD dir_com NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD com_maitre NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD com NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD tel NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD taux1 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD taux2 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD taux3 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD nature1 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD nature2 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD nature3 NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD limite_frais NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD montant_frais NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD frais_dev INT');
        $this->addSql('ALTER TABLE fiche_client ADD delais_reg NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD bloc_compte INT');
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
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN dir_com');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN com_maitre');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN com');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN tel');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN taux1');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN taux2');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN taux3');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN nature1');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN nature2');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN nature3');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN limite_frais');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN montant_frais');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN frais_dev');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN delais_reg');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN bloc_compte');
    }
}
