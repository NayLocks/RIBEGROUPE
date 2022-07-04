<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623130830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_client (id INT IDENTITY NOT NULL, company_id INT, username_id INT, etape_fiche NVARCHAR(50) NOT NULL, date DATETIME2(6) NOT NULL, code_client NVARCHAR(255), ancien_code_client NVARCHAR(255), compte_frere NVARCHAR(255), cp_fl INT, cp45_g INT, cp_maree INT, cp_bof INT, nom_appel NVARCHAR(255), code_gestion NVARCHAR(255), raison_social NVARCHAR(255), nom_grand_compte NVARCHAR(255), adr_livraison NVARCHAR(255), adr_liv_code_postal NVARCHAR(10), adr_liv_ville NVARCHAR(255), siret NVARCHAR(255), tva NVARCHAR(255), type_client INT, engagement NVARCHAR(255), code_service NVARCHAR(255), adr_facture NVARCHAR(255), adr_fac_code_postal NVARCHAR(10), adr_fac_ville NVARCHAR(255), stat1 NVARCHAR(255), stat2 NVARCHAR(255), stat3 NVARCHAR(255), stat4 NVARCHAR(255), stat5 NVARCHAR(255), phone_standard NVARCHAR(30), phone_standard_tel INT, phone_portable NVARCHAR(30), phone_portable_tel INT, fax_standard NVARCHAR(30), email_standard NVARCHAR(255), appel_client INT, appel_lundi INT, horaire_lundi NVARCHAR(255), appel_mardi INT, horaire_mardi NVARCHAR(255), appel_mercredi INT, horaire_mercredi NVARCHAR(255), appel_jeudi INT, horaire_jeudi NVARCHAR(255), appel_vendredi INT, horaire_vendredi NVARCHAR(255), appel_samedi INT, horaire_samedi NVARCHAR(255), email_facture NVARCHAR(255), tarif_client NVARCHAR(255), envoi_tarif_auto INT, date1_livraison DATE, pvc INT, coef_pvc NVARCHAR(255), avance INT, cheque INT, virement INT, prelevement INT, ext_kbis NVARCHAR(255), ext_cgv NVARCHAR(255), ext_auth NVARCHAR(255), ext_rib NVARCHAR(255), ext_autres NVARCHAR(255), ct_dir_nom NVARCHAR(255), ct_dir_tel NVARCHAR(30), ct_dir_mail NVARCHAR(255), ct_compta_nom NVARCHAR(255), ct_compta_tel NVARCHAR(30), ct_compta_mail NVARCHAR(255), ct_com_nom NVARCHAR(255), ct_com_tel NVARCHAR(30), ct_com_mail NVARCHAR(255), ct_qua_nom NVARCHAR(255), ct_qua_tel NVARCHAR(30), ct_qua_mail NVARCHAR(255), ct_sec_nom NVARCHAR(255), ct_sec_tel NVARCHAR(30), ct_sec_mail NVARCHAR(255), tr_lundi NVARCHAR(255), tr_mardi NVARCHAR(255), tr_mercredi NVARCHAR(255), tr_jeudi NVARCHAR(255), tr_vendredi NVARCHAR(255), tr_samedi NVARCHAR(255), rg_lundi NVARCHAR(255), rg_mardi NVARCHAR(255), rg_mercredi NVARCHAR(255), rg_jeudi NVARCHAR(255), rg_vendredi NVARCHAR(255), rg_samedi NVARCHAR(255), plage_horaire NVARCHAR(255), latitude NVARCHAR(255), longitude NVARCHAR(255), bp NVARCHAR(255), bl NVARCHAR(255), dir_com NVARCHAR(255), com_maitre NVARCHAR(255), com NVARCHAR(255), tel NVARCHAR(255), taux1 NVARCHAR(255), taux2 NVARCHAR(255), taux3 NVARCHAR(255), nature1 NVARCHAR(255), nature2 NVARCHAR(255), nature3 NVARCHAR(255), limite_frais NVARCHAR(255), montant_frais NVARCHAR(255), frais_dev INT, delais_reg NVARCHAR(255), bloc_compte INT, company_transport NVARCHAR(255), date_valid_direction DATE, raison_refus NVARCHAR(255), date_reception_directeur DATE, date_reception_logistique DATE, siren NVARCHAR(255), PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_7158A982979B1AD6 ON fiche_client (company_id)');
        $this->addSql('CREATE INDEX IDX_7158A982ED766068 ON fiche_client (username_id)');
        $this->addSql('ALTER TABLE fiche_client ADD CONSTRAINT FK_7158A982979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id)');
        $this->addSql('ALTER TABLE fiche_client ADD CONSTRAINT FK_7158A982ED766068 FOREIGN KEY (username_id) REFERENCES [user] (id)');
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
        $this->addSql('DROP TABLE fiche_client');
    }
}
