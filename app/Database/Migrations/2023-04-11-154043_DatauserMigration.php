<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datauser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'auto_increment'=>true,'null'=>false],
            'nama'              => ['type'=>'varchar','constraint'=>50,'null'=>true],
            'username'          => ['type'=>'varchar','constraint'=>20,'null'=>true],
            'password'          => ['type'=>'varchar','constraint'=>60,'null'=>true],
            'level'             => ['type'=>'enum("Pengguna","Bengkel","Admin")','null'=>true],
            'alamat'            => ['type'=>'varchar','constraint'=>50,'null'=>true],
            'foto'                  => ['type'=> 'varchar','constraint'=>255, 'null'=>true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('data_user');
    }
    
    public function down()
    {
        $this->forge->dropTable('data_user');
    }
}
