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


    Schema::table('contact_inquiries', function (Blueprint $table) {
        $table->string('name')->after('id');
        $table->string('email')->after('name');
        $table->string('phone')->nullable()->after('email');
        $table->string('subject')->after('phone');
        $table->text('message')->after('subject');
        $table->enum('status', ['new', 'read', 'resolved'])
              ->default('new')
              ->after('message');
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('contact_inquiries', function (Blueprint $table) {
        $table->dropColumn([
            'name',
            'email',
            'phone',
            'subject',
            'message',
            'status',
        ]);
    });
    }
};
