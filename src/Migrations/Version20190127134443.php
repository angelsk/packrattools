<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190127134443 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection CHANGE num_cards num_cards SMALLINT DEFAULT 0 NOT NULL, CHANGE is_xl is_xl TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_premium is_premium TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE credit_cost credit_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE ticket_cost ticket_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE draw_cost draw_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE rat_cost rat_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE special_foils special_foils TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE has_changed has_changed TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collection CHANGE num_cards num_cards TINYINT(1) NOT NULL, CHANGE is_xl is_xl TINYINT(1) NOT NULL, CHANGE is_premium is_premium TINYINT(1) NOT NULL, CHANGE credit_cost credit_cost SMALLINT NOT NULL, CHANGE ticket_cost ticket_cost SMALLINT NOT NULL, CHANGE draw_cost draw_cost SMALLINT NOT NULL, CHANGE rat_cost rat_cost SMALLINT NOT NULL, CHANGE special_foils special_foils TINYINT(1) NOT NULL, CHANGE has_changed has_changed TINYINT(1) NOT NULL');
    }
}
