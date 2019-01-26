<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190126162315 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // do the plain ones
        $this->addSql('INSERT INTO collection_artists SELECT collection_id, artist_id FROM collection WHERE artist_id NOT LIKE "%,%" AND artist_id != ""');
        $this->addSql('INSERT INTO related_collections SELECT collection_id, related_collection_id FROM collection WHERE related_collection_id NOT LIKE "%,%" AND related_collection_id != 0');

        // get the multiple artists
        $artistStatement = $this->connection->prepare('SELECT collection_id, artist_id FROM collection WHERE artist_id LIKE "%,%" AND artist_id != ""');
        $artistStatement->execute();
        $artists = $artistStatement->fetchAll();

        foreach ($artists as $artistRow) {
            $artistIds = explode(',', $artistRow['artist_id']);

            foreach ($artistIds as $artistId) {
                $this->addSql(
                    sprintf('INSERT INTO collection_artists VALUES (%d, %s)', $artistRow['collection_id'], $artistId)
                );
            }
        }

        // get the multiple related collections
        $relatedCollectionsStatement = $this->connection->prepare('SELECT collection_id, related_collection_id FROM collection WHERE related_collection_id LIKE "%,%" AND related_collection_id != 0');
        $relatedCollectionsStatement->execute();
        $relatedCollectionss = $relatedCollectionsStatement->fetchAll();

        foreach ($relatedCollectionss as $relatedCollectionsRow) {
            $relatedCollectionsIds = explode(',', $relatedCollectionsRow['related_collection_id']);

            foreach ($relatedCollectionsIds as $relatedCollectionsId) {
                $this->addSql(
                    sprintf('INSERT IGNORE INTO related_collections VALUES (%d, %s)', $relatedCollectionsRow['collection_id'], $relatedCollectionsId)
                );
            }
        }
    }

    public function down(Schema $schema): void
    {
        // remove all data
        $this->addSql('TRUNCATE collection_artists');
        $this->addSql('TRUNCATE related_collections');
    }
}
