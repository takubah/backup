<?php namespace Antoniputra\Asmoyo\Medias;

use Input, Str, Config;
use Intervention\Image\ImageManagerStatic as InterventionImage;

class Image {

	public function uploadImage($input)
	{
		$file 		= Input::file('file');
		$mimeType	= $file->getMimeType();
		$extension 	= $file->getClientOriginalExtension();
		$size 		= $file->getSize();
		$fileName 	= (isset($input['currentFile']))
			? $input['currentFile']
			: md5(time() . str_random(20)) .'.'.$extension;

		// resizing original file by configuration size
		if( ! $this->generateImage($file->getRealPath(), $fileName) ) return false;

		// store file
		if ( $file->move($this->path('original'), $fileName) )
		{
			return array(
				'fileName'	=> $fileName,
				'mimeType'	=> $mimeType,
				'extension'	=> $extension,
				'size'		=> $size,
				'title'		=> $this->stripExtension($file->getClientOriginalName()),
			);
		}
		return false;
	}

	/**
	* Generate image sizes to small, medium, large
	* @return boolean
	*/
	public function generateImage($file, $fileName)
	{
		$web 			= app('asmoyo.web');
		$wmark 			= $web['media_watermark'];
		$med_const		= $web['media_constraint'];
		$wmarkFile		= public_path('uploads/images/original/'. $wmark['image']);

		// prepare large
		$l 	= $web['media_largeSize'];
		$lg = InterventionImage::make( $file )->resize($l['w'], null, function ($constraint) use($med_const)
		{
			if($med_const['aspectRatio']) $constraint->aspectRatio();
			if($med_const['upsize']) $constraint->upsize();
		});

		// prepare medium
		$m 	= $web['media_mediumSize'];
		$md = InterventionImage::make( $file )->resize($m['w'], null, function ($constraint) use($med_const)
		{
		    if($med_const['aspectRatio']) $constraint->aspectRatio();
			if($med_const['upsize']) $constraint->upsize();
		});

		// prepare small
		$s 	= $web['media_smallSize'];
		$sm = InterventionImage::make( $file )->resize($s['w'], null, function ($constraint) use($med_const)
		{
		    if($med_const['aspectRatio']) $constraint->aspectRatio();
			if($med_const['upsize']) $constraint->upsize();
		});

		// if need watermark?
		if(Input::get('withWatermark', false))
		{
			// if watermark image
			if(file_exists($wmarkFile))
			{
				$wmark_imageLg = $this->getWatermarkImage($wmarkFile, 'large');
				$lg->insert( $wmark_imageLg, $wmark['position']);

				$wmark_imageMd = $this->getWatermarkImage($wmarkFile, 'medium');
				$md->insert( $wmark_imageMd, $wmark['position']);

				$wmark_imageSm = $this->getWatermarkImage($wmarkFile, 'small');
				$sm->insert( $wmark_imageSm, $wmark['position']);
			}
		}

		$lg->save( $this->path('large/'.$fileName) );
		$md->save( $this->path('medium/'.$fileName) );
		$sm->save( $this->path('small/'.$fileName) );

		return true;
	}

	public function getWatermarkImage($file, $size = 'medium')
	{
		$web = app('asmoyo.web');
		$size = ($size == 'large')
			? $web['media_largeSize']
			: ($size == 'medium')
				? $web['media_mediumSize']
				: $web['media_smallSize'];

		return InterventionImage::make($file)->resize($size['w'] - 80, null, function ($constraint)
		{
		    $constraint->aspectRatio();
		    $constraint->upsize();
		});
	}

	public function getWatermarkText($file)
	{

	}

	public function stripExtension($filename)
	{
        return preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
    }

    public function path($path)
    {
    	return public_path('uploads/images/'.$path);
    }
}