<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180619161633 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE alt_recipe');
        $this->addSql('DROP TABLE lock_recipe');
        $this->addSql('DROP INDEX large_image ON card');
        $this->addSql('ALTER TABLE card DROP small_image, DROP large_image, DROP lo_res, CHANGE card_identifier card_identifier VARCHAR(100) NOT NULL, CHANGE packrat_id packrat_id INT NOT NULL, CHANGE collection_id collection_id INT DEFAULT NULL, CHANGE point_value point_value SMALLINT NOT NULL, CHANGE ordr ordr TINYINT(1) NOT NULL, CHANGE card_type card_type VARCHAR(255) NOT NULL, CHANGE num_needed num_needed SMALLINT NOT NULL, CHANGE running_total running_total SMALLINT NOT NULL, CHANGE sold_out sold_out TINYINT(1) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE credit_cost credit_cost SMALLINT NOT NULL, CHANGE packrat_credit_cost packrat_credit_cost SMALLINT NOT NULL, CHANGE ticket_cost ticket_cost SMALLINT NOT NULL, CHANGE packrat_ticket_cost packrat_ticket_cost SMALLINT NOT NULL, CHANGE draw_cost draw_cost SMALLINT NOT NULL, CHANGE rat_cost rat_cost SMALLINT NOT NULL, CHANGE release_date release_date DATETIME DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX packrat_api_id ON card (packrat_id)');
        $this->addSql('ALTER TABLE card_history CHANGE market market VARCHAR(30) NOT NULL, CHANGE price price INT NOT NULL, CHANGE price_type price_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE card_market CHANGE card_id card_id INT NOT NULL, CHANGE market market VARCHAR(30) NOT NULL, CHANGE price price INT NOT NULL, CHANGE last_seen last_seen DATETIME NOT NULL');
        $this->addSql('ALTER TABLE card_market_archive CHANGE card_id card_id INT NOT NULL, CHANGE market market VARCHAR(30) NOT NULL, CHANGE price price INT NOT NULL, CHANGE last_seen last_seen DATETIME NOT NULL');
        $this->addSql('ALTER TABLE card_patterns CHANGE card_id card_id INT NOT NULL, CHANGE market market VARCHAR(30) NOT NULL, CHANGE price price INT NOT NULL, CHANGE last_seen last_seen DATETIME NOT NULL');
        $this->addSql('ALTER TABLE collection DROP artist_name, CHANGE packrat_id packrat_id INT NOT NULL, CHANGE collection_identifier collection_identifier VARCHAR(100) NOT NULL, CHANGE family_id family_id INT DEFAULT NULL, CHANGE num_cards num_cards TINYINT(1) NOT NULL, CHANGE related_collection_id related_collection_id VARCHAR(255) NOT NULL, CHANGE is_xl is_xl TINYINT(1) NOT NULL, CHANGE is_premium is_premium TINYINT(1) NOT NULL, CHANGE credit_cost credit_cost SMALLINT NOT NULL, CHANGE ticket_cost ticket_cost SMALLINT NOT NULL, CHANGE draw_cost draw_cost SMALLINT NOT NULL, CHANGE rat_cost rat_cost SMALLINT NOT NULL, CHANGE special_foils special_foils TINYINT(1) NOT NULL, CHANGE has_changed has_changed TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE family CHANGE family_name family_name VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE feat CHANGE feat_points feat_points INT NOT NULL, CHANGE feat_credits feat_credits INT NOT NULL, CHANGE date_achieved date_achieved DATE DEFAULT NULL, CHANGE confirmed_num1 confirmed_num1 TINYINT(1) NOT NULL, CHANGE available available TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE card_news CHANGE identifier identifier VARCHAR(100) NOT NULL, CHANGE timestamp timestamp DATETIME NOT NULL');
        $this->addSql('ALTER TABLE card_news_archive CHANGE identifier identifier VARCHAR(100) NOT NULL, CHANGE timestamp timestamp DATETIME NOT NULL');
        $this->addSql('ALTER TABLE queue CHANGE created_at created_at DATETIME NOT NULL, CHANGE published published TINYINT(1) NOT NULL, CHANGE pause pause TINYINT(1) NOT NULL, CHANGE push push TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alt_recipe (alt_recipe_id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, ingredient_1 INT NOT NULL, ingredient_2 INT NOT NULL, ingredient_3 INT NOT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(alt_recipe_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lock_recipe (lock_recipe_id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, current TINYINT(1) DEFAULT \'1\' NOT NULL, INDEX card_id (card_id), PRIMARY KEY(lock_recipe_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP INDEX packrat_api_id ON card');
        $this->addSql('ALTER TABLE card ADD small_image VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, ADD large_image VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, ADD lo_res TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE card_identifier card_identifier VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE packrat_id packrat_id INT DEFAULT NULL, CHANGE collection_id collection_id INT DEFAULT 0 NOT NULL, CHANGE point_value point_value SMALLINT DEFAULT 0 NOT NULL, CHANGE ordr ordr TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE card_type card_type VARCHAR(255) DEFAULT \'normal\' NOT NULL COLLATE utf8_general_ci, CHANGE num_needed num_needed SMALLINT DEFAULT 0 NOT NULL, CHANGE running_total running_total SMALLINT DEFAULT 0 NOT NULL, CHANGE sold_out sold_out TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE status status VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE credit_cost credit_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE packrat_credit_cost packrat_credit_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE ticket_cost ticket_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE packrat_ticket_cost packrat_ticket_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE draw_cost draw_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE rat_cost rat_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE release_date release_date DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('CREATE INDEX large_image ON card (large_image)');
        $this->addSql('ALTER TABLE card_history CHANGE market market VARCHAR(30) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE price price INT DEFAULT 0 NOT NULL, CHANGE price_type price_type VARCHAR(255) DEFAULT \'Cr\' NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE card_market CHANGE card_id card_id INT DEFAULT 0 NOT NULL, CHANGE market market VARCHAR(30) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE price price INT DEFAULT 0 NOT NULL, CHANGE last_seen last_seen DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE card_market_archive CHANGE card_id card_id INT DEFAULT 0 NOT NULL, CHANGE market market VARCHAR(30) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE price price INT DEFAULT 0 NOT NULL, CHANGE last_seen last_seen DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE card_news CHANGE identifier identifier VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE timestamp timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE card_news_archive CHANGE identifier identifier VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE timestamp timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE card_patterns CHANGE card_id card_id INT DEFAULT 0 NOT NULL, CHANGE market market VARCHAR(30) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE price price INT DEFAULT 0 NOT NULL, CHANGE last_seen last_seen DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE collection ADD artist_name VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, CHANGE packrat_id packrat_id INT DEFAULT NULL, CHANGE collection_identifier collection_identifier VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, CHANGE family_id family_id INT DEFAULT 0, CHANGE num_cards num_cards TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE related_collection_id related_collection_id VARCHAR(255) DEFAULT \'0\' NOT NULL COLLATE utf8_general_ci, CHANGE is_xl is_xl TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_premium is_premium TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE credit_cost credit_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE ticket_cost ticket_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE draw_cost draw_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE rat_cost rat_cost SMALLINT DEFAULT 0 NOT NULL, CHANGE special_foils special_foils TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE has_changed has_changed TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE family CHANGE family_name family_name VARCHAR(20) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE feat CHANGE feat_points feat_points INT DEFAULT 1000 NOT NULL, CHANGE feat_credits feat_credits INT DEFAULT 1000 NOT NULL, CHANGE date_achieved date_achieved DATE DEFAULT \'0000-00-00\' NOT NULL, CHANGE confirmed_num1 confirmed_num1 TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE available available TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE queue CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE published published TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE pause pause TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE push push TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
