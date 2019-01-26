<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190126153732 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // Clean up old archived data
        $this->addSql('DELETE FROM card_market_archive WHERE card_id NOT IN (SELECT card_id FROM card)');
        $this->addSql('DELETE FROM card_patterns WHERE card_id NOT IN (SELECT card_id FROM card)');
        $this->addSql('DELETE FROM card_recipe WHERE card_id NOT IN (SELECT card_id FROM card)');
        $this->addSql('DELETE FROM card_history WHERE card_id NOT IN (SELECT card_id FROM card)');

        // Change PKs from mediumint (legacy) to int
        $this->addSql('ALTER TABLE collection CHANGE collection_id collection_id INT NOT NULL AUTO_INCREMENT');
        $this->addSql('ALTER TABLE feat CHANGE feat_id feat_id INT NOT NULL AUTO_INCREMENT, CHANGE collection_id collection_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE family CHANGE family_id family_id INT NOT NULL AUTO_INCREMENT');

        // Fix int types and defaults
        $this->addSql('ALTER TABLE card CHANGE ordr ordr SMALLINT DEFAULT 0 NOT NULL, CHANGE card_type card_type VARCHAR(255) DEFAULT \'normal\' NOT NULL, CHANGE num_needed num_needed SMALLINT DEFAULT 0 NOT NULL, CHANGE running_total running_total SMALLINT DEFAULT 0 NOT NULL, CHANGE limited limited SMALLINT DEFAULT 0, CHANGE sold_out sold_out TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE status status VARCHAR(10) DEFAULT \'\' NOT NULL, CHANGE credit_cost credit_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE packrat_credit_cost packrat_credit_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE ticket_cost ticket_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE packrat_ticket_cost packrat_ticket_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE draw_cost draw_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE rat_cost rat_cost SMALLINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE card_patterns CHANGE card_id card_id INT DEFAULT NULL, CHANGE price price INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE queue CHANGE published published TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE pause pause TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE push push TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE feat CHANGE feat_points feat_points INT DEFAULT 1000 NOT NULL, CHANGE feat_credits feat_credits INT DEFAULT 1000 NOT NULL, CHANGE confirmed_num1 confirmed_num1 TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE available available TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE card_market CHANGE card_id card_id INT DEFAULT NULL, CHANGE price price INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE card_market_archive CHANGE card_id card_id INT DEFAULT NULL, CHANGE price price INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE card_recipe CHANGE card_id card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card_history CHANGE card_id card_id INT DEFAULT NULL, CHANGE price price INT DEFAULT 0 NOT NULL, CHANGE price_type price_type VARCHAR(255) DEFAULT \'Cr\' NOT NULL');

        // Add FKs
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3514956FD FOREIGN KEY (collection_id) REFERENCES collection (collection_id)');
        $this->addSql('ALTER TABLE card RENAME INDEX collection_id TO IDX_161498D3514956FD');
        $this->addSql('ALTER TABLE card_patterns ADD CONSTRAINT FK_A89C13534ACC9A20 FOREIGN KEY (card_id) REFERENCES card (card_id)');
        $this->addSql('ALTER TABLE card_patterns RENAME INDEX card_id TO IDX_A89C13534ACC9A20');
        $this->addSql('ALTER TABLE feat DROP INDEX collection_id, ADD UNIQUE INDEX UNIQ_5A9B91CB514956FD (collection_id)');
        $this->addSql('ALTER TABLE feat ADD CONSTRAINT FK_5A9B91CB514956FD FOREIGN KEY (collection_id) REFERENCES collection (collection_id)');
        $this->addSql('ALTER TABLE collection ADD CONSTRAINT FK_FC4D6532C35E566A FOREIGN KEY (family_id) REFERENCES family (family_id)');
        $this->addSql('ALTER TABLE collection RENAME INDEX family_id TO IDX_FC4D6532C35E566A');
        $this->addSql('ALTER TABLE card_market_archive ADD CONSTRAINT FK_9073DF8B4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (card_id)');
        $this->addSql('CREATE INDEX IDX_9073DF8B4ACC9A20 ON card_market_archive (card_id)');
        $this->addSql('ALTER TABLE card_market ADD CONSTRAINT FK_1993D6BF4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (card_id)');
        $this->addSql('ALTER TABLE card_market RENAME INDEX card_id TO IDX_1993D6BF4ACC9A20');
        $this->addSql('ALTER TABLE card_recipe ADD CONSTRAINT FK_A8B7E2434ACC9A20 FOREIGN KEY (card_id) REFERENCES card (card_id)');
        $this->addSql('ALTER TABLE card_history ADD CONSTRAINT FK_70A0FA3D4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (card_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3514956FD');
        $this->addSql('ALTER TABLE card CHANGE ordr ordr TINYINT(1) NOT NULL, CHANGE card_type card_type VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE num_needed num_needed SMALLINT NOT NULL, CHANGE running_total running_total SMALLINT NOT NULL, CHANGE limited limited INT DEFAULT NULL, CHANGE sold_out sold_out TINYINT(1) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE credit_cost credit_cost SMALLINT NOT NULL, CHANGE packrat_credit_cost packrat_credit_cost SMALLINT NOT NULL, CHANGE ticket_cost ticket_cost SMALLINT NOT NULL, CHANGE packrat_ticket_cost packrat_ticket_cost SMALLINT NOT NULL, CHANGE draw_cost draw_cost SMALLINT NOT NULL, CHANGE rat_cost rat_cost SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE card RENAME INDEX idx_161498d3514956fd TO collection_id');
        $this->addSql('ALTER TABLE card_history DROP FOREIGN KEY FK_70A0FA3D4ACC9A20');
        $this->addSql('ALTER TABLE card_history CHANGE card_id card_id INT NOT NULL, CHANGE price price INT NOT NULL, CHANGE price_type price_type VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE card_market DROP FOREIGN KEY FK_1993D6BF4ACC9A20');
        $this->addSql('ALTER TABLE card_market CHANGE card_id card_id INT NOT NULL, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE card_market RENAME INDEX idx_1993d6bf4acc9a20 TO card_id');
        $this->addSql('ALTER TABLE card_market_archive DROP FOREIGN KEY FK_9073DF8B4ACC9A20');
        $this->addSql('DROP INDEX IDX_9073DF8B4ACC9A20 ON card_market_archive');
        $this->addSql('ALTER TABLE card_market_archive CHANGE card_id card_id INT NOT NULL, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE card_patterns DROP FOREIGN KEY FK_A89C13534ACC9A20');
        $this->addSql('ALTER TABLE card_patterns CHANGE card_id card_id INT NOT NULL, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE card_patterns RENAME INDEX idx_a89c13534acc9a20 TO card_id');
        $this->addSql('ALTER TABLE card_recipe DROP FOREIGN KEY FK_A8B7E2434ACC9A20');
        $this->addSql('ALTER TABLE card_recipe CHANGE card_id card_id INT NOT NULL');
        $this->addSql('ALTER TABLE collection DROP FOREIGN KEY FK_FC4D6532C35E566A');
        $this->addSql('ALTER TABLE collection RENAME INDEX idx_fc4d6532c35e566a TO family_id');
        $this->addSql('ALTER TABLE feat DROP INDEX UNIQ_5A9B91CB514956FD, ADD INDEX collection_id (collection_id)');
        $this->addSql('ALTER TABLE feat DROP FOREIGN KEY FK_5A9B91CB514956FD');
        $this->addSql('ALTER TABLE feat CHANGE feat_points feat_points INT NOT NULL, CHANGE feat_credits feat_credits INT NOT NULL, CHANGE confirmed_num1 confirmed_num1 TINYINT(1) NOT NULL, CHANGE available available TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE queue CHANGE published published TINYINT(1) NOT NULL, CHANGE pause pause TINYINT(1) NOT NULL, CHANGE push push TINYINT(1) NOT NULL');
    }
}
