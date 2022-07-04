<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623130941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fiche_client');
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
        $this->addSql('CREATE TABLE fiche_client (id INT IDENTITY NOT NULL, company_id INT, username_id INT, etape_fiche NVARCHAR(50) COLLATE French_CI_AS NOT NULL, date DATETIME2(6) NOT NULL, code_client NVARCHAR(255) COLLATE French_CI_AS, ancien_code_client NVARCHAR(255) COLLATE French_CI_AS, compte_frere NVARCHAR(255) COLLATE French_CI_AS, cp_fl INT, cp45_g INT, cp_maree INT, cp_bof INT, nom_appel NVARCHAR(255) COLLATE French_CI_AS, code_gestion NVARCHAR(255) COLLATE French_CI_AS, raison_social NVARCHAR(255) COLLATE French_CI_AS, nom_grand_compte NVARCHAR(255) COLLATE French_CI_AS, adr_livraison NVARCHAR(255) COLLATE French_CI_AS, adr_liv_code_postal NVARCHAR(10) COLLATE French_CI_AS, adr_liv_ville NVARCHAR(255) COLLATE French_CI_AS, siret NVARCHAR(255) COLLATE French_CI_AS, tva NVARCHAR(255) COLLATE French_CI_AS, type_client INT, engagement NVARCHAR(255) COLLATE French_CI_AS, code_service NVARCHAR(255) COLLATE French_CI_AS, adr_facture NVARCHAR(255) COLLATE French_CI_AS, adr_fac_code_postal NVARCHAR(10) COLLATE French_CI_AS, adr_fac_ville NVARCHAR(255) COLLATE French_CI_AS, stat1 NVARCHAR(255) COLLATE French_CI_AS, stat2 NVARCHAR(255) COLLATE French_CI_AS, stat3 NVARCHAR(255) COLLATE French_CI_AS, stat4 NVARCHAR(255) COLLATE French_CI_AS, stat5 NVARCHAR(255) COLLATE French_CI_AS, phone_standard NVARCHAR(30) COLLATE French_CI_AS, phone_standard_tel INT, phone_portable NVARCHAR(30) COLLATE French_CI_AS, phone_portable_tel INT, fax_standard NVARCHAR(30) COLLATE French_CI_AS, email_standard NVARCHAR(255) COLLATE French_CI_AS, appel_client INT, appel_lundi INT, horaire_lundi NVARCHAR(255) COLLATE French_CI_AS, appel_mardi INT, horaire_mardi NVARCHAR(255) COLLATE French_CI_AS, appel_mercredi INT, horaire_mercredi NVARCHAR(255) COLLATE French_CI_AS, appel_jeudi INT, horaire_jeudi NVARCHAR(255) COLLATE French_CI_AS, appel_vendredi INT, horaire_vendredi NVARCHAR(255) COLLATE French_CI_AS, appel_samedi INT, horaire_samedi NVARCHAR(255) COLLATE French_CI_AS, email_facture NVARCHAR(255) COLLATE French_CI_AS, tarif_client NVARCHAR(255) COLLATE French_CI_AS, envoi_tarif_auto INT, date1_livraison DATE, pvc INT, coef_pvc NVARCHAR(255) COLLATE French_CI_AS, avance INT, cheque INT, virement INT, prelevement INT, ext_kbis NVARCHAR(255) COLLATE French_CI_AS, ext_cgv NVARCHAR(255) COLLATE French_CI_AS, ext_auth NVARCHAR(255) COLLATE French_CI_AS, ext_rib NVARCHAR(255) COLLATE French_CI_AS, ext_autres NVARCHAR(255) COLLATE French_CI_AS, ct_dir_nom NVARCHAR(255) COLLATE French_CI_AS, ct_dir_tel NVARCHAR(30) COLLATE French_CI_AS, ct_dir_mail NVARCHAR(255) COLLATE French_CI_AS, ct_compta_nom NVARCHAR(255) COLLATE French_CI_AS, ct_compta_tel NVARCHAR(30) COLLATE French_CI_AS, ct_compta_mail NVARCHAR(255) COLLATE French_CI_AS, ct_com_nom NVARCHAR(255) COLLATE French_CI_AS, ct_com_tel NVARCHAR(30) COLLATE French_CI_AS, ct_com_mail NVARCHAR(255) COLLATE French_CI_AS, ct_qua_nom NVARCHAR(255) COLLATE French_CI_AS, ct_qua_tel NVARCHAR(30) COLLATE French_CI_AS, ct_qua_mail NVARCHAR(255) COLLATE French_CI_AS, ct_sec_nom NVARCHAR(255) COLLATE French_CI_AS, ct_sec_tel NVARCHAR(30) COLLATE French_CI_AS, ct_sec_mail NVARCHAR(255) COLLATE French_CI_AS, tr_lundi NVARCHAR(255) COLLATE French_CI_AS, tr_mardi NVARCHAR(255) COLLATE French_CI_AS, tr_mercredi NVARCHAR(255) COLLATE French_CI_AS, tr_jeudi NVARCHAR(255) COLLATE French_CI_AS, tr_vendredi NVARCHAR(255) COLLATE French_CI_AS, tr_samedi NVARCHAR(255) COLLATE French_CI_AS, rg_lundi NVARCHAR(255) COLLATE French_CI_AS, rg_mardi NVARCHAR(255) COLLATE French_CI_AS, rg_mercredi NVARCHAR(255) COLLATE French_CI_AS, rg_jeudi NVARCHAR(255) COLLATE French_CI_AS, rg_vendredi NVARCHAR(255) COLLATE French_CI_AS, rg_samedi NVARCHAR(255) COLLATE French_CI_AS, plage_horaire NVARCHAR(255) COLLATE French_CI_AS, latitude NVARCHAR(255) COLLATE French_CI_AS, longitude NVARCHAR(255) COLLATE French_CI_AS, bp NVARCHAR(255) COLLATE French_CI_AS, bl NVARCHAR(255) COLLATE French_CI_AS, dir_com NVARCHAR(255) COLLATE French_CI_AS, com_maitre NVARCHAR(255) COLLATE French_CI_AS, com NVARCHAR(255) COLLATE French_CI_AS, tel NVARCHAR(255) COLLATE French_CI_AS, taux1 NVARCHAR(255) COLLATE French_CI_AS, taux2 NVARCHAR(255) COLLATE French_CI_AS, taux3 NVARCHAR(255) COLLATE French_CI_AS, nature1 NVARCHAR(255) COLLATE French_CI_AS, nature2 NVARCHAR(255) COLLATE French_CI_AS, nature3 NVARCHAR(255) COLLATE French_CI_AS, limite_frais NVARCHAR(255) COLLATE French_CI_AS, montant_frais NVARCHAR(255) COLLATE French_CI_AS, frais_dev INT, delais_reg NVARCHAR(255) COLLATE French_CI_AS, bloc_compte INT, company_transport NVARCHAR(255) COLLATE French_CI_AS, date_valid_direction DATE, raison_refus NVARCHAR(255) COLLATE French_CI_AS, date_reception_directeur DATE, date_reception_logistique DATE, siren NVARCHAR(255) COLLATE French_CI_AS, PRIMARY KEY (id))');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_7158A982979B1AD6 ON fiche_client (company_id)');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_7158A982ED766068 ON fiche_client (username_id)');
        $this->addSql('ALTER TABLE fiche_client ADD CONSTRAINT FK_7158A982979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE fiche_client ADD CONSTRAINT FK_7158A982ED766068 FOREIGN KEY (username_id) REFERENCES [user] (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
