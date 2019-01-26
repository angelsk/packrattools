<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190126170350 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card ADD card_description LONGTEXT DEFAULT NULL, CHANGE limited limited SMALLINT DEFAULT NULL');

        $this->addSql('ALTER TABLE family DROP foil');
        $this->addSql('ALTER TABLE feat DROP feat_card, DROP confirmed_num1');
        $this->addSql('ALTER TABLE collection DROP feat_card, DROP feat_statement');

        $this->addSql('ALTER TABLE card_patterns CHANGE card_id card_id INT NOT NULL');
        $this->addSql('ALTER TABLE card_market_archive CHANGE card_id card_id INT NOT NULL');
        $this->addSql('ALTER TABLE card_market CHANGE card_id card_id INT NOT NULL');
        $this->addSql('ALTER TABLE card_recipe CHANGE card_id card_id INT NOT NULL');
        $this->addSql('ALTER TABLE card_history CHANGE card_id card_id INT NOT NULL');

        $this->addSql('ALTER TABLE card_recipe DROP INDEX card_id, ADD INDEX IDX_A8B7E2434ACC9A20 (card_id)');

        $this->addSql('ALTER TABLE card_recipe ADD CONSTRAINT FK_A8B7E2435CC5B809 FOREIGN KEY (ingredient_1) REFERENCES card (card_id)');
        $this->addSql('ALTER TABLE card_recipe ADD CONSTRAINT FK_A8B7E243C5CCE9B3 FOREIGN KEY (ingredient_2) REFERENCES card (card_id)');
        $this->addSql('ALTER TABLE card_recipe ADD CONSTRAINT FK_A8B7E243B2CBD925 FOREIGN KEY (ingredient_3) REFERENCES card (card_id)');
        $this->addSql('CREATE INDEX IDX_A8B7E2435CC5B809 ON card_recipe (ingredient_1)');
        $this->addSql('CREATE INDEX IDX_A8B7E243C5CCE9B3 ON card_recipe (ingredient_2)');
        $this->addSql('CREATE INDEX IDX_A8B7E243B2CBD925 ON card_recipe (ingredient_3)');

        $this->addSql('UPDATE card SET limited = NULL WHERE limited = 0');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP card_description, CHANGE limited limited SMALLINT DEFAULT 0');
        $this->addSql('ALTER TABLE card_history CHANGE card_id card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card_market CHANGE card_id card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card_market_archive CHANGE card_id card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card_patterns CHANGE card_id card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card_recipe DROP INDEX IDX_A8B7E2434ACC9A20, ADD UNIQUE INDEX card_id (card_id)');
        $this->addSql('ALTER TABLE card_recipe DROP FOREIGN KEY FK_A8B7E2435CC5B809');
        $this->addSql('ALTER TABLE card_recipe DROP FOREIGN KEY FK_A8B7E243C5CCE9B3');
        $this->addSql('ALTER TABLE card_recipe DROP FOREIGN KEY FK_A8B7E243B2CBD925');
        $this->addSql('DROP INDEX IDX_A8B7E2435CC5B809 ON card_recipe');
        $this->addSql('DROP INDEX IDX_A8B7E243C5CCE9B3 ON card_recipe');
        $this->addSql('DROP INDEX IDX_A8B7E243B2CBD925 ON card_recipe');
        $this->addSql('ALTER TABLE card_recipe CHANGE card_id card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE collection ADD feat_card VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, ADD feat_statement MEDIUMTEXT DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE family ADD foil VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE feat ADD feat_card VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, ADD confirmed_num1 TINYINT(1) DEFAULT \'0\' NOT NULL');

        $this->addSql('UPDATE card SET limited = 0 WHERE limited IS NULL');
    }
}
