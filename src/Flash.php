<?php

namespace Clovers\Session;

class Flash
{
    
    protected $data = array();
    
    protected $session;
    
    public function __construct(array $session = array())
    {
        $this->session = $session;
    }
    
    /**
     * Stores a value
     *
     * @access  public
     *
     * @return  \Clovers\Session\Flash
     */
    
    public function set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }
    
    /**
     * Retrive a value
     * 
     * @access  public
     *
     * @param   string  $key        Key
     * @param   mixed   $default    (optional)  Default value
     * 
     * @return  \Clovers\Session\Flash
     */
    
    public function get($key, $default = null)
    {
        if(isset($this->data[$key]))
        {
            return $this->data[$key];
        }
        
        return isset($this->session[$key]) ? $this->session[$key] : $default;
    }
    
    /**
     * Retrive the value associated with the specified key or associate
     * the specified key with the value returned by invoking the callback.
     *
     * @access  public
     *
     * @param   string      $key        Key
     * @param   \Clovers    $callback   Callback
     *
     * @return  mixed
     */
    
    public function load($key, Clovers $callback)
    {
        if(!$this->has($key))
        {
            $this->set($key, $callback($key));
        }
        
        return $this->get($key);
    }
    
    /**
     * Removes specified key
     *
     * @access  public
     *
     * @return  \Clovers\Session\Flash
     */
    
    public function delete($key)
    {
        unset($this->data[$key]);
        return $this;
    }
    
    /**
     * Check if a key exists
     *
     * @access  public
     *
     * @return  boolean
     */
    
    public function has($key)
    {
        return isset($this->data[$key]) || isset($this->session[$key]);
    }
    
    /**
     * Clear or replace data
     * 
     * @access  public
     *
     * @param   array   $data   (optional) Data
     * 
     * @return  \Clovers\Session\Flash
     */
    
    public function clear(array $data = array())
    {
        $this->data = $data;
        $this->session = array();
        return $this;
    }
    
    /**
     * Reflash data
     * 
     * @access  public
     *
     * @param   array   $keys   (optional) Data
     * 
     * @return  \Clovers\Session\Flash
     */
    
    public function reflash(array $keys = array())
    {
        $data = empty($keys) ? $this->session : array_intersect_key($this->session, array_flip($keys));
        return $this->clear($data);
    }
    
    /**
     * Return saved data
     * 
     * @access  public
     * 
     * @return  array
     */
    
    public function toArray()
    {
        return $this->data;
    }
}
