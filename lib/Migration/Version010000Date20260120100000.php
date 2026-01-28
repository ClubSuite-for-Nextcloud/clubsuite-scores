<?php

declare(strict_types=1);

namespace OCA\ClubSuiteScores\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

class Version010000Date20260120100000 extends SimpleMigrationStep {

    public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
        /** @var ISchemaWrapper $schema */
        $schema = $schemaClosure();

        if (!$schema->hasTable('clubsuite_scores')) {
            $table = $schema->createTable('clubsuite_scores');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
                'length' => 4,
            ]);
            $table->addColumn('title', 'string', [
                'notnull' => true,
                'length' => 255,
            ]);
            $table->addColumn('composer', 'string', [
                'notnull' => false,
                'length' => 255,
            ]);
            $table->addColumn('arranger', 'string', [
                'notnull' => false,
                'length' => 255,
            ]);
            $table->addColumn('genre', 'string', [
                'notnull' => false,
                'length' => 100,
            ]);
            $table->addColumn('difficulty', 'integer', [
                'notnull' => false,
                'default' => 0,
            ]);
            $table->addColumn('archive_location', 'string', [
                'notnull' => false,
                'length' => 100,
            ]);
            $table->setPrimaryKey(['id']);
        }

        if (!$schema->hasTable('clubsuite_score_parts')) {
            $table = $schema->createTable('clubsuite_score_parts');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
                'length' => 4,
            ]);
            $table->addColumn('score_id', 'integer', [
                'notnull' => true,
                'length' => 4,
            ]);
            $table->addColumn('instrument', 'string', [
                'notnull' => true,
                'length' => 100,
            ]);
            $table->addColumn('part_name', 'string', [
                'notnull' => true,
                'length' => 100,
            ]);
            $table->addColumn('is_digital', 'integer', [
                'notnull' => true,
                'default' => 0,
                'length' => 1,
            ]);
            $table->addColumn('file_path', 'string', [
                'notnull' => false,
                'length' => 255,
            ]);
            $table->setPrimaryKey(['id']);
            $table->addIndex(['score_id'], 'idx_parts_score');
        }

        if (!$schema->hasTable('clubsuite_score_loans')) {
            $table = $schema->createTable('clubsuite_score_loans');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
                'length' => 4,
            ]);
            $table->addColumn('part_id', 'integer', [
                'notnull' => true,
                'length' => 4,
            ]);
            $table->addColumn('user_id', 'string', [
                'notnull' => true,
                'length' => 64,
            ]);
            $table->addColumn('loaned_at', 'integer', [
                'notnull' => true,
            ]);
            $table->addColumn('returned_at', 'integer', [
                'notnull' => false,
            ]);
            $table->setPrimaryKey(['id']);
            $table->addIndex(['part_id'], 'idx_loans_part');
            $table->addIndex(['user_id'], 'idx_loans_user');
        }

        return $schema;
    }
}
