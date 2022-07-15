<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705155952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD tr_monday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD tr_tuesday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD tr_wednesday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD tr_thursday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD tr_friday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD tr_saturday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD rg_monday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD rg_tuesday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD rg_wednesday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD rg_thursday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD rg_friday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD rg_saturday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD time_slot NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD latitude NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD longitude NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD text_bp NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD text_bl NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN tr_monday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN tr_tuesday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN tr_wednesday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN tr_thursday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN tr_friday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN tr_saturday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN rg_monday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN rg_tuesday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN rg_wednesday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN rg_thursday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN rg_friday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN rg_saturday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN time_slot');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN latitude');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN longitude');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN text_bp');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN text_bl');
    }
}
