<?php
/*
Plugin Name: Centre Images
Plugin URI: http://wordpress.org/extend/plugins/centreimages/
Description: Centre Images adds a <code>centre-images</code> style to paragraph elements that are otherwise empty except for the image.
Version: 1.0
Author: Michael Camilleri
Author URI: http://inqk.net/
License: MIT Licence
*/

/*
Copyright 2010 Michael Camilleri

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

include_once("simple_html_dom.php");

function add_centreimages($content) {
	$html = str_get_html($content);

	// get the images
	foreach($html->find('img') as $image){

		$parent = $image->parent();

		while($parent && $parent->tag != 'p') {
			$parent = $parent->parent();
		}

		// check if parent only contains the img
		$is_empty = ($parent->plaintext == '') ? true : false;

		// if empty center image
		if($is_empty) {
			$parent->class = (trim($parent->class) != '') ? trim($parent->class) . " centre-images" : "centre-images";
		}
	}

	return $html;
}

add_filter('the_content', 'add_centreimages');

?>