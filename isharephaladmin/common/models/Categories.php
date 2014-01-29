<?php

namespace JunMy\Models;

class Categories extends \Phalcon\Mvc\Model
{
 
    public $id;
    
    public $name;

	public function getSource()
	{
		return 'categories';
	}
    /*
	public function getPhoto($type)
	{
		$albumPhotos = $this->getPhotos('type = "'.$type.'"');
		if (count($albumPhotos)) {
			return $albumPhotos[0]->url;
		}
		return null;
	}

	public function getPhotos($parameters=null)
	{
		return $this->getRelated('JunMy\Models\ArtistsPhotos', $parameters);
	}

	public function getAlbums($parameters=null)
	{
		return $this->getRelated('JunMy\Models\Albums', $parameters);
	}
    */
    
	public function initialize()
	{
		$this->hasMany('id', 'JunMy\Models\Posts', 'post_id');
		//$this->hasMany('id', 'JunMy\Models\Albums', 'artists_id');
	}

}