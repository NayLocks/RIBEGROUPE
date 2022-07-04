<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629103635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD commitment_number NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD service_code NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD invoice_address NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD invoice_address_zip_code NVARCHAR(10)');
        $this->addSql('ALTER TABLE customers_sheets ADD invoice_address_city NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD stat1 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD stat2 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD stat3 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD stat4 NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD stat5 NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN commitment_number');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN service_code');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN invoice_address');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN invoice_address_zip_code');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN invoice_address_city');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN stat1');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN stat2');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN stat3');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN stat4');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN stat5');
    }
}
