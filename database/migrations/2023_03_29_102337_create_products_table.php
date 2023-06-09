<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SubCategory;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SubCategory::class)->constrained('sub_categories');
            $table->foreignIdFor(Category::class)->constrained('categories');
            $table->string('name');
            $table->text('description');
            $table->integer('price');
            $table->text('imageUrl');
            $table->integer('review_count');
            $table->float('avg_stars');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
