<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\UpdateTaskTestRequest;
use App\Models\Task;
use App\Services\Drive\TaskAttachmentsUploadService;
use App\Services\EditorFormatter\EditorContentFormatterService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskTestController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function saveTaskTests(UpdateTaskTestRequest $request, int $id): JsonResponse|array
    {
        $data = $request->all();
        try{
            $task = Task::findOrFail($id);
            $task->fill($data);
            
            $formatter = new EditorContentFormatterService($data['test_ocorrency']);
            $testOcorrency = $formatter->getContentWithoutBase64();
            $task->test_ocorrency = $testOcorrency;
            
            if($data['approved_or_failed'] == 'A'){
                $task->last_approval = now();
            }else if($data['approved_or_failed'] == 'F'){
                $task->last_failed = now();
            }

            $task->save();
            
            $base64Files = $formatter->getBase64FilesFromContent();
            if(! empty($base64Files)){
                $driver = new TaskAttachmentsUploadService($base64Files, $task->id, 'tests');
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

}
