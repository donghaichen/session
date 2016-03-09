<?php
use Clovers\Session\Session;
use Clovers\Session\Storage\File;

        $session = new Session(new File(CACHE_PATH . '/session'));
        $session->set("age","100");
        $name = $session->get('age');
        var_dump($name);
