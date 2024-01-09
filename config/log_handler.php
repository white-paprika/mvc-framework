<?php
 
function logException(Exception $exception) {
    $logMessage = date('Y-m-d H:i:s') . ' - ' . $exception->getMessage() . ' in ' .  $exception->getFile() . ' on line ' . $exception->getLine() . PHP_EOL;
    file_put_contents(ROOT_DIRECTORY . '/logfile.log', $logMessage, FILE_APPEND);  
}

set_exception_handler('logException');