<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180810163434 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room ADD player_two_id INT DEFAULT NULL, ADD player_three_id INT DEFAULT NULL, ADD player_four_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BFC6BF02 FOREIGN KEY (player_two_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B71764C85 FOREIGN KEY (player_three_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B8458FFE1 FOREIGN KEY (player_four_id) REFERENCES app_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519BFC6BF02 ON room (player_two_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519B71764C85 ON room (player_three_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519B8458FFE1 ON room (player_four_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BFC6BF02');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B71764C85');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B8458FFE1');
        $this->addSql('DROP INDEX UNIQ_729F519BFC6BF02 ON room');
        $this->addSql('DROP INDEX UNIQ_729F519B71764C85 ON room');
        $this->addSql('DROP INDEX UNIQ_729F519B8458FFE1 ON room');
        $this->addSql('ALTER TABLE room DROP player_two_id, DROP player_three_id, DROP player_four_id');
    }
}
