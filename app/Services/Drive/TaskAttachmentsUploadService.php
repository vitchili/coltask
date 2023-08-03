<?php 

namespace App\Services\Drive;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class TaskAttachmentsUploadService {

    public function __construct(public array $files = [], public int $taskId = 0, public string $directoryKey = 'attachments'){

    }

    /**
     * Makes the upload to storage
     * 
     * @return void
     */
    public function uploadAttachmentsToDrive() : void
    {
        $countFiles = $this->getCountAttachments();
        
        foreach($this->files as $key => $file){
            $binaryDataString = $file['file'];
            $fileName = intval(($key + 1) + $countFiles) . "." . $file['extension'];
            Storage::put("{$this->directoryKey}/{$this->taskId}" . '/' . $fileName, $binaryDataString);
        }
    }

    /**
     * Get count of files
     * 
     * @return int
     */
    public function getCountAttachments() : int
    {
        return count(Storage::files("{$this->directoryKey}/{$this->taskId}"));
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
     * @return array
     */
    public function getBinaryFilesFromStorage() : array
    {
        $files = Storage::files("{$this->directoryKey}/{$this->taskId}");
        $binaryFiles = [];

        foreach ($files as $file) {
            $explodeExtension = explode(".", $file);
            $extension = $explodeExtension[1];

            $binaryFiles[] =  [
                'file' => Storage::get($file),
                'extension' => $extension
            ];
        }

        $this->files = $binaryFiles;
        return $this->files;
    }

    /**
     * 
     * Convert an array of binary files to an array of base64 files.
     * Use it only if necessary
     * 
     * @return array
     */
    public function convertBinaryToBase64() : array
    {
        $base64Files = [];
        foreach($this->files as $key => $file){
            $base64Files[] = [
                'file' => base64_encode($file['file']),
                'extension' => $file['extension']
            ];
        }
        
        $this->files = $base64Files;
        return $this->files;
    }

    /**
     * Delete files of this task and this directory
     * 
     * @return int
     */
    public function deleteFilesFromStorage($fileId) : int
    {
        $files = Storage::files("{$this->directoryKey}/{$this->taskId}");
        $countDeletedFiles = 0;

        foreach ($files as $file) {
            $filename = basename(Storage::url($file));
            $filename = explode('.', $filename);
            if($filename[0] == $fileId){
                Storage::delete($file);
                $countDeletedFiles++;
            }
        }

        return $countDeletedFiles;
    }
    
}