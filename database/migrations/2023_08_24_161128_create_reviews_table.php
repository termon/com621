<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            //$table->foreignIdFor(User::class)->constrained()->restrictOnDelete();   
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            
            //$table->string('name');
            $table->decimal('rating');
            $table->longtext('comment');
            $table->date('reviewed_on')->default(now());         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
