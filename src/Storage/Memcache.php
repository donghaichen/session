<?php
/**
 * Created by PhpStorm.
 *
 * @author Donghaichen [<chendongahai888@gmail.com>]
 * todo 完善该类
 */

namespace Clovers\Session\Storage;


class Memcache implements SessionHandlerInterface
{

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
        return true;
    }
}