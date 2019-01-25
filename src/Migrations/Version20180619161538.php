<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Initial database creation
 */
final class Version20180619161538 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE IF NOT EXISTS alt_recipe (alt_recipe_id int(11) NOT NULL AUTO_INCREMENT, card_id int(11) NOT NULL, ingredient_1 int(11) NOT NULL, ingredient_2 int(11) NOT NULL, ingredient_3 int(11) NOT NULL, is_active tinyint(1) NOT NULL DEFAULT \'1\', PRIMARY KEY (alt_recipe_id) ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS artist (artist_id int(11) NOT NULL AUTO_INCREMENT, artist_identifier varchar(100) NOT NULL, artist_name varchar(100) NOT NULL, image varchar(255) DEFAULT NULL, icon varchar(255) NOT NULL, colour varchar(6) NOT NULL, website varchar(100) DEFAULT NULL, information mediumtext, PRIMARY KEY (artist_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS card (card_id int(11) NOT NULL AUTO_INCREMENT, card_identifier varchar(100) NOT NULL DEFAULT \'\', packrat_id mediumint(9) DEFAULT NULL, card_name varchar(100) DEFAULT NULL, article varchar(25) DEFAULT NULL, collection_id mediumint(9) NOT NULL DEFAULT \'0\', point_value smallint(6) NOT NULL DEFAULT \'0\', ordr tinyint(4) NOT NULL DEFAULT \'0\', card_type enum(\'normal\',\'draw\',\'rat\',\'recipe\') NOT NULL DEFAULT \'normal\', small_image varchar(255) DEFAULT NULL, medium_image varchar(255) DEFAULT NULL, large_image varchar(255) DEFAULT NULL, silhouette_image varchar(255) DEFAULT NULL, lo_res tinyint(1) NOT NULL DEFAULT \'0\', num_needed smallint(3) NOT NULL DEFAULT \'0\', running_total smallint(3) NOT NULL DEFAULT \'0\', limited mediumint(5) DEFAULT NULL, sold_out tinyint(1) NOT NULL DEFAULT \'0\', status enum(\'\',\'credit\',\'xl\',\'premium\',\'thawed\') NOT NULL DEFAULT \'\', credit_cost smallint(3) NOT NULL DEFAULT \'0\', packrat_credit_cost smallint(3) NOT NULL DEFAULT \'0\', ticket_cost smallint(3) NOT NULL DEFAULT \'0\', packrat_ticket_cost smallint(3) NOT NULL DEFAULT \'0\', draw_cost smallint(3) NOT NULL DEFAULT \'0\', rat_cost smallint(3) NOT NULL DEFAULT \'0\', release_date timestamp NULL DEFAULT CURRENT_TIMESTAMP, release_datetime datetime DEFAULT NULL, PRIMARY KEY (card_id), UNIQUE KEY card_identifier (card_identifier,collection_id), KEY collection_id (collection_id), KEY large_image (large_image), KEY card_type (card_type)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS card_history (id int(11) unsigned NOT NULL AUTO_INCREMENT, card_id int(11) NOT NULL, market varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT \'\', price int(11) NOT NULL DEFAULT \'0\', price_type enum(\'Cr\',\'Tx\',\'Eggs\') CHARACTER SET utf8 NOT NULL DEFAULT \'Cr\', price_date date NOT NULL, PRIMARY KEY (id), UNIQUE KEY card_market_day (card_id,market,price,price_type,price_date), KEY card_id_idx (card_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS card_market (id int(11) NOT NULL AUTO_INCREMENT, card_id int(11) NOT NULL DEFAULT \'0\', market varchar(30) NOT NULL DEFAULT \'\', price int(11) NOT NULL DEFAULT \'0\', price_type enum(\'Cr\',\'Tx\',\'Eggs\') NOT NULL DEFAULT \'Cr\', last_seen timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (id), UNIQUE KEY unq_card_market (card_id,market), KEY card_id (card_id), KEY market (market)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS card_market_archive (id int(11) NOT NULL AUTO_INCREMENT, card_id int(11) NOT NULL DEFAULT \'0\', market varchar(30) NOT NULL DEFAULT \'\', price int(11) NOT NULL DEFAULT \'0\', price_type enum(\'Cr\',\'Tx\',\'Eggs\') NOT NULL DEFAULT \'Cr\', last_seen timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS card_news (id int(11) NOT NULL AUTO_INCREMENT, news_type enum(\'card\',\'collection\') NOT NULL DEFAULT \'card\', release_type enum(\'new\',\'existing\',\'draw\',\'rat\',\'recipe\',\'thawed\',\'update_recipe\') NOT NULL DEFAULT \'new\', identifier varchar(100) NOT NULL DEFAULT \'\', collection varchar(255) DEFAULT NULL, market varchar(20) DEFAULT NULL, price varchar(10) DEFAULT NULL, timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id), UNIQUE KEY news_type (news_type,identifier,market)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS card_news_archive (id int(11) NOT NULL AUTO_INCREMENT, news_type enum(\'card\',\'collection\') NOT NULL DEFAULT \'card\', release_type enum(\'new\',\'existing\',\'draw\',\'rat\',\'recipe\',\'thawed\') NOT NULL DEFAULT \'new\', identifier varchar(100) NOT NULL DEFAULT \'\', collection varchar(255) DEFAULT NULL, market varchar(20) DEFAULT NULL, price varchar(10) DEFAULT NULL, timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS card_patterns (id int(11) NOT NULL AUTO_INCREMENT, card_id int(11) NOT NULL DEFAULT \'0\', market varchar(30) NOT NULL DEFAULT \'\', price int(11) NOT NULL DEFAULT \'0\', price_type enum(\'Cr\',\'Tx\') NOT NULL DEFAULT \'Cr\', last_seen timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (id), KEY card_id (card_id), KEY market (market), KEY card_id_2 (card_id,market,price,price_type)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS card_recipe (recipe_id int(11) NOT NULL AUTO_INCREMENT, card_id int(11) NOT NULL, ingredient_1 int(11) NOT NULL, ingredient_2 int(11) NOT NULL, ingredient_3 int(11) NOT NULL, PRIMARY KEY (recipe_id), UNIQUE KEY card_id (card_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS collection (collection_id mediumint(9) NOT NULL AUTO_INCREMENT, packrat_id mediumint(9) DEFAULT NULL, collection_identifier varchar(100) NOT NULL DEFAULT \'\', collection_name varchar(100) DEFAULT NULL, family_id mediumint(9) DEFAULT \'0\', collection_icon varchar(255) DEFAULT NULL, num_cards tinyint(4) NOT NULL DEFAULT \'0\', release_date date DEFAULT NULL, release_datetime datetime DEFAULT NULL, expiry_date date DEFAULT NULL, expiry_datetime datetime DEFAULT NULL, feat_card varchar(255) DEFAULT NULL, feat_statement mediumtext, intro_text mediumtext, artist_id varchar(25) DEFAULT NULL, artist_name varchar(255) DEFAULT NULL, related_collection_id varchar(255) NOT NULL DEFAULT \'0\', is_xl tinyint(1) NOT NULL DEFAULT \'0\', is_premium tinyint(1) NOT NULL DEFAULT \'0\', credit_cost smallint(3) NOT NULL DEFAULT \'0\', ticket_cost smallint(3) NOT NULL DEFAULT \'0\', draw_cost smallint(3) NOT NULL DEFAULT \'0\', rat_cost smallint(3) NOT NULL DEFAULT \'0\', special_foils tinyint(1) NOT NULL DEFAULT \'0\', notes mediumtext, has_changed tinyint(1) NOT NULL DEFAULT \'0\', PRIMARY KEY (collection_id), UNIQUE KEY collection_identifier (collection_identifier), UNIQUE KEY packrat_idx (packrat_id), KEY family_id (family_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS family (family_id mediumint(9) NOT NULL AUTO_INCREMENT, family_name varchar(20) NOT NULL DEFAULT \'\', family_identifier varchar(25) NOT NULL, family_icon varchar(255) DEFAULT NULL, foil varchar(255) DEFAULT NULL, family_colour varchar(6) DEFAULT NULL, family_border varchar(6) DEFAULT NULL, PRIMARY KEY (family_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS feat (feat_id mediumint(9) NOT NULL AUTO_INCREMENT, feat_identifier varchar(100) NOT NULL, feat_name varchar(255) NOT NULL, feat_title varchar(255) NOT NULL, collection_id mediumint(9) DEFAULT NULL, feat_card varchar(255) DEFAULT NULL, feat_image varchar(255) DEFAULT NULL, feat_statement mediumtext, feat_points mediumint(8) NOT NULL DEFAULT \'1000\', feat_credits int(11) NOT NULL DEFAULT \'1000\', date_achieved date NOT NULL DEFAULT \'0000-00-00\', datetime_achieved datetime DEFAULT NULL, confirmed_num1 tinyint(1) NOT NULL DEFAULT \'0\', available tinyint(1) NOT NULL DEFAULT \'1\', notes mediumtext, PRIMARY KEY (feat_id), KEY collection_id (collection_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS lock_recipe (lock_recipe_id int(11) NOT NULL AUTO_INCREMENT, card_id int(11) NOT NULL, current tinyint(1) NOT NULL DEFAULT \'1\', PRIMARY KEY (lock_recipe_id), KEY card_id (card_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS queue (id int(11) NOT NULL AUTO_INCREMENT, type varchar(50) NOT NULL, tweet varchar(255) NOT NULL, created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, published tinyint(1) NOT NULL DEFAULT \'0\', published_at timestamp NULL DEFAULT NULL, pause tinyint(1) NOT NULL DEFAULT \'0\', push tinyint(1) NOT NULL DEFAULT \'0\', error varchar(255) DEFAULT NULL, PRIMARY KEY (id), KEY published (published)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // LEGACY TABLE format
        $this->addSql("ALTER TABLE artist ENGINE=InnoDB");
        $this->addSql("ALTER TABLE card ENGINE=InnoDB");
        $this->addSql("ALTER TABLE card_history ENGINE=InnoDB");
        $this->addSql("ALTER TABLE card_market ENGINE=InnoDB");
        $this->addSql("ALTER TABLE card_market_archive ENGINE=InnoDB");
        $this->addSql("ALTER TABLE card_news ENGINE=InnoDB");
        $this->addSql("ALTER TABLE card_news_archive ENGINE=InnoDB");
        $this->addSql("ALTER TABLE card_patterns ENGINE=InnoDB");
        $this->addSql("ALTER TABLE card_recipe ENGINE=InnoDB");
        $this->addSql("ALTER TABLE collection ENGINE=InnoDB");
        $this->addSql("ALTER TABLE family ENGINE=InnoDB");
        $this->addSql("ALTER TABLE feat ENGINE=InnoDB");
        $this->addSql("ALTER TABLE queue ENGINE=InnoDB");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE alt_recipe');
        $this->addSql('DROP TABLE alt_recipe');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE card_history');
        $this->addSql('DROP TABLE card_market');
        $this->addSql('DROP TABLE card_market_archive');
        $this->addSql('DROP TABLE card_news');
        $this->addSql('DROP TABLE card_news_archive');
        $this->addSql('DROP TABLE card_patterns');
        $this->addSql('DROP TABLE card_recipe');
        $this->addSql('DROP TABLE collection');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE feat');
        $this->addSql('DROP TABLE lock_recipe');
        $this->addSql('DROP TABLE queue');
    }
}
