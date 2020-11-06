<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatalogTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('image')->nullable();
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('description')->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('icon', 60)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('catalog_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('price')->unsigned()->default(0)->nullable();
            $table->integer('discount_price')->unsigned()->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 60)->default('in stock');
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->integer('order')->nullable()->default(999);
            $table->bigInteger('primary_category_id')->unsigned()->nullable();
            $table->string('image', 255)->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->string('format_type', 30)->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('catalog_product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->references('id')->on('catalog_categories')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->references('id')->on('catalog_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('catalog_product_categories');
        Schema::dropIfExists('catalog_products');
        Schema::dropIfExists('catalog_categories');
    }
}
