<?php

namespace App\Http\Controllers;

use App\Services\Drive\TaskAttachmentsUploadService;
use Exception;

class TaskAttachmentController extends Controller
{

    /**
     * Get base64 files from the id task
     */
    public function getBase64Attachments(int $taskId, string $directoryKey): array|string
    {
        try{
            $driver = new TaskAttachmentsUploadService([], $taskId, $directoryKey);
            $driver->getBinaryFilesFromStorage();
            $base64Files = $driver->convertBinaryToBase64();

            return json_encode($base64Files);
        }
        catch(Exception $e){
            return [
                'request_status' => 'Erro ao buscar anexos.', 
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Get base64 files from this task attachments
     */
    public function deleteTaskAttachment(int $taskId, string $directoryKey, int $fileId): array|string
    {
        try{
            $driver = new TaskAttachmentsUploadService([], $taskId, $directoryKey);
            $driver->getBinaryFilesFromStorage();
            $numberOfDeletedFiles = $driver->deleteFilesFromStorage($fileId);

            return response()->json([
                'request_status' => 'Arquivo excluído com sucesso.', 
                'count' => $numberOfDeletedFiles
            ], 200);
        }
        catch(Exception $e){
            return [
                'request_status' => 'Erro ao excluir anexos.', 
                'message' => $e->getMessage()
            ];
        }
    }
}
