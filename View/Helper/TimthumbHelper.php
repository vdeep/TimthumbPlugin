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
    private $_translations = array(
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
    private $_defaults = array(
        'quality' => 80,
        'alignment' => 'c',                 // c = center
        'zoom_crop' => 1,                   // 1 = Crop and resize to best fit the dimensions
        'canvas_transparency' => 1
    );

/**
 * a wrapper to expose private function getTimthumbImageUrl
 *
 * @param $path - string - path to the image file
 * @param $timthumbOptions - array - options for modifying the image
 * @return string - url for the image with added query string parameters
 */
    public function imageUrl($path, $timthumbOptions = array()) {
        return $this->getTimthumbImageUrl($path, $timthumbOptions);
    }

/**
 * returns the image with all the modifications
 *
 * @param $path - string - path to the image file
 * @param $timthumbOptions - array - timthumb options
 * @param $options - array - Html image helper options (for adding parameters to images)
 * @return string - image tag with timthumb image src
 */
    public function image($path, $timthumbOptions = array(), $options = array()) {
        $completePath = $this->getTimthumbImageUrl($path, $timthumbOptions);
        return $this->Html->image($completePath, array_merge($options, array('escape' => false)));
    }

/**
 * returns the url to the image
 *
 * @param $path - string - path to the image file
 * @param $timthumbOptions - array - options for modifying the image
 * @return string - url for the image with added query string parameters
 */

    private function getTimthumbImageUrl($path, $timthumbOptions = array()) {
        $action = '/timthumb';
        $basePath = Configure::read('TimthumbBasePath');

        $timthumbOptions = array_merge(
            array(
                'src' => $this->request->base . $basePath . $path
            ),
            $this->_defaults, 
            $timthumbOptions
        );

        return $action . '?' . $this->getOptionQueryString($timthumbOptions);
    }

/**
 * generates the query string according to the passed 
 * parameters after translating them to library options
 *
 * @param $options - array - options to convert to query string params
 * @return string - generated query string
 */
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