<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180823104933 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post ADD subcategory_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D5DC6FE57 ON post (subcategory_id)');
        $this->addSql('ALTER TABLE has_read_subcategory ADD post_count INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE has_read_subcategory DROP post_count');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D5DC6FE57');
        $this->addSql('DROP INDEX IDX_5A8A6C8D5DC6FE57 ON post');
        $this->addSql('ALTER TABLE post DROP subcategory_id');
    }
}
