<?php
/*
*	CLASS:			UPLOAD
*	VERSION:		1.0
*	DESCRIPTIONS:	This class upload and resize images.
*	class can upload and resize multiple images in array form or can upload and resize single image.
*	AUTHOR:			OBAIDULLAH KHAN
*	EMAIL:			UBAID23@GMAIL.COM
*	WEB:			HTTP://WWW.MYHUJRA.COM
*	COUNTRY:		PAKISTAN
*	LICENCE:		GNU/GPL
*	
*/
class Upload
{
	public $FileName;
	public $NewName;
	public $RNewName;
	public $File;
	public $NewWidth	= 600;
	public $NewHeight	= 600;	
	public $TWidth		= 100;
	public $THeight		= 100;
	public $SavePath;
	public $ThumbPath;
	public $OverWrite;
	public $NameCase;
	public $Error;
	public $ImageNewExt;
	public $ThumbNewExt;
		
	private $Image;
	private $width;
	private $height;
	
	
	function Upload()
	{
		$this -> FileName	=	'lssll.jpg';
		$this -> OverWrite	=	true;
		$this -> NameCase	=	'';
		$this -> Error		=	'';
		$this -> NewName 	=	'';
		$this -> ImageNewExt=	'';
		$this -> ThumbNewExt=	'';
		$this -> RNewName	= 	'';
	}
	
	function UploadFile()
	{
		if(is_array($this->File['name']))
		{
			$this -> _ArrayUpload();					
		}	
		else
		{
			$this -> _NormalUpload();					
		}
		
		return $this -> Error;		
	}
	
	function _ArrayUpload()
	{
		for($i = 0; $i < count($this -> File['name']); $i++)
		{
			$_FileName	=	$this->File['name'][$i];
			
			//if new name is set then apply this.
			
				$_NewName	=	$this -> NewName[$i];
			
			
			
			if(!empty($this->File['name'][$i]) and $this -> _FileExist($_NewName, $_FileName,$i) == false)
			{
				$ErrorMsg= '';
				//Upload and resize image
				 $ErrorMsg = $this -> _UploadImage($this -> File['name'][$i], $this -> File['tmp_name'][$i], $this -> File['size'][$i],
				 $this -> File['type'][$i],$this -> NewName[$i]);		

				//==== Creaet Thumb
				if(!empty($this -> ThumbPath) && empty($ErrorMsg))
				{
					$this -> _ThumbUpload($this -> File['name'][$i], $this -> File['tmp_name'][$i], $this -> File['size'][$i], 
					$this -> File['type'][$i], $this -> NewName[$i]);
				}// if save thumb

			}//if !empty file name
		}//for loop
	}
	
	function _NormalUpload()
	{
		$_FileName	=	$this->File['name'];			
			//if new name is set then apply this.			
		$_NewName	=	$this -> NewName;
		
		if(!empty($this->File['name']) and $this -> _FileExist($_NewName, $_FileName) == false)
		{
			//upload and resize image
			$this -> _UploadImage($this -> File['name'], $this -> File['tmp_name'], $this -> File['size'], 
			$this -> File['type'], $this -> NewName);
			
			//upload thumb
			if(!empty($this -> ThumbPath))
			{
				$this -> _ThumbUpload($this -> File['name'], $this -> File['tmp_name'], $this -> File['size'], 
				$this -> File['type'], $this -> NewName);
			}// if save thumb
		}// if check file empty and file exist
	} // function _Normal Upload
	
	function _UploadImage($FileName, $TmpName, $Size, $Type, $NewName)
	{
		list($width, $height) = getimagesize($TmpName);
		$this -> image = new Image($FileName);		

		$this -> image -> newWidth = $this -> NewWidth; // new width 
		$this -> image -> newHeight = $this -> NewHeight; //new height

		$this -> image -> PicDir = $this -> SavePath;
		$this -> image -> TmpName 	 = $TmpName;
		$this -> image -> FileSize   = $Size;
		$this -> image -> FileType   = $Type;
	
		//if user want to change the file name chackname function will do that.
		$this -> image -> FileName = $this-> _CheckName($NewName , $FileName, $this -> ImageNewExt);
		
		if($width < $this -> NewWidth and $height < $this -> NewHeight)
		{
			return $this -> image -> Save(); //use this if you wish images without resizing
		}
		else
		{		
			return $this -> image -> Resize();
		}
		
		
	}
	
	function _ThumbUpload($FileName, $TmpName, $Size, $Type, $NewName)
	{
		list($width, $height) = getimagesize($TmpName);

		$this ->  Timage = new Image($FileName);		

		$this -> Timage -> newWidth = $this -> TWidth; // new width 
		$this -> Timage -> newHeight = $this -> THeight; //new height
				
		$this -> Timage -> PicDir = $this -> ThumbPath;
		$this -> Timage -> TmpName 	 = $TmpName;
		$this -> Timage -> FileSize   = $Size;
		$this -> Timage -> FileType   = $Type;
		
		//if user want to change the file name chackname function will do that.
		$this -> Timage -> FileName = $this-> _CheckName($NewName , $FileName, $this -> ThumbNewExt);
				
		if($width < $this -> TWidth and $height < $this -> THeight)
		{
			$this -> Timage -> Save(); //use this if you wish images without resizing
		}
		else
		{		
			$this -> Timage -> Resize();
		}
	}
	
	function _CheckName($NewName,$UpFile, $NewExt = '')
	{
		if(empty($NewName))
		{
			return $this->_ChangeCase($UpFile);
		}
		else
		{
			$Ext = explode(".",$UpFile);
			$Ext = end($Ext);
			$Ext = strtolower($Ext);
			
			return $this->_ChangeCase($this -> _CheckExtantion($NewName,$Ext,$NewExt));
		}
	}
	
	function _CheckExtantion($NewName, $Ext, $NewExt)
	{
		$Ext2 = explode(".",$NewName);
		if(is_array($Ext2))
		{
			$NewName = $Ext2[0];			
		}
		
/*		if(!empty($NewExt) && $NewExt != $Ext)
		{
			return $NewName.'.'.$NewExt;
		}
		else
		{
			return $NewName.'.'.$Ext;
		}
		*/

		return $NewName.'.'.$Ext;
		
	}
	
	function _ChangeCase($FileName)
	{
		if($this->NameCase == 'lower')
		{
			$this -> RNewName = $FileName;
			return strtolower($FileName);
		}
		elseif($this->NameCase == 'upper')
		{
			$this -> RNewName = $FileName;
			return strtoupper($FileName);
		}
		else
		{
			$this -> RNewName = $FileName;
			return $FileName;
		}
	}
	
	function _FileExist($_NewName, $_FileName,$i = 0)
	{
		if($this -> OverWrite == true)
		{

			if(file_exists($this->SavePath.$this -> _CheckName($_NewName, $_FileName)))
			{
				if(!unlink($this->SavePath.$this->_CheckName($_NewName, $_FileName)))
				{
					$this -> Error[] = "File: ". $this->_CheckName($_NewName, $_FileName) . " Cannot be overwrite.";
				}
				else
				{
					if(file_exists($this->ThumbPath.$this -> _CheckName($_NewName, $_FileName)))
					{

						//also remove thumb
						unlink($this->ThumbPath.$this->_CheckName($_NewName, $_FileName));
					}
				}
			}
		}
		else
		{		

			if(file_exists($this->SavePath. $this -> _CheckName($_NewName, $_FileName)))
			{
				$this -> Error[] = "File: ". $this -> _CheckName($_NewName, $_FileName) . " aready exist!  ";
				return true;
			}
		}
	}//function _FileExist
}
?>