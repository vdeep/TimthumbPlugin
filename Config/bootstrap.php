<?php

Configure::write('TimthumbBasePath', '/app/webroot');
Configure::write('TimthumbCacheDir', TMP . DS . 'timthumb');

// Path of the image to use in case the passed image does not exist
// This is relative to 'TimthumbBasePath'
// Configure::write('TimthumbDefaultImg', '/img/placeholder.png');