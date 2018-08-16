<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180816130834 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subcategory ADD reminder LONGTEXT DEFAULT NULL, ADD is_private TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A3220FCF6AF FOREIGN KEY (group_forum_id) REFERENCES group_forum (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A3220FCF6AF');
        $this->addSql('ALTER TABLE subcategory DROP reminder, DROP is_private');
    }
}
