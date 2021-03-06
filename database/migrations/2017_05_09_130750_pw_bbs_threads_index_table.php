<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*

DROP TABLE IF EXISTS `pw_bbs_threads_index`;
CREATE TABLE `pw_bbs_threads_index` (
`tid` int(10) unsigned NOT NULL,
`fid` smallint(5) unsigned NULL DEFAULT '0',
`disabled` tinyint(3) unsigned NULL DEFAULT '0',
`created_time` int(10) unsigned NULL DEFAULT '0',
`lastpost_time` int(10) unsigned NULL DEFAULT '0',
PRIMARY KEY (`tid`),
KEY `idx_lastposttime` (`lastpost_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子索引表-新帖索引';

 */

class PwBbsThreadsIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pw_bbs_threads_index', function (Blueprint $table) {
            if (env('DB_CONNECTION', false) === 'mysql') {
                $table->engine = 'InnoDB';
            }
            $table->integer('tid')->unsigned()->nullable();
            $table->smallInteger('fid')->unsigned()->nullable()->default(0);
            $table->tinyInteger('disabled')->unsigned()->nullable()->default(0);
            $table->integer('created_time')->unsigned()->nullable()->default(0);
            $table->integer('lastpost_time')->unsigned()->nullable()->default(0);

            $table->primary('tid');
            $table->index('lastpost_time', 'idx_lastposttime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pw_bbs_threads_index');
    }
}
