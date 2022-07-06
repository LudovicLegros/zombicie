<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706224812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil_survivant (profil_id INT NOT NULL, survivant_id INT NOT NULL, INDEX IDX_FA15D5D3275ED078 (profil_id), INDEX IDX_FA15D5D3E9AE49B (survivant_id), PRIMARY KEY(profil_id, survivant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil_survivant ADD CONSTRAINT FK_FA15D5D3275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil_survivant ADD CONSTRAINT FK_FA15D5D3E9AE49B FOREIGN KEY (survivant_id) REFERENCES survivant (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE profil_survivant');
    }
}
