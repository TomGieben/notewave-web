<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('notes');

        DB::statement("
            CREATE TABLE `notes` (
                `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                `user_id` BIGINT(20) UNSIGNED NOT NULL,
                `is_public` TINYINT(1) NOT NULL DEFAULT '0',
                `slug` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
                `title` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
                `content` LONGTEXT NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
                `sharing_key` VARCHAR(64) AS (SHA2(CONCAT(`user_id`, `created_at`), 256)) STORED,
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                `deleted_at` TIMESTAMP NULL DEFAULT NULL,
                PRIMARY KEY (`id`) USING BTREE,
                UNIQUE INDEX `notes_sharing_key_unique` (`sharing_key`) USING BTREE
            )
            COLLATE='latin1_swedish_ci'
            ENGINE=InnoDB
            AUTO_INCREMENT=54
        ");       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
