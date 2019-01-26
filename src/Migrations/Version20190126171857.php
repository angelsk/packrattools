<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190126171857 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card_news ADD card_id INT DEFAULT NULL, ADD collection_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card_news ADD CONSTRAINT FK_F1E09BF24ACC9A20 FOREIGN KEY (card_id) REFERENCES card (card_id)');
        $this->addSql('ALTER TABLE card_news ADD CONSTRAINT FK_F1E09BF2514956FD FOREIGN KEY (collection_id) REFERENCES collection (collection_id)');
        $this->addSql('CREATE INDEX IDX_F1E09BF24ACC9A20 ON card_news (card_id)');
        $this->addSql('CREATE INDEX IDX_F1E09BF2514956FD ON card_news (collection_id)');

        $this->addSql('ALTER TABLE card_news_archive ADD card_id INT DEFAULT NULL, ADD collection_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card_news_archive ADD CONSTRAINT FK_9225EF7F4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (card_id)');
        $this->addSql('ALTER TABLE card_news_archive ADD CONSTRAINT FK_9225EF7F514956FD FOREIGN KEY (collection_id) REFERENCES collection (collection_id)');
        $this->addSql('CREATE INDEX IDX_9225EF7F4ACC9A20 ON card_news_archive (card_id)');
        $this->addSql('CREATE INDEX IDX_9225EF7F514956FD ON card_news_archive (collection_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card_news DROP FOREIGN KEY FK_F1E09BF24ACC9A20');
        $this->addSql('ALTER TABLE card_news DROP FOREIGN KEY FK_F1E09BF2514956FD');
        $this->addSql('DROP INDEX IDX_F1E09BF24ACC9A20 ON card_news');
        $this->addSql('DROP INDEX IDX_F1E09BF2514956FD ON card_news');
        $this->addSql('ALTER TABLE card_news DROP card_id, DROP collection_id');

        $this->addSql('ALTER TABLE card_news_archive DROP FOREIGN KEY FK_9225EF7F4ACC9A20');
        $this->addSql('ALTER TABLE card_news_archive DROP FOREIGN KEY FK_9225EF7F514956FD');
        $this->addSql('DROP INDEX IDX_9225EF7F4ACC9A20 ON card_news_archive');
        $this->addSql('DROP INDEX IDX_9225EF7F514956FD ON card_news_archive');
        $this->addSql('ALTER TABLE card_news_archive DROP card_id, DROP collection_id');
    }
}
