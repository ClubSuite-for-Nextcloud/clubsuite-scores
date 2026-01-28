<?php
namespace OCA\ClubSuiteScores\Migrations;

use Doctrine\DBAL\Schema\Schema;
use OCP\Migration\IChange;

class Version20260104 implements IChange {
    public function changeSchema(Schema $schema): void {
        if (!$schema->hasTable('noten_score')) {
            $table = $schema->createTable('noten_score');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('title', 'string', ['length' => 255]);
            $table->addColumn('description', 'text', ['notnull' => false]);
            $table->addColumn('file_id', 'integer');
            $table->setPrimaryKey(['id']);
        }

        if (!$schema->hasTable('noten_part')) {
            $table = $schema->createTable('noten_part');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('score_id', 'integer');
            $table->addColumn('name', 'string', ['length' => 255]);
            $table->setPrimaryKey(['id']);
        }

        if (!$schema->hasTable('noten_assignment')) {
            $table = $schema->createTable('noten_assignment');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('part_id', 'integer');
            $table->addColumn('user_id', 'string', ['length' => 64]);
            $table->setPrimaryKey(['id']);
        }
    }

    public function getComment(): string { return 'Create noten tables'; }
}
