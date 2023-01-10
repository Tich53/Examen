<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107145436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scraping_historical DROP FOREIGN KEY FK_AD7CC5B282E2E9B');
        $this->addSql('DROP INDEX IDX_AD7CC5B282E2E9B ON scraping_historical');
        $this->addSql('ALTER TABLE scraping_historical CHANGE website_id_id website_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE scraping_historical ADD CONSTRAINT FK_AD7CC5B18F45C82 FOREIGN KEY (website_id) REFERENCES website (id)');
        $this->addSql('CREATE INDEX IDX_AD7CC5B18F45C82 ON scraping_historical (website_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scraping_historical DROP FOREIGN KEY FK_AD7CC5B18F45C82');
        $this->addSql('DROP INDEX IDX_AD7CC5B18F45C82 ON scraping_historical');
        $this->addSql('ALTER TABLE scraping_historical CHANGE website_id website_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE scraping_historical ADD CONSTRAINT FK_AD7CC5B282E2E9B FOREIGN KEY (website_id_id) REFERENCES website (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AD7CC5B282E2E9B ON scraping_historical (website_id_id)');
    }
}
