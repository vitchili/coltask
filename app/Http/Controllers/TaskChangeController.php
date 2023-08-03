<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\UpdateTaskChangeRequest;
use App\Models\Task;
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

}
