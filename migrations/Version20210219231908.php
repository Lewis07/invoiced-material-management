<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210219231908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, materiel_id INT NOT NULL, nom_cli VARCHAR(100) NOT NULL, prenom_cli VARCHAR(70) NOT NULL, contact VARCHAR(14) NOT NULL, addresse_cli VARCHAR(100) NOT NULL, INDEX IDX_C744045516880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom_departement VARCHAR(60) NOT NULL, lieu VARCHAR(80) NOT NULL, contact_dept VARCHAR(14) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, materiel_id INT NOT NULL, date_facture DATETIME NOT NULL, INDEX IDX_FE86641019EB6921 (client_id), INDEX IDX_FE86641016880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, departement_id INT NOT NULL, sous_type_id INT NOT NULL, qte INT NOT NULL, date_approvisionnement DATETIME NOT NULL, designation VARCHAR(80) NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, INDEX IDX_18D2B091CCF9E01E (departement_id), INDEX IDX_18D2B091E645F4DE (sous_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel_entree (id INT AUTO_INCREMENT NOT NULL, materiel_id INT NOT NULL, qte_entree INT NOT NULL, date_entree DATETIME NOT NULL, INDEX IDX_955DAD9116880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel_sortie (id INT AUTO_INCREMENT NOT NULL, materiel_id INT NOT NULL, qte_sortie INT NOT NULL, date_sortie DATETIME NOT NULL, INDEX IDX_F0E109C516880AAF (materiel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_type (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, descr_sous_type VARCHAR(70) NOT NULL, INDEX IDX_2D30965C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, descr_type VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045516880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641016880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE materiel ADD CONSTRAINT FK_18D2B091E645F4DE FOREIGN KEY (sous_type_id) REFERENCES sous_type (id)');
        $this->addSql('ALTER TABLE materiel_entree ADD CONSTRAINT FK_955DAD9116880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE materiel_sortie ADD CONSTRAINT FK_F0E109C516880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE sous_type ADD CONSTRAINT FK_2D30965C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091CCF9E01E');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045516880AAF');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641016880AAF');
        $this->addSql('ALTER TABLE materiel_entree DROP FOREIGN KEY FK_955DAD9116880AAF');
        $this->addSql('ALTER TABLE materiel_sortie DROP FOREIGN KEY FK_F0E109C516880AAF');
        $this->addSql('ALTER TABLE materiel DROP FOREIGN KEY FK_18D2B091E645F4DE');
        $this->addSql('ALTER TABLE sous_type DROP FOREIGN KEY FK_2D30965C54C8C93');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE materiel_entree');
        $this->addSql('DROP TABLE materiel_sortie');
        $this->addSql('DROP TABLE sous_type');
        $this->addSql('DROP TABLE type');
    }
}
