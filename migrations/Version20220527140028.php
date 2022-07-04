<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527140028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE items_sheets ADD fishing_name_latin NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD fishing_area NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD stat1 NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD stat2 NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD stat3 NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD stat4 NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD weight_packaging NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD weight_variable INT');
        $this->addSql('ALTER TABLE items_sheets ADD unit_packaging NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD unit_variable INT');
        $this->addSql('ALTER TABLE items_sheets ADD dlc INT');
        $this->addSql('ALTER TABLE items_sheets ADD ddm INT');
        $this->addSql('ALTER TABLE items_sheets ADD dlc_date NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD notice_accentuate NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD localization NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD rup NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD siqo NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD unit_purchase NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD unit_sale NVARCHAR(255)');
        $this->addSql('ALTER TABLE items_sheets ADD unit_stock NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN fishing_name_latin');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN fishing_area');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN stat1');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN stat2');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN stat3');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN stat4');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN weight_packaging');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN weight_variable');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN unit_packaging');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN unit_variable');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN dlc');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN ddm');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN dlc_date');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN notice_accentuate');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN localization');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN rup');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN siqo');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN unit_purchase');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN unit_sale');
        $this->addSql('ALTER TABLE items_sheets DROP COLUMN unit_stock');
    }
}
