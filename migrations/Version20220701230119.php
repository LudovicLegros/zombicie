<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701230119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, skill_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survivant (id INT AUTO_INCREMENT NOT NULL, blueskill1_id INT NOT NULL, blueskill2_id INT DEFAULT NULL, yellowskill_id INT NOT NULL, orangeskill1_id INT NOT NULL, orangeskill2_id INT NOT NULL, redskill1_id INT NOT NULL, redskill2_id INT NOT NULL, redskill3_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_526EE3F35CDAA5DB (blueskill1_id), INDEX IDX_526EE3F34E6F0A35 (blueskill2_id), INDEX IDX_526EE3F375419633 (yellowskill_id), INDEX IDX_526EE3F33EA19E73 (orangeskill1_id), INDEX IDX_526EE3F32C14319D (orangeskill2_id), INDEX IDX_526EE3F3E2C9DB34 (redskill1_id), INDEX IDX_526EE3F3F07C74DA (redskill2_id), INDEX IDX_526EE3F348C013BF (redskill3_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE survivant ADD CONSTRAINT FK_526EE3F35CDAA5DB FOREIGN KEY (blueskill1_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE survivant ADD CONSTRAINT FK_526EE3F34E6F0A35 FOREIGN KEY (blueskill2_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE survivant ADD CONSTRAINT FK_526EE3F375419633 FOREIGN KEY (yellowskill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE survivant ADD CONSTRAINT FK_526EE3F33EA19E73 FOREIGN KEY (orangeskill1_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE survivant ADD CONSTRAINT FK_526EE3F32C14319D FOREIGN KEY (orangeskill2_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE survivant ADD CONSTRAINT FK_526EE3F3E2C9DB34 FOREIGN KEY (redskill1_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE survivant ADD CONSTRAINT FK_526EE3F3F07C74DA FOREIGN KEY (redskill2_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE survivant ADD CONSTRAINT FK_526EE3F348C013BF FOREIGN KEY (redskill3_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE survivant DROP FOREIGN KEY FK_526EE3F35CDAA5DB');
        $this->addSql('ALTER TABLE survivant DROP FOREIGN KEY FK_526EE3F34E6F0A35');
        $this->addSql('ALTER TABLE survivant DROP FOREIGN KEY FK_526EE3F375419633');
        $this->addSql('ALTER TABLE survivant DROP FOREIGN KEY FK_526EE3F33EA19E73');
        $this->addSql('ALTER TABLE survivant DROP FOREIGN KEY FK_526EE3F32C14319D');
        $this->addSql('ALTER TABLE survivant DROP FOREIGN KEY FK_526EE3F3E2C9DB34');
        $this->addSql('ALTER TABLE survivant DROP FOREIGN KEY FK_526EE3F3F07C74DA');
        $this->addSql('ALTER TABLE survivant DROP FOREIGN KEY FK_526EE3F348C013BF');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE survivant');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
