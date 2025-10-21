<?php

use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable();
            $table->decimal('total', 10, 2);
            $table->string('customername');
            $table->string('customerlastname');
            $table->string('customerprovince');
            $table->string('customermunicipality');
            $table->string('customerstreet');
            $table->string('customerphone');
            $table->string('customerotherphone')->nullable();
            $table->string('customerpaymenttype');
            $table->string('receipt');
            $table->string('finddetail')->nullable();
            $table->string('customerotheraddress', 255)->nullable();
            $table->enum('status',['Pendente','Entregue','Pago'])->default('Pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
