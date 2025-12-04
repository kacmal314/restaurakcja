<?php

use App\Helper\Enumeration\Status;
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
    Schema::create('task_apis', function (Blueprint $table) {
      $table->id();
      $table->timestamps();

      //
      $table->string('body', 255)->nullable(false);
      
      //
      $casesAsString = [];
      foreach (Status::cases() as $key => $case)
      {
        $casesAsString[] = $case->value;
      }

      $table->enum('status', $casesAsString)->nullable(false);

      //
      $table->timestamp('done_at')
        ->nullable(true)
        ->default(null);
    });
  }
  
  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
    Schema::dropIfExists('task_apis');
  }
};
