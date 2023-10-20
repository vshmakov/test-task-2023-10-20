<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20231020175427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates survey, question, question_option, survey_template, question_template, question_option_template tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_option_template_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_template_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE survey_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE survey_template_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, survey_id INT NOT NULL, title VARCHAR(255) NOT NULL, is_answered BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6F7494EB3FE509D ON question (survey_id)');
        $this->addSql('CREATE TABLE question_option (id INT NOT NULL, question_id INT NOT NULL, title VARCHAR(255) NOT NULL, is_right BOOLEAN NOT NULL, is_chosen BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5DDB2FB81E27F6BF ON question_option (question_id)');
        $this->addSql('CREATE TABLE question_option_template (id INT NOT NULL, question_id INT NOT NULL, title VARCHAR(255) NOT NULL, is_right BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_739E040A1E27F6BF ON question_option_template (question_id)');
        $this->addSql('CREATE TABLE question_template (id INT NOT NULL, survey_id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F468AF8FB3FE509D ON question_template (survey_id)');
        $this->addSql('CREATE TABLE survey (id INT NOT NULL, template_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AD5F9BFC5DA0FB8 ON survey (template_id)');
        $this->addSql('CREATE TABLE survey_template (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EB3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_option ADD CONSTRAINT FK_5DDB2FB81E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_option_template ADD CONSTRAINT FK_739E040A1E27F6BF FOREIGN KEY (question_id) REFERENCES question_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question_template ADD CONSTRAINT FK_F468AF8FB3FE509D FOREIGN KEY (survey_id) REFERENCES survey_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE survey ADD CONSTRAINT FK_AD5F9BFC5DA0FB8 FOREIGN KEY (template_id) REFERENCES survey_template (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_option_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_option_template_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_template_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE survey_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE survey_template_id_seq CASCADE');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494EB3FE509D');
        $this->addSql('ALTER TABLE question_option DROP CONSTRAINT FK_5DDB2FB81E27F6BF');
        $this->addSql('ALTER TABLE question_option_template DROP CONSTRAINT FK_739E040A1E27F6BF');
        $this->addSql('ALTER TABLE question_template DROP CONSTRAINT FK_F468AF8FB3FE509D');
        $this->addSql('ALTER TABLE survey DROP CONSTRAINT FK_AD5F9BFC5DA0FB8');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE question_option');
        $this->addSql('DROP TABLE question_option_template');
        $this->addSql('DROP TABLE question_template');
        $this->addSql('DROP TABLE survey');
        $this->addSql('DROP TABLE survey_template');
    }
}
