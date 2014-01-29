<?php

namespace JunMy\Components\Watermark;

class Watermark
{
	/**
	 * Horizontal align constants
	 */
	const ALIGN_LEFT	= -1;
	const ALIGN_CENTER	=  0;
	const ALIGN_RIGHT	= +1;
	
	/**
	 * Vertical align constants
	 */
	const ALIGN_TOP		= -1;
	const ALIGN_MIDDLE	=  0;
	const ALIGN_BOTTOM	= +1;



	public static function output ($input, $output = null, $options = null)
	{
		// Set default options
		static $defOptions = array(
			'watermark' 	=> '',
			'halign'		=> self::ALIGN_CENTER,
			'valign'		=> self::ALIGN_MIDDLE,
			'hshift'		=> 0,
			'vshift'		=> 0,
			'type'			=> IMAGETYPE_JPEG,
			'jpeg-quality'	=> 90,
		);
		
		foreach ($defOptions as $k => $v) {
			if ( ! isset($options[$k]) ) {
				$options[$k] = $v;
			}
		}
		
		// Load source file and render image
		$renderImage = self::_render($input, $options);
		if ( ! $renderImage ) {
			user_error('Error rendering image', E_USER_NOTICE);
			return false;
		}

		// Before output to browsers send appropriate headers
		if ( empty($output) ) {
			$content_type = image_type_to_mime_type($options['type']);
			if ( ! headers_sent() ) {
				header('Content-Type: ' . $content_type);
			} else {
				user_error('Headers have already been sent. Could not display image.', E_USER_NOTICE);
				return false;
			}
		}

		// Define outputing function
		switch ($options['type'])
		{
			case IMAGETYPE_GIF:
				$result = empty($output) ? imagegif($renderImage) : imagegif($renderImage, $output);
				break;
				
			case IMAGETYPE_PNG:
				$result = empty($output) ? imagepng($renderImage) : imagepng($renderImage, $output);
				break;
				
			case IMAGETYPE_JPEG:
				$result = empty($output) ? imagejpeg($renderImage, '', $options['jpeg-quality']) : imagejpeg($renderImage, $output, $options['jpeg-quality']);
				break;
				
			default:
				user_error('Image type ' . $content_type . ' not supported by PHP', E_USER_NOTICE);
				return false;
		}

		// Output image (to browser or to file)
		if ( ! $result ) {
			user_error('Error output image', E_USER_NOTICE);
			return false;
		}

		// Free a memory from the target image
		imagedestroy($renderImage);

		return true;
	}
	


	private static function _render ($input, $options)
	{
		$sourceImage = self::_imageCreate($input);
		if ( ! is_resource($sourceImage) ) {
			user_error('Invalid image resource', E_USER_NOTICE);
			return false;
		}

		$watermark = self::_imageCreate($options['watermark']);
		if ( ! is_resource($watermark) ) {
			user_error('Invalid watermark resource', E_USER_NOTICE);
			return false;
		}
		
		$image_width = imagesx($sourceImage); 
		$image_height = imagesy($sourceImage);  
		$watermark_width =  imagesx($watermark); 
		$watermark_height =  imagesy($watermark); 
		$X = self::_coord($options['halign'], $image_width, $watermark_width) + $options['hshift'];
		$Y = self::_coord($options['valign'], $image_height, $watermark_height) + $options['vshift']; 

		imagecopy($sourceImage, $watermark, $X, $Y, 0, 0, $watermark_width, $watermark_height); 
		imagedestroy($watermark); 
		
		return $sourceImage;
	}
	


	private static function _imageCreate ($input)
	{
		if ( is_file($input) ) {
			return self::_imageCreateFromFile($input);
		} else if ( is_string($input) ) {
			return self::_imageCreateFromString($input);
		} else {
			return $input;
		}
	}
	


	private static function _imageCreateFromFile ($filename)
	{
		if ( ! is_file($filename) || ! is_readable($filename) ) {
			user_error('Unable to open file "' . $filename . '"', E_USER_NOTICE);
			return false;
		}

		// determine image format
		list( , , $type) = getimagesize($filename);

		switch ($type)
		{
			case IMAGETYPE_GIF:
				return imagecreatefromgif($filename);
				break;
				
			case IMAGETYPE_JPEG:
				return imagecreatefromjpeg($filename);
				break;
				
			case IMAGETYPE_PNG:
				return imagecreatefrompng($filename);
				break;
		}
		user_error('Unsupport image type', E_USER_NOTICE);
		return false;
	}


	private static function _imageCreateFromString ($string)
	{
		if ( ! is_string($string) || empty($string) ) {
			user_error('Invalid image value in string', E_USER_NOTICE);
			return false;
		}

		return imagecreatefromstring($string);
	}
	


	private static function _coord ($align, $image_dimension, $watermark_dimension)
	{
		if ( $align < self::ALIGN_CENTER ) {
			$result = 0;
		} elseif ( $align > self::ALIGN_CENTER ) {
			$result = $image_dimension - $watermark_dimension;
		} else {
			$result = ($image_dimension - $watermark_dimension) >> 1;
		}
		return $result;
	}
}