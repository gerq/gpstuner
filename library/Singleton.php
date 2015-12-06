<?php

class Singleton {

    /**
     * private instance, for singleton object
     * @access private
     */
    private static $instances;

    /**
     * private constructor, singleton
     * @access private
     */
    private function __construct()
    {
     
    }
    
    /**
     * singleton object, not cloning
     */
    public function __clone()
    {
        trigger_error('SINGLETON, NO CLONING', E_USER_ERROR);
    }

    /**
     * get singleton object 
     * @access public
     * @return 
     */
    public static function getInstance() {
        $class = get_called_class();

        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }

        self::$instances[$class]->init();

        return self::$instances[$class];
    }

    public function init() {
        
    }

}