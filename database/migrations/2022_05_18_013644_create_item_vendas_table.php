<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Produto;
use App\Models\Venda;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_venda', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Venda::class);
            $table->foreignIdFor(Produto::class);
            $table->decimal("unitario", $precision = 30, $scale = 6);
            $table->integer("qtd");
            $table->foreign("venda_id")->references("id")->on("venda");
            $table->foreign("produto_id")->references("id")->on("produto");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_venda');
    }
};
