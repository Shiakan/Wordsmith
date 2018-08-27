<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180824130129 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subcategory ADD last_post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA4482D053F64 FOREIGN KEY (last_post_id) REFERENCES post (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DDCA4482D053F64 ON subcategory (last_post_id)');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C832D053F64 FOREIGN KEY (last_post_id) REFERENCES post (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_31204C832D053F64 ON thread (last_post_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA4482D053F64');
        $this->addSql('DROP INDEX UNIQ_DDCA4482D053F64 ON subcategory');
        $this->addSql('ALTER TABLE subcategory DROP last_post_id');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C832D053F64');
        $this->addSql('DROP INDEX UNIQ_31204C832D053F64 ON thread');
    }
}
