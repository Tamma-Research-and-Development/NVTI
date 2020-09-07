<?php 
trait deleteFile
{
    public function filePointer($filename)
    {
        unlink(FILE_UPLOAD_PATH.$filename);
    }
} // END trait ClassName 
?>