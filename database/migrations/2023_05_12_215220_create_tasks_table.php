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
            $table->text('description');
            $table->foreignIdFor(\App\Models\Direction::class, 'direction_id');
            $table->foreignIdFor(\App\Models\Screen::class, 'screen_id')->nullable();
            $table->foreignIdFor(\App\Models\Priority::class, 'priority_id')->nullable();
            $table->timestamp('dead_line', $precision = 0)->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'sponsor_id')->nullable();
            $table->timestamp('started_at', $precision = 0)->nullable();
            $table->text('modification')->nullable();
            $table->timestamp('modification_finished_at', $precision = 0)->nullable();
            $table->string('branch')->nullable();
            $table->string('link_merge_request')->nullable(); 
            $table->foreignIdFor(\App\Models\User::class, 'qa_id')->nullable();
            $table->char('approved_or_failed', 1)->nullable();
            $table->text('test_ocorrency')->nullable();
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
            $table->boolean('not_email_owner')->default('1');
            $table->boolean('not_email_copies')->default('1');
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
