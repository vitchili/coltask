<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\UpdateTaskChangeRequest;
use App\Http\Requests\Task\UpdateFaseChangeRequest;
use App\Models\Task;
use App\Models\Fase;
use App\Services\Drive\TaskAttachmentsUploadService;
use App\Services\EditorFormatter\EditorContentFormatterService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskChangeController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function saveTaskChanges(UpdateTaskChangeRequest $request, int $id): JsonResponse|array
    {
        $data = $request->all();
        try{
            $task = Task::findOrFail($id);
            $task->fill($data);
            
            $formatter = new EditorContentFormatterService($data['modification']);
            $modification = $formatter->getContentWithoutBase64();
            $task->modification = $modification;
            $task->modification_finished_at = now();
            $task->save();
            
            
            $base64Files = $formatter->getBase64FilesFromContent();
            if(! empty($base64Files)){
                $driver = new TaskAttachmentsUploadService($base64Files, $task->id, 'modifications');
                $driver->convertBase64ToBinary();
                $driver->uploadAttachmentsToDrive();
            }
            
            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $task->toArray())
            , 200);  
        }
        catch(Exception $e){
            return [
                'request_status' => 'Erro ao editar tarefa.', 
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Change the actual fase of this task
     */
    public function saveFaseChange(UpdateFaseChangeRequest $request, int $id): JsonResponse|array
    {
        $task = Task::findOrFail($id);

        try{
            switch($request->faseId){
                case Fase::WAITING_DISTRIBUTION: $test = 1;
                break;
                case Fase::UNDER_REVIEW: $test = 1;
                break;
                case Fase::IN_PROGRESS: $test = 1;
                break;
                case Fase::IN_TEST: $test = 1;
                break;
                case Fase::IN_REFACTORING: $test = 1;
                break;
                case Fase::WAITING_PUBLISHMENT: $test = 1;
                break;
                case Fase::FINISHED_BY_DEVELOPMENT: $test = 1;
                break;
                case Fase::FINISHED_BY_SUPPORT: $test = 1;
                break;
                case Fase::CANCELED: $test = 1;
                break;
                case Fase::INACTIVE_WAITING_FEEDBACK: $test = 1;
                break;
                case Fase::INACTIVE_OTHER_REASON: $test = 1;
                break;
            }


            
            $task->fase_id = $request->faseId;
            $task->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $task->toArray())
            , 200);  
        }
        catch(Exception $e){
            return [
                'request_status' => 'Erro ao editar tarefa.', 
                'message' => $e->getMessage()
            ];
        }
    }

}
