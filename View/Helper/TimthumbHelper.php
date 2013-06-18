<?php
/**
 * TimthumbHelper
 *
 * A simple helper for the Timthumb library by BinaryMoon (http://www.binarymoon.co.uk/projects/timthumb/)
 * 
 * Helps to automate the thumbnail generation process
 */

App::uses('AppHelper', 'View/Helper');
App::uses('Router', 'Routing');

class TimthumbHelper extends AppHelper {

/**
 * Other helpers used by TimthumbHelper
 * @var array
 */
    public $helpers = array('Html');

/**
 * Option translation to translate internal options to easy to use synonyms
 *
 * @var array
 */
    public $_translations = array(
        'src' => 'src',
        'width' => 'w',                     // the width to resize to
        'height' => 'h',                    // the height to resize to
        'quality' => 'q',                   // compression quality (0-100)
        'alignment' => 'a',                 // crop alignment (c, t, l, r, b, tl, tr, bl, br) help at: http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/
        'zoom_crop' => 'zc',                // change the cropping and scaling (0, 1, 2, 3) help at: http://www.binarymoon.co.uk/2011/03/timthumb-proportional-scaling-security-improvements/
        'filters' => 'f',                   // image filters to change the resized image (too many to mention) help at: http://www.binarymoon.co.uk/2010/08/timthumb-image-filters/
        'sharpen' => 's',                   // sharpen filter. Tutorial at: http://www.binarymoon.co.uk/2010/08/timthumb-image-filters/
        'canvas_color' => 'cc',             // background color (hexadecimal value, e.g. #FFFFFF)
        'canvas_transparency' => 'ct'       // canvas transparency (0 = false, 1 = true)
    );

/**
 * Default options to be used by TimthumbHelper
 *
 * @var array
 */
    public $_defaults = array(
        'quality' => 80,
        'width' => 100,
        'height' => 100,
        'alignment' => 'c',                 // c = center
        'zoom_crop' => 1,                   // 1 = Crop and resize to best fit the dimensions
        'canvas_transparency' => 1
    );

    public function image($path, $timthumbOptions = array(), $options = array()) {
        $action = '/timthumb';
        $basePath = Configure::read('TimthumbBasePath');

        $timthumbOptions = array_merge(
            array(
                'src' => $this->request->base . $basePath . $path
            ),
            $this->_defaults, 
            $timthumbOptions
        );

        $completePath = $action . '?' . $this->getOptionQueryString($timthumbOptions);

        return $this->Html->image($completePath, array_merge($options, array('escape' => false)));
    }

    private function getOptionQueryString($options) {
        $ret = "";
        foreach ( $options as $k => $v ) {
            if ( !empty( $ret ) ) {
                $ret .= '&';
            }
            $ret .= $this->_translations[$k] . '=' . urlencode($v);
        }
        return $ret;
    }
}