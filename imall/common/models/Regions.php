<?php

namespace JunMy\Models;

//use JunMy\Components\Palette\Palette;

class Regions extends \Phalcon\Mvc\Model
{
//albums
	public $id;

	public $name;
    
    public $neighbourhood;
    
	public function getSource()
	{
		return 'regions';
	}

	//public function loadPalette()
	//{

		//$paletteCss = '../public/css/albums/'.$this->id.'.css';
		//if(file_exists($paletteCss)){
		//	return $paletteCss;
		//}

		//$albumPalette = $this->getAlbumPalette();
		//if (count($albumPalette)) {
		//	$palette = array();
		//	foreach ($albumPalette as $paletteItem) {
		//		$palette[$paletteItem->type] = $paletteItem->color;
		//	}
		//	Palette::write($paletteCss, $palette);
		//	return $paletteCss;
		//}
    	/**
		$albumPhoto = $this->getPhoto('medium');
		if ($albumPhoto) {

		
			 * Get the palette colors based on the albums url
			 
			$palette = Palette::calculate($albumPhoto);
			foreach($palette as $type => $color) {
				$albumPalette = new AlbumsPalette();
				$albumPalette->albums_id = $this->id;
				$albumPalette->type = $type;
				$albumPalette->color = $color;
				if ($albumPalette->save() == false) {
					$messages = $albumPalette->getMessages();
					throw new \Exception((string) $messages[0]);
				}
			}

			Palette::write($paletteCss, $palette);
			return $paletteCss;
		}

		file_put_contents($paletteCss, '');
       
	}
    */
    /*
	public function getPalette()
	{
		return $this->getRelated('JunMy\Models\AlbumsPalette');
	} */
	
 /*
	public function getCategories()
	{
		return $this->getRelated('JunMy\Models\Categories');
	}
    
   
	public function getPhoto($type)
	{
		$albumPhotos = $this->getPhotos('type = "'.$type.'"');
		if (count($albumPhotos)) {
			return $albumPhotos[0]->url;
		}
		return null;
	} 

	public function getTracks($parameters=null)
	{
		return $this->getRelated('JunMy\Models\AlbumsTracks', $parameters);
	}

	public function getPhotos($parameters=null)
	{
		return $this->getRelated('JunMy\Models\AlbumsPhotos', $parameters);
	}*/

	public function initialize()
	{
		$this->belongsTo('post_id', 'JunMy\Models\Posts', 'id');
		$this->hasMany('id', 'JunMy\Models\Posts', 'region_id');
		//$this->hasMany('id', 'JunMy\Models\AlbumsPhotos', 'region_id');
		//$this->hasMany('id', 'JunMy\Models\AlbumsPalette', 'region_id');
		//$this->hasMany('id', 'JunMy\Models\AlbumsTracks', 'region_id');
	}

}
