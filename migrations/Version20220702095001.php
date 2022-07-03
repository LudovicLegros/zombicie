<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220702095001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, class_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe_survivant (classe_id INT NOT NULL, survivant_id INT NOT NULL, INDEX IDX_633AA3D48F5EA509 (classe_id), INDEX IDX_633AA3D4E9AE49B (survivant_id), PRIMARY KEY(classe_id, survivant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, race_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race_survivant (race_id INT NOT NULL, survivant_id INT NOT NULL, INDEX IDX_8BE8A3EE6E59D40D (race_id), INDEX IDX_8BE8A3EEE9AE49B (survivant_id), PRIMARY KEY(race_id, survivant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe_survivant ADD CONSTRAINT FK_633AA3D48F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_survivant ADD CONSTRAINT FK_633AA3D4E9AE49B FOREIGN KEY (survivant_id) REFERENCES survivant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race_survivant ADD CONSTRAINT FK_8BE8A3EE6E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE race_survivant ADD CONSTRAINT FK_8BE8A3EEE9AE49B FOREIGN KEY (survivant_id) REFERENCES survivant (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_survivant DROP FOREIGN KEY FK_633AA3D48F5EA509');
        $this->addSql('ALTER TABLE race_survivant DROP FOREIGN KEY FK_8BE8A3EE6E59D40D');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE classe_survivant');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE race_survivant');
    }
}
