<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DatareservasiMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'auto_increment'=>true,'null'=>false],
            'tgl_reservasi'         => ['type'=>'date', 'null'=>true],
            'data_user_id'          => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'null'=>false],
            'data_registrasi_id'    => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'null'=>false],
            'layanan_id'            => ['type'=>'int','constraint'=>4,'unsigned'=>true, 'null'=>false],
            'status'                => ['type'=>'int','constraint'=>2,'null'=>true],
            
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('data_user_id', 'data_user', 'id', 'cascade');
        $this->forge->addForeignKey('data_registrasi_id', 'data_registrasi', 'id', 'cascade');
        $this->forge->addForeignKey('layanan_id', 'layanan', 'id', 'cascade');

        $this->forge->createTable('data_reservasi');
    }
    
    public function down()
    {
        $this->forge->dropTable('data_reservasi');
    }
}
