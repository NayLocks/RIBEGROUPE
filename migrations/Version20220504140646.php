<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504140646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_client ADD avance INT');
        $this->addSql('ALTER TABLE fiche_client ADD cheque INT');
        $this->addSql('ALTER TABLE fiche_client ADD virement INT');
        $this->addSql('ALTER TABLE fiche_client ADD prelevement INT');
        $this->addSql('ALTER TABLE fiche_client ADD ext_kbis NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ext_cgv NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ext_auth NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ext_rib NVARCHAR(255)');
        $this->addSql('ALTER TABLE fiche_client ADD ext_autres NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN avance');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN cheque');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN virement');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN prelevement');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ext_kbis');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ext_cgv');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ext_auth');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ext_rib');
        $this->addSql('ALTER TABLE fiche_client DROP COLUMN ext_autres');
    }
}
