<?php

Router::connect('/timthumb/*', array('controller' => 'timthumb', 'action' => 'image', 'plugin' => 'Timthumb'));