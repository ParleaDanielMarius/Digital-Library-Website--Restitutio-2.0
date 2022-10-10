<?php
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


if(!function_exists('fileStorage')) {

    function fileStorage($type, $folderTitle, $request, $key)
    {
        try {
            // Array of invalid characters
            $invalidCharacters = ['#', '%', '&', '{', '}', '/', '<', '>', '*', '?', '$', '!', "'", '"', ':', '@', '+', '`', '|', '=', '.', ','];
            $length = strlen($folderTitle);
            // If name length is longer than defined value, truncate the name
            if ($length > 76) {
                $length = $length - ($length - 76);
                $folderTitle = substr($folderTitle, 0, $length);
            }
            // Remove all invalid characters
            $folderTitle = trim(str_replace($invalidCharacters, "", $folderTitle));
            // Store File
            $path = $request->file($key)->store($type . '/' . date('Y') . '/' . date('M') . '/' . $folderTitle, 'public');
        } catch (Exception $e) {
            // Log failure and return false
            Log::error('fileStorage - Failed:', [
                'user' => auth()->id(),
                'message' => $e,
            ]);
            return false;
        }
        // Log success and return file's path
        Log::notice('fileStorage:', [
            'path' => $path,
            'title' => $folderTitle,
            'user' => auth()->id(),
        ]);
        return $path;
    }
}
    if(!function_exists('fileDestroy')) {

        function fileDestroy($path, bool $deleteDirectory = false)
        {
            // Return false if path was not provided as an argument
            if ($path != null) {
                try {
                    // Delete File's Directory
                    if ($deleteDirectory) {
                        $fileName = pathinfo($path, PATHINFO_BASENAME);
                        $pathDir = str_replace('/' . $fileName, '', $path);
                        Storage::disk('public')->deleteDirectory($pathDir);
                    } else {
                        // Delete File
                        Storage::disk('public')->delete($path);
                    }
                } catch (Exception $e) {
                    // Log failure and return false
                    Log::error('fileDestroy - Failed:', [
                        'path' => $path,
                        'fileName' => $fileName,
                        'deleteDirectory' => $deleteDirectory,
                        'message' => $e,
                    ]);
                    return false;
                }
                // Log success and return true
                Log::notice('fileDestroy:', [
                    'path' => $path,
                    'fileName' => $fileName,
                    'deleteDirectory' => $deleteDirectory,
                ]);
                return true;
            } else {
                return false;
            }
        }

}
