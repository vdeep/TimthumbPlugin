CakePHP TimthumbPlugin
==============

This is a simple plugin which uses the Timthumb library to resize the images when requested.

## Requirements

CakePHP Version - 2.2.x or 2.3.x

`app/tmp/timthumb` folder must be writable for cache storage (can be configured to use a different folder)

PHP GD library must also be installed on the server to use this plugin.

## Usage

To use this plugin, navigate to the `app/Plugin` directory in your git software, and use this command:

`git clone https://github.com/vishal-logiciel/TimthumbPlugin.git Timthumb`

This command will create a folder named `Timthumb` in the plugin directory and will clone all the plugin code into it.

You can also download the zip file and extract the code manually into the `Timthumb` folder in the `app/Plugin` directory.

After copying the code, you just need to enable the plugin by adding the following code at the end of the `bootstrap.php` file in `app/Config` folder:

```php
CakePlugin::load('Timthumb', array('routes' => true, 'bootstrap' => true));
```

This will load the plugin. Now, to use this in the views, you'll need to add the helper. Use this in the `AppController.php` file:

```php
public $helpers = array(
	// other helpers ...
	'Timthumb.Timthumb'
	// other helpers ...
);
```

This will make the `Timthumb` helper available in all the views. Now, in the view, you just need to use this to load an image:

```php
echo $this->Timthumb->image('/img/picture.png', array('width' => 200, 'height' => 100));
```

This will show the `picture.png` image residing in the `img` folder under `webroot` folder, after cropping/resizing it to 200 x 100 pixels.

The output will be saved in the `tmp/timthumb` directory as cache for future use.

To just get the url to the image file (to use with anchors or somewhere else), you can use the `Timthumb->imageUrl` method as follows:

```php
$this->Timthumb->imageUrl('/img/picture.png', array('width' => 200, 'height' => 100));
```

This will return the url to the timthumb image, which you can use inside an anchor to create a link to the image.

## Configuration

This `Timthumb` helper will create images using the `[base_url]/timthumb` URL. If you need to change this, you can do so in the `app/Plugin/Timthumb/Config/routes.php` file.

The default base path for images is `app/webroot`. It means that you'll have to pass the rest of the path in the helper. For example, if your image is `app/webroot/img/image.png', then you'll have to use:

```php
$this->Timthumb->image('/img/image.png');
```

To change the default base path, change the `TimthumbBasePath` configuration setting in `app/Plugin/Timthumb/Config/bootstrap.php` file. Please note that this must be the physical address of the folder, not the URL.

To change the cache directory, change the `TimthumbCacheDir` configuration setting in the `app/Plugin/Timthumb/Config/bootstrap.php` file. Please note that this must be the physical address of the folder, not the URL.

To use a placeholder image when the passed image is not found, you can uncomment the `TimthumbDefaultImg` configuration in the `app/Plugin/Timthumb/Config/bootstrap.php` file and set it to the path of your placeholder image.

## Available options for the helper

Following are the options that can be passed as an array in the Timthumb helper:

| Parameter | Default Value | Other possible values |
| --- | --- | --- |
| width | 100 | Any integer value (pixels) |
| height | 100 | Any integer value (pixels) |
| quality | 80 | Any value in range 0 - 100 |
| alignment | 'c' | (c, t, l, r, b, tl, tr, bl, br) [More details](http://www.binarymoon.co.uk/2010/08/timthumb-part-4-moving-crop-location/) |
| zoom_crop | 1 | (0, 1, 2, 3) [More details](http://www.binarymoon.co.uk/2011/03/timthumb-proportional-scaling-security-improvements/) |
| filters | none | Too many to mention [More details](http://www.binarymoon.co.uk/2010/08/timthumb-image-filters/) |
| sharpen | none | Tutorial [here](http://www.binarymoon.co.uk/2010/08/timthumb-image-filters/) |
| canvas_color | none | hexadecimal value (e.g. #FFFFFF) |
| canvas_transparency | 1 | 0 = false, 1 = true |