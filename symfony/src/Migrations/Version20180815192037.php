<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180815192037 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A3220FCF6AF');
        $this->addSql('CREATE TABLE group_forum (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, color VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9F85E0677 ON app_user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9E7927C74 ON app_user (email)');
        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A3220FCF6AF');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A3220FCF6AF FOREIGN KEY (group_forum_id) REFERENCES group_forum (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A3220FCF6AF');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL COLLATE utf8mb4_unicode_ci, color VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE group_forum');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9F85E0677 ON app_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9E7927C74 ON app_user');
        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A3220FCF6AF');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A3220FCF6AF FOREIGN KEY (group_forum_id) REFERENCES `group` (id)');
    }
}
