<?php

App::uses('TimthumbAppController', 'Timthumb.Controller');

class TimthumbController extends TimthumbAppController {
    public function image() {
        $this->autoRender = false;
        $this->layout = null;
        if ( Configure::read('debug') !== 0 ) {
            define('DEBUG_ON', true);
        } else {
            define('DEBUG_ON', false);
        }
        define('FILE_CACHE_DIRECTORY', Configure::read('TimthumbCacheDir'));
        App::import('Vendor', 'Timthumb.timthumb');
    }
}