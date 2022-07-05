<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705074212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD mail_invoice NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD customer_rate NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD auto_send_rate INT');
        $this->addSql('ALTER TABLE customers_sheets ADD delivery_date DATE');
        $this->addSql('ALTER TABLE customers_sheets ADD pvc INT');
        $this->addSql('ALTER TABLE customers_sheets ADD coef_pvc NVARCHAR(255)');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN mail_invoice');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN customer_rate');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN auto_send_rate');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN delivery_date');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN pvc');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN coef_pvc');
    }
}
