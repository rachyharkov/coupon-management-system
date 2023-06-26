<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Formulirs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'VARCHAR',
                'constraint'        => 36,
            ],
            'nama' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'field' => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
            'created_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'updated_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ],
            'deleted_at' => [
                'type'              => 'DATETIME',
                'null'              => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('formulirs');
    }

    public function down()
    {
        $this->forge->dropTable('formulirs');
    }
}
