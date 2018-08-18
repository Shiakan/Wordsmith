<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180818135056 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE has_read_thread ADD user_id INT DEFAULT NULL, ADD thread_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE has_read_thread ADD CONSTRAINT FK_D9215A35A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE has_read_thread ADD CONSTRAINT FK_D9215A35E2904019 FOREIGN KEY (thread_id) REFERENCES thread (id)');
        $this->addSql('CREATE INDEX IDX_D9215A35A76ED395 ON has_read_thread (user_id)');
        $this->addSql('CREATE INDEX IDX_D9215A35E2904019 ON has_read_thread (thread_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE has_read_thread DROP FOREIGN KEY FK_D9215A35A76ED395');
        $this->addSql('ALTER TABLE has_read_thread DROP FOREIGN KEY FK_D9215A35E2904019');
        $this->addSql('DROP INDEX IDX_D9215A35A76ED395 ON has_read_thread');
        $this->addSql('DROP INDEX IDX_D9215A35E2904019 ON has_read_thread');
        $this->addSql('ALTER TABLE has_read_thread DROP user_id, DROP thread_id');
    }
}
