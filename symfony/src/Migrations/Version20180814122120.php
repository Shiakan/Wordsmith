<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180814122120 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE room_user (room_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EE973C2D54177093 (room_id), INDEX IDX_EE973C2DA76ED395 (user_id), PRIMARY KEY(room_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_user ADD CONSTRAINT FK_EE973C2D54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_user ADD CONSTRAINT FK_EE973C2DA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B649A58CD');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B71764C85');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B8458FFE1');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BFC6BF02');
        $this->addSql('DROP INDEX UNIQ_729F519B649A58CD ON room');
        $this->addSql('DROP INDEX UNIQ_729F519BFC6BF02 ON room');
        $this->addSql('DROP INDEX UNIQ_729F519B71764C85 ON room');
        $this->addSql('DROP INDEX UNIQ_729F519B8458FFE1 ON room');
        $this->addSql('ALTER TABLE room DROP player_one_id, DROP player_two_id, DROP player_three_id, DROP player_four_id');
        $this->addSql('ALTER TABLE subcategory ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9F85E0677 ON app_user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9E7927C74 ON app_user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE room_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9F85E0677 ON app_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9E7927C74 ON app_user');
        $this->addSql('ALTER TABLE category DROP description');
        $this->addSql('ALTER TABLE room ADD player_one_id INT DEFAULT NULL, ADD player_two_id INT DEFAULT NULL, ADD player_three_id INT DEFAULT NULL, ADD player_four_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B649A58CD FOREIGN KEY (player_one_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B71764C85 FOREIGN KEY (player_three_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B8458FFE1 FOREIGN KEY (player_four_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BFC6BF02 FOREIGN KEY (player_two_id) REFERENCES app_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519B649A58CD ON room (player_one_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519BFC6BF02 ON room (player_two_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519B71764C85 ON room (player_three_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_729F519B8458FFE1 ON room (player_four_id)');
        $this->addSql('ALTER TABLE subcategory DROP description');
    }
}
