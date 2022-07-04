<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630084421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD phone_standard NVARCHAR(30)');
        $this->addSql('ALTER TABLE customers_sheets ADD phone_standard_tel INT');
        $this->addSql('ALTER TABLE customers_sheets ADD phone_mobile NVARCHAR(30)');
        $this->addSql('ALTER TABLE customers_sheets ADD phone_mobile_tel INT');
        $this->addSql('ALTER TABLE customers_sheets ADD mail_standard NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD call_customer INT');
        $this->addSql('ALTER TABLE customers_sheets ADD call_monday INT');
        $this->addSql('ALTER TABLE customers_sheets ADD call_tuesday INT');
        $this->addSql('ALTER TABLE customers_sheets ADD call_wednesday INT');
        $this->addSql('ALTER TABLE customers_sheets ADD call_thursday INT');
        $this->addSql('ALTER TABLE customers_sheets ADD call_friday INT');
        $this->addSql('ALTER TABLE customers_sheets ADD call_saturday INT');
        $this->addSql('ALTER TABLE customers_sheets ADD hours_monday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD hours_tuesday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD hours_wednesday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD hours_thursday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD hours_friday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD hours_saturday NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD fax_standard NVARCHAR(30)');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN phone_standard');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN phone_standard_tel');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN phone_mobile');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN phone_mobile_tel');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN mail_standard');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN call_customer');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN call_monday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN call_tuesday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN call_wednesday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN call_thursday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN call_friday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN call_saturday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN hours_monday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN hours_tuesday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN hours_wednesday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN hours_thursday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN hours_friday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN hours_saturday');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN fax_standard');
    }
}
