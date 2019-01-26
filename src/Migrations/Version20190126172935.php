<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190126172935 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX news_type ON card_news');
        $this->addSql('ALTER TABLE card_news DROP identifier, DROP collection');
        $this->addSql('CREATE UNIQUE INDEX news_type ON card_news (news_type, card_id, collection_id, market)');

        $this->addSql('ALTER TABLE card_news_archive DROP identifier, DROP collection');

        // Remove orphaned data
        $this->addSql('DELETE FROM card_news WHERE card_id IS NULL AND collection_id IS NULL');
        $this->addSql('DELETE FROM card_news_archive WHERE card_id IS NULL AND collection_id IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX news_type ON card_news');
        $this->addSql('ALTER TABLE card_news ADD identifier VARCHAR(100) NOT NULL COLLATE utf8_general_ci, ADD collection VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci');
        $this->addSql('CREATE UNIQUE INDEX news_type ON card_news (news_type, identifier, collection, market)');

        $this->addSql('ALTER TABLE card_news_archive ADD identifier VARCHAR(100) NOT NULL COLLATE utf8_general_ci, ADD collection VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci');
    }
}
