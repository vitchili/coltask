<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Client::class, 'client_id');
            $table->string('email_copy')->nullable();
            $table->string('outside_requester')->nullable();
            $table->char('type', 1)->comment('E=error,F=feature,H=help,S=service');
            $table->string('title');
            $table->string('description');
            $table->foreignIdFor(\App\Models\Direction::class, 'direction_id');
            $table->foreignIdFor(\App\Models\Screen::class, 'screen_id');
            $table->foreignIdFor(\App\Models\Priority::class, 'priority_id');
            $table->timestamp('dead_line', $precision = 0)->nullable();
            $table->string('attachment_json')->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'sponsor_id')->nullable();
            $table->timestamp('started_at', $precision = 0)->nullable();
            $table->string('modification')->nullable();
            $table->timestamp('modification_finished_at', $precision = 0)->nullable();
            $table->string('branch')->nullable();
            $table->char('approved_or_failed', 1)->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'approved_or_failed_by')->nullable();
            $table->timestamp('last_approval', $precision = 0)->nullable();
            $table->timestamp('last_failed', $precision = 0)->nullable();
            $table->boolean('deployed')->default('0');
            $table->timestamp('deployed_at', $precision = 0)->nullable();
            $table->boolean('canceled')->default('0');
            $table->foreignIdFor(\App\Models\User::class, 'created_by');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->foreignIdFor(\App\Models\Fase::class, 'fase_id');
            $table->foreignIdFor(\App\Models\Sprint::class, 'sprint_id')->nullable();
            $table->boolean('visibility')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
