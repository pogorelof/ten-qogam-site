<?php

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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId("chat_id")->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger("sender_id");
            $table->unsignedBigInteger("recepient_id");
            $table->text("text");
            $table->timestamps();

            $table->foreign("sender_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreign("recepient_id")->references("id")->on("users")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
