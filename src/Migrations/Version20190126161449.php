<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190126161449 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE collection_artists (collection_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_3CFFF2CF514956FD (collection_id), INDEX IDX_3CFFF2CFB7970CF8 (artist_id), PRIMARY KEY(collection_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE related_collections (collection_id INT NOT NULL, related_collection_id INT NOT NULL, INDEX IDX_18CEAD6A514956FD (collection_id), INDEX IDX_18CEAD6AB91B9C62 (related_collection_id), PRIMARY KEY(collection_id, related_collection_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection_artists ADD CONSTRAINT FK_3CFFF2CF514956FD FOREIGN KEY (collection_id) REFERENCES collection (collection_id)');
        $this->addSql('ALTER TABLE collection_artists ADD CONSTRAINT FK_3CFFF2CFB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (artist_id)');
        $this->addSql('ALTER TABLE related_collections ADD CONSTRAINT FK_18CEAD6A514956FD FOREIGN KEY (collection_id) REFERENCES collection (collection_id)');
        $this->addSql('ALTER TABLE related_collections ADD CONSTRAINT FK_18CEAD6AB91B9C62 FOREIGN KEY (related_collection_id) REFERENCES collection (collection_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE collection_artists');
        $this->addSql('DROP TABLE related_collections');
    }
}
