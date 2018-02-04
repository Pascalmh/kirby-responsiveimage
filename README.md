# Kirby - responsiveimage tag

This is a plugin for [Kirby](http://getkirby.com/).
It adds the [srcset](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/img#attr-srcset) attribute to the `<img>`-tag.

## Installation

`composer require pascalmh/kirby-responsiveimage`

## Usage

Instead of using `(image: filename.jpg)` like you are used to use `(responsiveimage: filename.jpg)`.

This will output

```xml
<img src="http://yourdomain.com/thumbs/pagename/filename-320x212.jpg 320w" srcset="http://yourdomain.com/thumbs/pagename/filename-1200x795.jpg 1200w, http://yourdomain.com/thumbs/pagename/filename-1000x662.jpg 1000w, http://yourdomain.com/thumbs/pagename/filename-800x530.jpg 800w, http://yourdomain.com/thumbs/pagename/filename-600x397.jpg 600w, http://yourdomain.com/thumbs/pagename/filename-400x265.jpg 400w, http://yourdomain.com/thumbs/pagename/filename-320x212.jpg 320w">
```

The following attributes are available: `alt`, `width`, `height`, `class`, `link`, `popup`, `caption`.

## Options

You can use the following [Options](http://getkirby.com/docs/advanced/options)

### tag.responsiveimage.widths
Type: `array`
Default value: `[2400, 2200, 2000, 1800, 1400, 1200, 1000, 800, 600, 400, 320]`
