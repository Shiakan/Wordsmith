<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180822061049 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE has_read_subcategory (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, subcategory_id INT DEFAULT NULL, thread_count INT DEFAULT NULL, post_count INT DEFAULT NULL, INDEX IDX_704C426CA76ED395 (user_id), INDEX IDX_704C426C5DC6FE57 (subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE has_read_subcategory ADD CONSTRAINT FK_704C426CA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE has_read_subcategory ADD CONSTRAINT FK_704C426C5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE has_read_thread DROP FOREIGN KEY FK_D9215A355DC6FE57');
        $this->addSql('DROP INDEX IDX_D9215A355DC6FE57 ON has_read_thread');
        $this->addSql('ALTER TABLE has_read_thread DROP subcategory_id, DROP thread_count');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE has_read_subcategory');
        $this->addSql('ALTER TABLE has_read_thread ADD subcategory_id INT DEFAULT NULL, ADD thread_count INT DEFAULT NULL');
        $this->addSql('ALTER TABLE has_read_thread ADD CONSTRAINT FK_D9215A355DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('CREATE INDEX IDX_D9215A355DC6FE57 ON has_read_thread (subcategory_id)');
    }
}
