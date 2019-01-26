<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190126171925 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE card_news n INNER JOIN card c ON c.card_identifier = n.identifier SET n.card_id = c.card_id WHERE n.identifier != "" AND n.identifier IS NOT NULL AND n.news_type = "card"');
        $this->addSql('UPDATE card_news n INNER JOIN collection c ON c.collection_identifier = n.collection SET n.collection_id = c.collection_id WHERE n.collection != "" AND n.collection IS NOT NULL AND n.news_type = "card"');
        $this->addSql('UPDATE card_news n INNER JOIN collection c ON c.collection_identifier = n.identifier SET n.collection_id = c.collection_id WHERE n.identifier != "" AND n.identifier IS NOT NULL AND n.news_type = "collection"');

        $this->addSql('UPDATE card_news_archive n INNER JOIN card c ON c.card_identifier = n.identifier SET n.card_id = c.card_id WHERE n.identifier != "" AND n.identifier IS NOT NULL AND n.news_type = "card"');
        $this->addSql('UPDATE card_news_archive n INNER JOIN collection c ON c.collection_identifier = n.collection SET n.collection_id = c.collection_id WHERE n.collection != "" AND n.collection IS NOT NULL AND n.news_type = "card"');
        $this->addSql('UPDATE card_news_archive n INNER JOIN collection c ON c.collection_identifier = n.identifier SET n.collection_id = c.collection_id WHERE n.identifier != "" AND n.identifier IS NOT NULL AND n.news_type = "collection"');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('UPDATE card_news SET card_id = NULL, collection_id = NULL');
        $this->addSql('UPDATE card_news_archive SET card_id = NULL, collection_id = NULL');
    }
}
