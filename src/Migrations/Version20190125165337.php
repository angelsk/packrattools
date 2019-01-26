<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190125165337 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE app_news');
        $this->addSql('DROP TABLE card_alert');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_news (news_id INT AUTO_INCREMENT NOT NULL, message MEDIUMTEXT NOT NULL COLLATE utf8_general_ci, created INT NOT NULL, permalink VARCHAR(150) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, facebook_id VARCHAR(50) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, UNIQUE INDEX unique_post (permalink, facebook_id), PRIMARY KEY(news_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE card_alert (id INT AUTO_INCREMENT NOT NULL, card_identifier VARCHAR(100) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, market VARCHAR(30) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, email_address VARCHAR(150) DEFAULT \'\' NOT NULL COLLATE utf8_general_ci, last_seen DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX card_identifier (card_identifier, email_address, market), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = MyISAM COMMENT = \'\' ');
    }
}
