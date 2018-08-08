<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180808143613 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E9636119E');
        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E996FF67E5');
        $this->addSql('DROP INDEX UNIQ_88BDF3E996FF67E5 ON app_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9636119E ON app_user');
        $this->addSql('ALTER TABLE app_user DROP charactersheet_id, DROP characterprofile_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_user ADD charactersheet_id INT NOT NULL, ADD characterprofile_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E9636119E FOREIGN KEY (characterprofile_id) REFERENCES character_profile (id)');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E996FF67E5 FOREIGN KEY (charactersheet_id) REFERENCES charactersheet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E996FF67E5 ON app_user (charactersheet_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9636119E ON app_user (characterprofile_id)');
    }
}
