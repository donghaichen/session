<?php
/**
 * 文件存储SESSION
 * User: donghai
 * Date: 16/3/10
 * Time: 15:27
 */
namespace Clovers\Session\Storage;
class File implements SessionHandlerInterface
{
    /** @var    string  Path. */
    protected $path;
    
    /**
     * Constructor
     *
     * @access  public
     * 
     * @param   string  $path   Folder path.
     */
    
    public function __construct($path)
    {
        $this->path = $path;
        
        if (!is_dir($path) && !@mkdir($path, 0777, true)) {
            throw new \RuntimeException('Session directory does not exist: "' . $path . '".');
        } 
        if (!is_writable($path)) {
            throw new \RuntimeException('Session directory is not writable: "' . $path . '".');
        }
    }
    
    /**
     * Destructor.
     *
     * @access  public
     */

    public function __destruct()
    {   
        // Fixes issue with Debian and Ubuntu session garbage collection
        if(mt_rand(1, 100) === 100)
        {
            $this->gc(ini_get('session.gc_maxlifetime'));
        }
    }

    /**
     * Open session.
     *
     * @access  public
     * 
     * @param   string  $savePath       Save path
     * @param   string  $sessionName    Session name
     * 
     * @return  boolean
     */

    public function open($savePath, $sessionName)
    {
        return true;
    }

    /**
     * Close session.
     *
     * @access  public
     * 
     * @return  boolean
     */

    public function close()
    {
        return true;
    }

    /**
     * Returns session data.
     *
     * @access  public
     * 
     * @param   string  $id Session id
     * 
     * @return  string
     */

    public function read($id)
    {
        $data = '';
        if(file_exists($this->path . '/' . $id) && is_readable($this->path . '/' . $id))
        {
            $data = (string) file_get_contents($this->path . '/' . $id);
        }
        return $data;
    }

    /**
     * Writes data to the session.
     *
     * @access  public
     * @param   string  $id    Session id
     * @param   string  $data  Session data
     */

    public function write($id, $data)
    {
        if(is_writable($this->path))
        {
            return file_put_contents($this->path . '/' . $id, $data) === false ? false : true;
        }
        return false;
    }

    /**
     * Destroys the session.
     *
     * @access  public
     * @param   string   $id  Session id
     * @return  boolean
     */

    public function destroy($id)
    {
        if(file_exists($this->path . '/' . $id) && is_writable($this->path . '/' . $id))
        {
            return unlink($this->path . '/' . $id);
        }
        return false;
    }

    /**
     * Garbage collector.
     *
     * @access  public
     * 
     * @param   int     $maxLifetime  Lifetime in secods
     * 
     * @return  boolean
     */

    public function gc($maxLifetime)
    {
        $files = glob($this->path . '/*');
        
        if(is_array($files))
        {
            foreach($files as $file)
            {
                if((filemtime($file) + $maxLifetime) < time() && is_writable($file))
                {
                    unlink($file);
                }
            }
        }
        
        return true;
    }
    
}
