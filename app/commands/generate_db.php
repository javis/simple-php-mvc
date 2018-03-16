<?php
require_once dirname(__DIR__).'/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Generates DB Schema
 */
 Capsule::schema()->create('authors', function ($table) {
     $table->increments('id');
     $table->string('full_name');
     $table->nullableTimestamps();
 });

 Capsule::schema()->create('books', function ($table) {
     $table->increments('id');
     $table->integer('author_id')->unsigned();
     $table->foreign('author_id')
     ->references('id')->on('authors')
     ->onDelete('cascade');
     $table->string('title');
     $table->string('description');
     $table->nullableTimestamps();
 });

 echo "Schema created succesfully\n";
