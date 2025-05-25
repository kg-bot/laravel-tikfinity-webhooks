<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tiktok_profiles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique()->index();
            $table->string('username')->index();
            $table->string('nickname')->index();
            $table->boolean('is_banned')->default(false)->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiktok_profiles');
    }
};
