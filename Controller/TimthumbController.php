<?php

App::uses('TimthumbAppController', 'Timthumb.Controller');

class TimthumbController extends TimthumbAppController {
    public function image() {
        $this->autoRender = false;
        $this->layout = null;
        define('DEBUG_ON', true);
        define('FILE_CACHE_DIRECTORY', Configure::read('TimthumbCacheDir'));
        App::import('Vendor', 'Timthumb.timthumb');
    }
}