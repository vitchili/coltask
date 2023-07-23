<?php 

namespace App\Services\Drive;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class TaskAttachmentsUploadService {

    public function __construct(public array $files, public int $taskId){

    }

    /**
     * Makes the upload to storage
     * 
     * @return void
     */
    public function uploadAttachmentsToDrive() : void
    {
        foreach($this->files as $key => $file){
            $binaryDataString = $file['file'];
            $fileName = $key . "." . $file['extension'];
            Storage::put("task/{$this->taskId}" . '/' . $fileName, $binaryDataString);
        }
    }

    /**
     * 
     * Convert an array of base64 images to an array of binary files.
     * Use it only if necessary
     * 
     * @return void
     */
    public function convertBase64ToBinary() : void
    {
        $binaryFiles = [];
        foreach($this->files as $key => $file){
            $binaryFiles[] = [
                'file' => base64_decode($file['file']),
                'extension' => $file['extension']
            ];
        }
        
        $this->files = $binaryFiles;
    }

    /**
     * Get filenames of attachments and organize it as a json
     * 
     * @return string
     */
    public function getFilenamesFromStorage() : string
    {
        $filenames = [];
        foreach($this->files as $key => $file){
            array_push($filenames, "/storage/task/{$this->taskId}/{$key}.{$file['extension']}");
        }

        return json_encode($filenames);
    }
    
}