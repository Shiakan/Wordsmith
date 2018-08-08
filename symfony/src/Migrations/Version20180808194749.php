<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180808194749 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE charactersheet ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE charactersheet ADD CONSTRAINT FK_CDE5F561A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CDE5F561A76ED395 ON charactersheet (user_id)');
        $this->addSql('ALTER TABLE character_profile ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A32A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E8F22A32A76ED395 ON character_profile (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A32A76ED395');
        $this->addSql('DROP INDEX UNIQ_E8F22A32A76ED395 ON character_profile');
        $this->addSql('ALTER TABLE character_profile DROP user_id');
        $this->addSql('ALTER TABLE charactersheet DROP FOREIGN KEY FK_CDE5F561A76ED395');
        $this->addSql('DROP INDEX UNIQ_CDE5F561A76ED395 ON charactersheet');
        $this->addSql('ALTER TABLE charactersheet DROP user_id');
    }
}
