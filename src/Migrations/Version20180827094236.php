<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180827094236 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(128) NOT NULL, content LONGTEXT NOT NULL, slug VARCHAR(128) DEFAULT NULL, date_inserted DATETIME NOT NULL, status TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_23A0E66F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_tag (article_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_919694F97294869C (article_id), INDEX IDX_919694F9BAD26311 (tag_id), PRIMARY KEY(article_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, author_id INT NOT NULL, content LONGTEXT NOT NULL, status TINYINT(1) NOT NULL, date_inserted DATETIME NOT NULL, INDEX IDX_9474526C7294869C (article_id), INDEX IDX_9474526CF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(256) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE character_profile (id INT AUTO_INCREMENT NOT NULL, group_forum_id INT DEFAULT NULL, rank_id INT DEFAULT NULL, user_id INT NOT NULL, avatar VARCHAR(255) NOT NULL, age VARCHAR(32) DEFAULT NULL, race VARCHAR(128) DEFAULT NULL, class VARCHAR(128) DEFAULT NULL, social_cast VARCHAR(128) DEFAULT NULL, localisation VARCHAR(128) DEFAULT NULL, miscellaneous LONGTEXT DEFAULT NULL, link1 VARCHAR(255) DEFAULT NULL, link2 VARCHAR(255) DEFAULT NULL, character_name VARCHAR(255) DEFAULT NULL, INDEX IDX_E8F22A3220FCF6AF (group_forum_id), INDEX IDX_E8F22A327616678F (rank_id), UNIQUE INDEX UNIQ_E8F22A32A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_forum (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, color VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, thread_id INT NOT NULL, subcategory_id INT NOT NULL, content LONGTEXT NOT NULL, status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_5A8A6C8DF675F31B (author_id), INDEX IDX_5A8A6C8DE2904019 (thread_id), INDEX IDX_5A8A6C8D5DC6FE57 (subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(256) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcategory (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, last_post_id INT DEFAULT NULL, name VARCHAR(256) NOT NULL, description LONGTEXT DEFAULT NULL, reminder LONGTEXT DEFAULT NULL, is_private TINYINT(1) NOT NULL, slug VARCHAR(255) DEFAULT NULL, INDEX IDX_DDCA44812469DE2 (category_id), UNIQUE INDEX UNIQ_DDCA4482D053F64 (last_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, dungeonmaster_id INT NOT NULL, name VARCHAR(32) NOT NULL, code VARCHAR(64) NOT NULL, INDEX IDX_729F519B499F6A47 (dungeonmaster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_user (room_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EE973C2D54177093 (room_id), INDEX IDX_EE973C2DA76ED395 (user_id), PRIMARY KEY(room_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_user (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, username VARCHAR(64) NOT NULL, email VARCHAR(128) NOT NULL, password VARCHAR(256) NOT NULL, is_active TINYINT(1) NOT NULL, birthdate DATE NOT NULL, date_inserted DATETIME NOT NULL, date_updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_88BDF3E9F85E0677 (username), UNIQUE INDEX UNIQ_88BDF3E9E7927C74 (email), INDEX IDX_88BDF3E9D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE charactersheet (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, content LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_CDE5F561A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thread (id INT AUTO_INCREMENT NOT NULL, subcategory_id INT NOT NULL, author_id INT NOT NULL, last_post_id INT DEFAULT NULL, title VARCHAR(256) NOT NULL, subtitle VARCHAR(256) DEFAULT NULL, status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, slug VARCHAR(255) DEFAULT NULL, INDEX IDX_31204C835DC6FE57 (subcategory_id), INDEX IDX_31204C83F675F31B (author_id), UNIQUE INDEX UNIQ_31204C832D053F64 (last_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE has_read_subcategory (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, subcategory_id INT DEFAULT NULL, thread_count INT DEFAULT NULL, post_count INT DEFAULT NULL, INDEX IDX_704C426CA76ED395 (user_id), INDEX IDX_704C426C5DC6FE57 (subcategory_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE has_read_thread (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, thread_id INT DEFAULT NULL, post_count INT DEFAULT NULL, INDEX IDX_D9215A35A76ED395 (user_id), INDEX IDX_D9215A35E2904019 (thread_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) NOT NULL, code VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE article_tag ADD CONSTRAINT FK_919694F97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_tag ADD CONSTRAINT FK_919694F9BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A3220FCF6AF FOREIGN KEY (group_forum_id) REFERENCES group_forum (id)');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A327616678F FOREIGN KEY (rank_id) REFERENCES rank (id)');
        $this->addSql('ALTER TABLE character_profile ADD CONSTRAINT FK_E8F22A32A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DE2904019 FOREIGN KEY (thread_id) REFERENCES thread (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA44812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA4482D053F64 FOREIGN KEY (last_post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B499F6A47 FOREIGN KEY (dungeonmaster_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE room_user ADD CONSTRAINT FK_EE973C2D54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room_user ADD CONSTRAINT FK_EE973C2DA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E9D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE charactersheet ADD CONSTRAINT FK_CDE5F561A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C835DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C83F675F31B FOREIGN KEY (author_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C832D053F64 FOREIGN KEY (last_post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE has_read_subcategory ADD CONSTRAINT FK_704C426CA76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE has_read_subcategory ADD CONSTRAINT FK_704C426C5DC6FE57 FOREIGN KEY (subcategory_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE has_read_thread ADD CONSTRAINT FK_D9215A35A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE has_read_thread ADD CONSTRAINT FK_D9215A35E2904019 FOREIGN KEY (thread_id) REFERENCES thread (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_tag DROP FOREIGN KEY FK_919694F97294869C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('ALTER TABLE article_tag DROP FOREIGN KEY FK_919694F9BAD26311');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA44812469DE2');
        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A3220FCF6AF');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA4482D053F64');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C832D053F64');
        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A327616678F');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D5DC6FE57');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C835DC6FE57');
        $this->addSql('ALTER TABLE has_read_subcategory DROP FOREIGN KEY FK_704C426C5DC6FE57');
        $this->addSql('ALTER TABLE room_user DROP FOREIGN KEY FK_EE973C2D54177093');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F675F31B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE character_profile DROP FOREIGN KEY FK_E8F22A32A76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF675F31B');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B499F6A47');
        $this->addSql('ALTER TABLE room_user DROP FOREIGN KEY FK_EE973C2DA76ED395');
        $this->addSql('ALTER TABLE charactersheet DROP FOREIGN KEY FK_CDE5F561A76ED395');
        $this->addSql('ALTER TABLE thread DROP FOREIGN KEY FK_31204C83F675F31B');
        $this->addSql('ALTER TABLE has_read_subcategory DROP FOREIGN KEY FK_704C426CA76ED395');
        $this->addSql('ALTER TABLE has_read_thread DROP FOREIGN KEY FK_D9215A35A76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DE2904019');
        $this->addSql('ALTER TABLE has_read_thread DROP FOREIGN KEY FK_D9215A35E2904019');
        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E9D60322AC');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_tag');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE character_profile');
        $this->addSql('DROP TABLE group_forum');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE rank');
        $this->addSql('DROP TABLE subcategory');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_user');
        $this->addSql('DROP TABLE app_user');
        $this->addSql('DROP TABLE charactersheet');
        $this->addSql('DROP TABLE thread');
        $this->addSql('DROP TABLE has_read_subcategory');
        $this->addSql('DROP TABLE has_read_thread');
        $this->addSql('DROP TABLE role');
    }
}
