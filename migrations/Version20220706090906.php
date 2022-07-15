<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706090906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_sheets ADD fee_limit NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD fee_amount NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD payment_deadlines NVARCHAR(255)');
        $this->addSql('ALTER TABLE customers_sheets ADD development_costs INT');
        $this->addSql('ALTER TABLE customers_sheets ADD account_bloc INT');
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
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN fee_limit');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN fee_amount');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN payment_deadlines');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN development_costs');
        $this->addSql('ALTER TABLE customers_sheets DROP COLUMN account_bloc');
    }
}
