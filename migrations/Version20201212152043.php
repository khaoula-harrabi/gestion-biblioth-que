<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212152043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_abonnee (livre_id INT NOT NULL, abonnee_id INT NOT NULL, INDEX IDX_9F62FE9937D925CB (livre_id), INDEX IDX_9F62FE998BACA6B1 (abonnee_id), PRIMARY KEY(livre_id, abonnee_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_abonnee ADD CONSTRAINT FK_9F62FE9937D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_abonnee ADD CONSTRAINT FK_9F62FE998BACA6B1 FOREIGN KEY (abonnee_id) REFERENCES abonnee (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE livre_abonnee');
    }
}
