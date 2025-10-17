<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 'role' কলাম যুক্ত করা
            $table->string('role')->default('salesman')->after('password'); 
            
            // SCM ID কলাম যুক্ত করা (nullable, কারণ Admin বা Salesman-এর জন্য প্রয়োজন নেই)
            $table->unsignedBigInteger('depo_id')->nullable()->after('role');
            $table->unsignedBigInteger('distributor_id')->nullable()->after('depo_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'depo_id', 'distributor_id']);
        });
    }
};