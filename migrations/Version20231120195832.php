<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120195832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE badge_restaurant DROP FOREIGN KEY FK_1CC6E93D28F52404');
        $this->addSql('ALTER TABLE badge_restaurant DROP FOREIGN KEY FK_1CC6E93DF6365012');
        $this->addSql('DROP TABLE badge_restaurant');
        $this->addSql('DROP TABLE expertise');
        $this->addSql('ALTER TABLE achat DROP INDEX fk_usr, ADD UNIQUE INDEX UNIQ_26A984565E5C27E9 (iduser)');
        $this->addSql('ALTER TABLE achat DROP INDEX fk_plt, ADD UNIQUE INDEX UNIQ_26A98456F3F753A7 (idplat)');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF05E5C27E9');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0F6365012');
        $this->addSql('ALTER TABLE avis CHANGE pubAvis pubavis VARCHAR(255) NOT NULL, CHANGE titreAvis titreavis VARCHAR(255) NOT NULL, CHANGE dateAvis dateavis DATE NOT NULL');
        $this->addSql('DROP INDEX iduser ON avis');
        $this->addSql('CREATE INDEX IDX_8F91ABF05E5C27E9 ON avis (iduser)');
        $this->addSql('DROP INDEX id_resto ON avis');
        $this->addSql('CREATE INDEX IDX_8F91ABF0F6365012 ON avis (id_restau)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF05E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DF6365012');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481D5E5C27E9');
        $this->addSql('ALTER TABLE badge CHANGE commantaire commantaire VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX iduser ON badge');
        $this->addSql('CREATE INDEX IDX_FEF0481D5E5C27E9 ON badge (iduser)');
        $this->addSql('DROP INDEX idrestau ON badge');
        $this->addSql('CREATE INDEX IDX_FEF0481DF6365012 ON badge (id_restau)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DF6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481D5E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE participant DROP INDEX fk_event, ADD UNIQUE INDEX UNIQ_D79F6B11EDAB66BE (idevent)');
        $this->addSql('ALTER TABLE participant DROP INDEX fk_user, ADD UNIQUE INDEX UNIQ_D79F6B115E5C27E9 (iduser)');
        $this->addSql('ALTER TABLE plat CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reclamation DROP INDEX ddd, ADD UNIQUE INDEX UNIQ_CE6064045E5C27E9 (iduser)');
        $this->addSql('ALTER TABLE reclamation CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reponse DROP INDEX vvvv, ADD UNIQUE INDEX UNIQ_5FB6DEC77D00914B (idrec)');
        $this->addSql('ALTER TABLE reponse CHANGE contenue contenue VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP INDEX id_user, ADD UNIQUE INDEX UNIQ_42C849556B3CA4B (id_user)');
        $this->addSql('ALTER TABLE reservation DROP INDEX reservattion_ibfk_1, ADD UNIQUE INDEX UNIQ_42C84955F6365012 (id_restau)');
        $this->addSql('ALTER TABLE restaurant CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE location location VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(180) NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE role role JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE badge_restaurant (id INT AUTO_INCREMENT NOT NULL, id_restau INT DEFAULT NULL, idbadge INT DEFAULT NULL, INDEX fkrest (id_restau), INDEX fkbadg (idbadge), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE expertise (idIdee INT AUTO_INCREMENT NOT NULL, reponseAvis INT NOT NULL, dateIdee INT NOT NULL, titreIdee INT NOT NULL, pubIdee VARCHAR(2000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(idIdee)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE badge_restaurant ADD CONSTRAINT FK_1CC6E93D28F52404 FOREIGN KEY (idbadge) REFERENCES badge (id)');
        $this->addSql('ALTER TABLE badge_restaurant ADD CONSTRAINT FK_1CC6E93DF6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('ALTER TABLE achat DROP INDEX UNIQ_26A984565E5C27E9, ADD INDEX fk_usr (iduser)');
        $this->addSql('ALTER TABLE achat DROP INDEX UNIQ_26A98456F3F753A7, ADD INDEX fk_plt (idplat)');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF05E5C27E9');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0F6365012');
        $this->addSql('ALTER TABLE avis CHANGE pubavis pubAvis VARCHAR(2000) NOT NULL, CHANGE titreavis titreAvis VARCHAR(30) NOT NULL, CHANGE dateavis dateAvis VARCHAR(20) NOT NULL');
        $this->addSql('DROP INDEX idx_8f91abf0f6365012 ON avis');
        $this->addSql('CREATE INDEX id_resto ON avis (id_restau)');
        $this->addSql('DROP INDEX idx_8f91abf05e5c27e9 ON avis');
        $this->addSql('CREATE INDEX iduser ON avis (iduser)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF05E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481D5E5C27E9');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DF6365012');
        $this->addSql('ALTER TABLE badge CHANGE commantaire commantaire VARCHAR(2000) NOT NULL');
        $this->addSql('DROP INDEX idx_fef0481df6365012 ON badge');
        $this->addSql('CREATE INDEX idrestau ON badge (id_restau)');
        $this->addSql('DROP INDEX idx_fef0481d5e5c27e9 ON badge');
        $this->addSql('CREATE INDEX iduser ON badge (iduser)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481D5E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DF6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('ALTER TABLE participant DROP INDEX UNIQ_D79F6B11EDAB66BE, ADD INDEX fk_event (idevent)');
        $this->addSql('ALTER TABLE participant DROP INDEX UNIQ_D79F6B115E5C27E9, ADD INDEX fk_user (iduser)');
        $this->addSql('ALTER TABLE plat CHANGE nom nom VARCHAR(30) NOT NULL, CHANGE description description VARCHAR(300) NOT NULL, CHANGE image image VARCHAR(300) NOT NULL');
        $this->addSql('ALTER TABLE reclamation DROP INDEX UNIQ_CE6064045E5C27E9, ADD INDEX ddd (iduser)');
        $this->addSql('ALTER TABLE reclamation CHANGE description description VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE reponse DROP INDEX UNIQ_5FB6DEC77D00914B, ADD INDEX vvvv (idrec)');
        $this->addSql('ALTER TABLE reponse CHANGE contenue contenue VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP INDEX UNIQ_42C849556B3CA4B, ADD INDEX id_user (id_user)');
        $this->addSql('ALTER TABLE reservation DROP INDEX UNIQ_42C84955F6365012, ADD INDEX reservattion_ibfk_1 (id_restau)');
        $this->addSql('ALTER TABLE restaurant CHANGE nom nom VARCHAR(20) NOT NULL, CHANGE location location VARCHAR(11) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user DROP reset_token, CHANGE email email VARCHAR(300) NOT NULL, CHANGE role role VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(300) NOT NULL');
    }
}
