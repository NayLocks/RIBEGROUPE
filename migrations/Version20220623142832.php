<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623142832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD step NVARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE customers_sheets ADD date DATETIME2(6) NOT NULL');
        $this->addSql('ALTER TABLE customers_sheets ADD customer_code NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD old_customer_code NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD account_brother NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD account_fl INT');
        $this->addSql('ALTER TABLE customers_sheets ADD account_45g INT');
        $this->addSql('ALTER TABLE customers_sheets ADD account_tide INT');
        $this->addSql('ALTER TABLE customers_sheets ADD account_bof INT');
        $this->addSql('ALTER TABLE customers_sheets ADD call_name NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD code_management NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD social_reason NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD name_account NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD delivery_address NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD delivery_address_zip_code NVARCHAR(10)');
        $this->addSql('ALTER TABLE customers_sheets ADD delivery_address_city NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN step');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN date');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN customer_code');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN old_customer_code');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN account_brother');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN account_fl');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN account_45g');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN account_tide');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN account_bof');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN call_name');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN code_management');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN social_reason');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN name_account');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN delivery_address');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN delivery_address_zip_code');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN delivery_address_city');
    }
}
