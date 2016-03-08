<?php
interface SessionHandlerInterface
{
    function close();
    
    function destroy($id);
    
    function gc($maxlifetime);
    
    function open($path, $name);
    
    function read($id);
    
    function write($id, $data);
}
