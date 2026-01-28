<?php
namespace OCA\ClubSuiteScores\Migrations;

use OCP\AppFramework\Db\SchemaTrait;
use OCP\Migration\IMigration;
use OCP\Migration\IOutput;

class Version20260105_AddIndexes implements IMigration {
    use SchemaTrait;

    public function changeSchema(IOutput $output) {
        $schema = $this->getSchema();
        if ($schema->hasTable('noten_score')) {
            $t = $schema->getTable('noten_score');
            if (!$t->hasIndex('idx_noten_score_file')) {
                $t->addIndex(['file_id'], 'idx_noten_score_file');
            }
        }
    }

    public function up(IOutput $output) {
        $this->changeSchema($output);
    }

    public function down(IOutput $output) {
        // no-op
    }
}
