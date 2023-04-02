<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402131501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE age_group (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cite_educative_feedback (id INT AUTO_INCREMENT NOT NULL, age_group_id INT NOT NULL, neighborhood_id INT NOT NULL, know_cite_educative TINYINT(1) NOT NULL, know_from VARCHAR(255) NOT NULL, memorable_activity VARCHAR(255) DEFAULT NULL, interested_in_activities TINYINT(1) NOT NULL, why_interested_in LONGTEXT DEFAULT NULL, development_domain VARCHAR(255) DEFAULT NULL, specific_activity VARCHAR(255) NOT NULL, INDEX IDX_DCC210A0B09E220E (age_group_id), INDEX IDX_DCC210A0803BB24B (neighborhood_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cite_educative_feedback_activity (cite_educative_feedback_id INT NOT NULL, activity_id INT NOT NULL, INDEX IDX_24D5AD0B80912941 (cite_educative_feedback_id), INDEX IDX_24D5AD0B81C06096 (activity_id), PRIMARY KEY(cite_educative_feedback_id, activity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE neighborhood (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, question VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_survey (question_id INT NOT NULL, survey_id INT NOT NULL, INDEX IDX_AA02B4F41E27F6BF (question_id), INDEX IDX_AA02B4F4B3FE509D (survey_id), PRIMARY KEY(question_id, survey_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions_choice (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, answer VARCHAR(255) NOT NULL, INDEX IDX_989D1F151E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cite_educative_feedback ADD CONSTRAINT FK_DCC210A0B09E220E FOREIGN KEY (age_group_id) REFERENCES age_group (id)');
        $this->addSql('ALTER TABLE cite_educative_feedback ADD CONSTRAINT FK_DCC210A0803BB24B FOREIGN KEY (neighborhood_id) REFERENCES neighborhood (id)');
        $this->addSql('ALTER TABLE cite_educative_feedback_activity ADD CONSTRAINT FK_24D5AD0B80912941 FOREIGN KEY (cite_educative_feedback_id) REFERENCES cite_educative_feedback (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cite_educative_feedback_activity ADD CONSTRAINT FK_24D5AD0B81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_survey ADD CONSTRAINT FK_AA02B4F41E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_survey ADD CONSTRAINT FK_AA02B4F4B3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questions_choice ADD CONSTRAINT FK_989D1F151E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cite_educative_feedback DROP FOREIGN KEY FK_DCC210A0B09E220E');
        $this->addSql('ALTER TABLE cite_educative_feedback DROP FOREIGN KEY FK_DCC210A0803BB24B');
        $this->addSql('ALTER TABLE cite_educative_feedback_activity DROP FOREIGN KEY FK_24D5AD0B80912941');
        $this->addSql('ALTER TABLE cite_educative_feedback_activity DROP FOREIGN KEY FK_24D5AD0B81C06096');
        $this->addSql('ALTER TABLE question_survey DROP FOREIGN KEY FK_AA02B4F41E27F6BF');
        $this->addSql('ALTER TABLE question_survey DROP FOREIGN KEY FK_AA02B4F4B3FE509D');
        $this->addSql('ALTER TABLE questions_choice DROP FOREIGN KEY FK_989D1F151E27F6BF');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE age_group');
        $this->addSql('DROP TABLE cite_educative_feedback');
        $this->addSql('DROP TABLE cite_educative_feedback_activity');
        $this->addSql('DROP TABLE neighborhood');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_survey');
        $this->addSql('DROP TABLE questions_choice');
        $this->addSql('DROP TABLE survey');
    }
}
