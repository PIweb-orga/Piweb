<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128023230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE badge_restaurant DROP FOREIGN KEY fkbadg');
        $this->addSql('ALTER TABLE badge_restaurant DROP FOREIGN KEY fkrest');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE badge_restaurant');
        $this->addSql('DROP TABLE expertise');
        $this->addSql('ALTER TABLE achat DROP INDEX fk_plt, ADD UNIQUE INDEX UNIQ_26A98456F3F753A7 (idplat)');
        $this->addSql('ALTER TABLE achat DROP INDEX fk_usr, ADD UNIQUE INDEX UNIQ_26A984565E5C27E9 (iduser)');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY fk_plt');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY fk_usr');
        $this->addSql('ALTER TABLE achat CHANGE iduser iduser INT DEFAULT NULL, CHANGE idplat idplat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984565E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A98456F3F753A7 FOREIGN KEY (idplat) REFERENCES plat (idplat)');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY avis_ibfk_2');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY avis_ibfk_1');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY avis_ibfk_2');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY avis_ibfk_1');
        $this->addSql('ALTER TABLE avis ADD nb_vue INT NOT NULL, CHANGE id_restau id_restau INT DEFAULT NULL, CHANGE iduser iduser INT DEFAULT NULL, CHANGE titreAvis titreavis VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF05E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('DROP INDEX iduser ON avis');
        $this->addSql('CREATE INDEX IDX_8F91ABF05E5C27E9 ON avis (iduser)');
        $this->addSql('DROP INDEX id_resto ON avis');
        $this->addSql('CREATE INDEX IDX_8F91ABF0F6365012 ON avis (id_restau)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT avis_ibfk_2 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT avis_ibfk_1 FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY badge_ibfk_2');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY badge_ibfk_3');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY badge_ibfk_2');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY badge_ibfk_3');
        $this->addSql('ALTER TABLE badge CHANGE iduser iduser INT DEFAULT NULL, CHANGE id_restau id_restau INT DEFAULT NULL, CHANGE commantaire commantaire VARCHAR(255) NOT NULL, CHANGE dislikes dislikes INT NOT NULL, CHANGE likes likes INT NOT NULL');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481D5E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DF6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('DROP INDEX iduser ON badge');
        $this->addSql('CREATE INDEX IDX_FEF0481D5E5C27E9 ON badge (iduser)');
        $this->addSql('DROP INDEX idrestau ON badge');
        $this->addSql('CREATE INDEX IDX_FEF0481DF6365012 ON badge (id_restau)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT badge_ibfk_2 FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT badge_ibfk_3 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant DROP INDEX fk_event, ADD UNIQUE INDEX UNIQ_D79F6B11EDAB66BE (idevent)');
        $this->addSql('ALTER TABLE participant DROP INDEX fk_user, ADD UNIQUE INDEX UNIQ_D79F6B115E5C27E9 (iduser)');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY fk_user');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY fk_event');
        $this->addSql('ALTER TABLE participant CHANGE iduser iduser INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11EDAB66BE FOREIGN KEY (idevent) REFERENCES evennement (idevent)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B115E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE plat CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reclamation DROP INDEX ddd, ADD UNIQUE INDEX UNIQ_CE6064045E5C27E9 (iduser)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY ddd');
        $this->addSql('ALTER TABLE reclamation CHANGE iduser iduser INT DEFAULT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE6064045E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE reponse DROP INDEX vvvv, ADD UNIQUE INDEX UNIQ_5FB6DEC77D00914B (idrec)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY vvvv');
        $this->addSql('ALTER TABLE reponse CHANGE idrec idrec INT DEFAULT NULL, CHANGE contenue contenue VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC77D00914B FOREIGN KEY (idrec) REFERENCES reclamation (idrec)');
        $this->addSql('ALTER TABLE reservation DROP INDEX reservattion_ibfk_1, ADD UNIQUE INDEX UNIQ_42C84955F6365012 (id_restau)');
        $this->addSql('ALTER TABLE reservation DROP INDEX id_user, ADD UNIQUE INDEX UNIQ_42C849556B3CA4B (id_user)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY reservation_ibfk_1');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY reservation_ibfk_2');
        $this->addSql('ALTER TABLE reservation CHANGE id_restau id_restau INT DEFAULT NULL, CHANGE id_user id_user INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849556B3CA4B FOREIGN KEY (id_user) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('ALTER TABLE restaurant CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE location location VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE badge_restaurant (id INT AUTO_INCREMENT NOT NULL, id_restau INT NOT NULL, idbadge INT NOT NULL, INDEX fkbadg (idbadge), INDEX fkrest (id_restau), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE expertise (idIdee INT NOT NULL, reponseAvis INT NOT NULL, dateIdee INT NOT NULL, titreIdee INT NOT NULL, pubIdee VARCHAR(2000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(idIdee)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE badge_restaurant ADD CONSTRAINT fkbadg FOREIGN KEY (idbadge) REFERENCES badge (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE badge_restaurant ADD CONSTRAINT fkrest FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE achat DROP INDEX UNIQ_26A984565E5C27E9, ADD INDEX fk_usr (iduser)');
        $this->addSql('ALTER TABLE achat DROP INDEX UNIQ_26A98456F3F753A7, ADD INDEX fk_plt (idplat)');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984565E5C27E9');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A98456F3F753A7');
        $this->addSql('ALTER TABLE achat CHANGE iduser iduser INT NOT NULL, CHANGE idplat idplat INT NOT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT fk_plt FOREIGN KEY (idplat) REFERENCES plat (idplat) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT fk_usr FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF05E5C27E9');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0F6365012');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF05E5C27E9');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0F6365012');
        $this->addSql('ALTER TABLE avis DROP nb_vue, CHANGE iduser iduser INT NOT NULL, CHANGE id_restau id_restau INT NOT NULL, CHANGE titreavis titreAvis VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT avis_ibfk_2 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT avis_ibfk_1 FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_8f91abf05e5c27e9 ON avis');
        $this->addSql('CREATE INDEX iduser ON avis (iduser)');
        $this->addSql('DROP INDEX idx_8f91abf0f6365012 ON avis');
        $this->addSql('CREATE INDEX id_resto ON avis (id_restau)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF05E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0F6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481D5E5C27E9');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DF6365012');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481D5E5C27E9');
        $this->addSql('ALTER TABLE badge DROP FOREIGN KEY FK_FEF0481DF6365012');
        $this->addSql('ALTER TABLE badge CHANGE iduser iduser INT NOT NULL, CHANGE id_restau id_restau INT NOT NULL, CHANGE commantaire commantaire VARCHAR(2000) NOT NULL, CHANGE likes likes INT DEFAULT NULL, CHANGE dislikes dislikes INT DEFAULT NULL');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT badge_ibfk_2 FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT badge_ibfk_3 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_fef0481df6365012 ON badge');
        $this->addSql('CREATE INDEX idrestau ON badge (id_restau)');
        $this->addSql('DROP INDEX idx_fef0481d5e5c27e9 ON badge');
        $this->addSql('CREATE INDEX iduser ON badge (iduser)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481D5E5C27E9 FOREIGN KEY (iduser) REFERENCES user (iduser)');
        $this->addSql('ALTER TABLE badge ADD CONSTRAINT FK_FEF0481DF6365012 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau)');
        $this->addSql('ALTER TABLE participant DROP INDEX UNIQ_D79F6B11EDAB66BE, ADD INDEX fk_event (idevent)');
        $this->addSql('ALTER TABLE participant DROP INDEX UNIQ_D79F6B115E5C27E9, ADD INDEX fk_user (iduser)');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11EDAB66BE');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B115E5C27E9');
        $this->addSql('ALTER TABLE participant CHANGE iduser iduser INT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT fk_user FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT fk_event FOREIGN KEY (idevent) REFERENCES evennement (idevent) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plat CHANGE nom nom VARCHAR(30) NOT NULL, CHANGE description description VARCHAR(300) NOT NULL, CHANGE image image VARCHAR(300) NOT NULL');
        $this->addSql('ALTER TABLE reclamation DROP INDEX UNIQ_CE6064045E5C27E9, ADD INDEX ddd (iduser)');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE6064045E5C27E9');
        $this->addSql('ALTER TABLE reclamation CHANGE iduser iduser INT NOT NULL, CHANGE description description VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT ddd FOREIGN KEY (iduser) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP INDEX UNIQ_5FB6DEC77D00914B, ADD INDEX vvvv (idrec)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC77D00914B');
        $this->addSql('ALTER TABLE reponse CHANGE idrec idrec INT NOT NULL, CHANGE contenue contenue VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT vvvv FOREIGN KEY (idrec) REFERENCES reclamation (idrec) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP INDEX UNIQ_42C849556B3CA4B, ADD INDEX id_user (id_user)');
        $this->addSql('ALTER TABLE reservation DROP INDEX UNIQ_42C84955F6365012, ADD INDEX reservattion_ibfk_1 (id_restau)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849556B3CA4B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F6365012');
        $this->addSql('ALTER TABLE reservation CHANGE id_user id_user INT NOT NULL, CHANGE id_restau id_restau INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_1 FOREIGN KEY (id_restau) REFERENCES restaurant (id_restau) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_ibfk_2 FOREIGN KEY (id_user) REFERENCES user (iduser) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE restaurant CHANGE nom nom VARCHAR(20) NOT NULL, CHANGE location location VARCHAR(11) NOT NULL');
    }
}
