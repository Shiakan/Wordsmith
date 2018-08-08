<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180808130247 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_tag (article_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_919694F97294869C (article_id), INDEX IDX_919694F9BAD26311 (tag_id), PRIMARY KEY(article_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_user (room_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EE973C2D54177093 (room_id), INDEX IDX_EE973C2DA76ED395 (user_id), PRIMARY KEY(room_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_tag ADD CONSTRAINT FK_919694F97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_tag ADD CONSTRAINT FK_919694F9BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_user ADD CONSTRAINT FK_EE973C2D54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_user ADD CONSTRAINT FK_EE973C2DA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post ADD author_id INT NOT NULL, ADD thread_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DE2904019 FOREIGN KEY (thread_id) REFERENCES thread (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DE2904019 ON post (thread_id)');
        $this->addSql('ALTER TABLE article ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66F675F31B ON article (author_id)');
        $this->addSql('ALTER TABLE thread ADD subcategory_id INT NOT NULL, ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C835DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C83F675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_31204C835DC6FE57 ON thread (subcategory_id)');
        $this->addSql('CREATE INDEX IDX_31204C83F675F31B ON thread (author_id)');
        $this->addSql('ALTER TABLE app_user ADD roles_id INT NOT NULL, ADD charactersheet_id INT NOT NULL, ADD characterprofile_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E938C751C4 FOREIGN KEY (roles_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E996FF67E5 FOREIGN KEY (charactersheet_id) REFERENCES charactersheet (id)');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E9636119E FOREIGN KEY (characterprofile_id) REFERENCES character_profile (id)');
        $this->addSql('CREATE INDEX IDX_88BDF3E938C751C4 ON app_user (roles_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E996FF67E5 ON app_user (charactersheet_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9636119E ON app_user (characterprofile_id)');
        $this->addSql('ALTER TABLE comment ADD article_id INT NOT NULL, ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_9474526C7294869C ON comment (article_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('ALTER TABLE character_profile ADD group_forum_id INT DEFAULT NULL, ADD rank_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A3220FCF6AF FOREIGN KEY (group_forum_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A327616678F FOREIGN KEY (rank_id) REFERENCES rank (id)');
        $this->addSql('CREATE INDEX IDX_E8F22A3220FCF6AF ON character_profile (group_forum_id)');
        $this->addSql('CREATE INDEX IDX_E8F22A327616678F ON character_profile (rank_id)');
        $this->addSql('ALTER TABLE room ADD dungeonmaster_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B499F6A47 FOREIGN KEY (dungeonmaster_id) REFERENCES app_user (id)');
        $this->addSql('CREATE INDEX IDX_729F519B499F6A47 ON room (dungeonmaster_id)');
        $this->addSql('ALTER TABLE subcategory ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_DDCA44812469DE2 ON subcategory (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article_tag');
        $this->addSql('DROP TABLE room_user');
        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E938C751C4');
        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E996FF67E5');
        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E9636119E');
        $this->addSql('DROP INDEX IDX_88BDF3E938C751C4 ON app_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E996FF67E5 ON app_user');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9636119E ON app_user');
        $this->addSql('ALTER TABLE app_user DROP roles_id, DROP charactersheet_id, DROP characterprofile_id');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F675F31B');
        $this->addSql('DROP INDEX IDX_23A0E66F675F31B ON article');
        $this->addSql('ALTER TABLE article DROP author_id');
        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A3220FCF6AF');
        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A327616678F');
        $this->addSql('DROP INDEX IDX_E8F22A3220FCF6AF ON character_profile');
        $this->addSql('DROP INDEX IDX_E8F22A327616678F ON character_profile');
        $this->addSql('ALTER TABLE character_profile DROP group_forum_id, DROP rank_id');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('DROP INDEX IDX_9474526C7294869C ON comment');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B ON comment');
        $this->addSql('ALTER TABLE comment DROP article_id, DROP author_id');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF675F31B');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DE2904019');
        $this->addSql('DROP INDEX IDX_5A8A6C8DF675F31B ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8DE2904019 ON post');
        $this->addSql('ALTER TABLE post DROP author_id, DROP thread_id');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B499F6A47');
        $this->addSql('DROP INDEX IDX_729F519B499F6A47 ON room');
        $this->addSql('ALTER TABLE room DROP dungeonmaster_id');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA44812469DE2');
        $this->addSql('DROP INDEX IDX_DDCA44812469DE2 ON subcategory');
        $this->addSql('ALTER TABLE subcategory DROP category_id');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C835DC6FE57');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C83F675F31B');
        $this->addSql('DROP INDEX IDX_31204C835DC6FE57 ON thread');
        $this->addSql('DROP INDEX IDX_31204C83F675F31B ON thread');
        $this->addSql('ALTER TABLE thread DROP subcategory_id, DROP author_id');
    }
}
