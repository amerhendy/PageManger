<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->uid();
            $table->string('template')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->Text('content')->nullable();
            $table->jsonb('extras')->nullable();
            $table->dates();
        });
    }
          public function down(): void
    {
        $tables=[];
        Schema::dropIfExists('pages');
    }
};
