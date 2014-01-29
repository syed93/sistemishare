<?php


namespace JunMy\Components\Imageupload;

class Thumbnail {
 
	private $img;

	public function __construct($imgfile) {
		//detect image format | deprecated way //$this->img["format"]=ereg_replace(".*\.(.*)$","\\1",$imgfile);
		$this->img["format"] = end(explode(".", $imgfile));
		
		$this->img["format"] = strtoupper($this->img["format"]);
		
		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			$this->img["format"]="JPEG";
			$this->img["src"] = ImageCreateFromJPEG ($imgfile);
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			$this->img["format"]="PNG";
			$this->img["src"] = ImageCreateFromPNG ($imgfile);
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			$this->img["format"]="GIF";
			$this->img["src"] = ImageCreateFromGIF ($imgfile);
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			$this->img["format"]="WBMP";
			$this->img["src"] = ImageCreateFromWBMP ($imgfile);
		} else {
			//DEFAULT
			echo "Not Supported File";
			exit();
		}
		@$this->img["lebar"] = imagesx($this->img["src"]);
		@$this->img["tinggi"] = imagesy($this->img["src"]);
		//default quality jpeg
		$this->img["quality"]=85;
	}

	public function size_height($size=100) {
		//height
    	$this->img["tinggi_thumb"]=$size;
    	@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
	}

	public function size_width($size=100) {
		//width
		$this->img["lebar_thumb"]=$size;
    	@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
	}

	public function size_auto($size=100) {
		//size
		if ($this->img["lebar"]>=$this->img["tinggi"]) {
    		$this->img["lebar_thumb"]=$size;
    		@$this->img["tinggi_thumb"] = ($this->img["lebar_thumb"]/$this->img["lebar"])*$this->img["tinggi"];
		} else {
	    	$this->img["tinggi_thumb"]=$size;
    		@$this->img["lebar_thumb"] = ($this->img["tinggi_thumb"]/$this->img["tinggi"])*$this->img["lebar"];
 		}
	}

	public function jpeg_quality($quality=85) {
		//jpeg quality
		$this->img["quality"]=$quality;
	}

	public function show() {
		//show thumb
		@Header("Content-Type: image/".$this->img["format"]);

		/* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function*/
		$this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);
    		@imagecopyresized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);

		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			imageJPEG($this->img["des"],"",$this->img["quality"]);
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			imagePNG($this->img["des"]);
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			imageGIF($this->img["des"]);
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			imageWBMP($this->img["des"]);
		}
	}

	public function save($save="") {
		//save thumb
		if (empty($save)) $save=strtolower("./thumb.".$this->img["format"]);
		/* change ImageCreateTrueColor to ImageCreate if your GD not supported ImageCreateTrueColor function*/
		$this->img["des"] = ImageCreateTrueColor($this->img["lebar_thumb"],$this->img["tinggi_thumb"]);
    		@imagecopyresized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["lebar_thumb"], $this->img["tinggi_thumb"], $this->img["lebar"], $this->img["tinggi"]);

		if ($this->img["format"]=="JPG" || $this->img["format"]=="JPEG") {
			//JPEG
			imageJPEG($this->img["des"],"$save",$this->img["quality"]);
		} elseif ($this->img["format"]=="PNG") {
			//PNG
			imagePNG($this->img["des"],"$save");
		} elseif ($this->img["format"]=="GIF") {
			//GIF
			imageGIF($this->img["des"],"$save");
		} elseif ($this->img["format"]=="WBMP") {
			//WBMP
			imageWBMP($this->img["des"],"$save");
		}
	}
}



class Imageupload {
	
	private $path;
	
	public $rename;
	
	/*
	*  Path name must be end with slash ie: DIR/
	*/ 
	public function setpath($path) {
		$this->path = $path;
	}
	
	/*
	*  Get image name after rename
	*/
	
	
	/*
	*  Upload to path 
	*  Return BOOLEAN
	*/ 
	public function upload($tmp_name, $new_name) {
		list($name, $extension) = explode(".", $_FILES[$tmp_name]['name']);
		// IE: 98YUIY78TY87UY8T8U.jpg
		$this->rename = $new_name.".".$extension;
		
		if(move_uploaded_file($_FILES[$tmp_name]['tmp_name'], $this->path.$this->rename)) {
			$thumb=new Thumbnail("./".$this->path.$this->rename);		
            $thumb->size_width(675);				
            $thumb->size_height(675);				
            $thumb->size_auto(675);				
            $thumb->jpeg_quality(95);				
            //$thumb->show();						
            $thumb->save("./".$this->path.$this->rename);
			unset($thumb);
			return true;
		}
	}
    
    /*
	*  Check File is image, not shell 99 file or dangerous file
	*  Return BOOLEAN
	*/ 
	public function valid_image($file_name, $min_width, $min_height) {
	    $imagetype = getimagesize($_FILES[$file_name]['tmp_name']);
	    
		if($imagetype[0] < $min_width) {
			return false;
		} elseif($imagetype[1] < $min_height) {
			return false;
		} else {
			return true;
		}
	} 
	
	/*
	*  Check maximum file size in KB, 1024 = 1MB
	*  Return BOOLEAN
	*/ 
	public function valid_size($file_name, $max_file_size) {
	    if($_FILES[$file_name]['size'] < ($max_file_size * $max_file_size)) {
			return true;
		}
	    
	} 	
	
	
}