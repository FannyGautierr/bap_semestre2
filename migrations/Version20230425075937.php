<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425075937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25A85ACFDA');
        $this->addSql('DROP INDEX IDX_DADD4A25A85ACFDA ON answer');
        $this->addSql('ALTER TABLE answer DROP submitter_id_id');
        $this->addSql('ALTER TABLE submitter DROP FOREIGN KEY FK_E6D2588B73346C6F');
        $this->addSql('DROP INDEX IDX_E6D2588B73346C6F ON submitter');
        $this->addSql('ALTER TABLE submitter ADD survey_id INT DEFAULT NULL, DROP survey_id_id');
        $this->addSql('ALTER TABLE submitter ADD CONSTRAINT FK_E6D2588BB3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id)');
        $this->addSql('CREATE INDEX IDX_E6D2588BB3FE509D ON submitter (survey_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer ADD submitter_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25A85ACFDA FOREIGN KEY (submitter_id_id) REFERENCES submitter (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DADD4A25A85ACFDA ON answer (submitter_id_id)');
        $this->addSql('ALTER TABLE submitter DROP FOREIGN KEY FK_E6D2588BB3FE509D');
        $this->addSql('DROP INDEX IDX_E6D2588BB3FE509D ON submitter');
        $this->addSql('ALTER TABLE submitter ADD survey_id_id INT NOT NULL, DROP survey_id');
        $this->addSql('ALTER TABLE submitter ADD CONSTRAINT FK_E6D2588B73346C6F FOREIGN KEY (survey_id_id) REFERENCES survey (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E6D2588B73346C6F ON submitter (survey_id_id)');
    }
}
