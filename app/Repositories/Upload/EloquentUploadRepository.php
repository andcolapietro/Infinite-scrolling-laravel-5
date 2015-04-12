<?php namespace App\Repositories\Upload;

use App\Upload as Upload;

use Illuminate\Contracts\Filesystem\Filesystem as File;
use Intervention\Image\ImageServiceProvider as Image;


class EloquentUploadRepository implements UploadRepositoryInterface {

	public function new_upload()
    {
        return $new_upload = new Upload();
    }
    
	public function get_paginate($per_page)
	{
		return Upload::paginate($per_page);
	}

	public function uploadcount()
	{
		$rows =  Upload::all();
		return $rows->count();

		//return $rows->count();
	}

	public function show($id)
	{
		return Upload::find($id);
	}

	public function upload($data)
	{
		$Upload = new Upload();
        $path = public_path() . '/uploads';
        $thumb_path = public_path() . '/uploads/thumbs';

        // Make path if does not exist
        if(! \File::exists($path))
        {
            \File::makeDirectory($path);
            \File::makeDirectory($thumb_path);
        }

		foreach ($data as $image) {

            $extension = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            
            //Upload the file with the original dimension
            $origin = $image->move($path, $filename);

            //Creates and uploads the thumbnail
            \Image::configure(array('driver' => 'gd'));
            $thumb = \Image::make($path . '/' . $filename)->resize(200, 200)->save($thumb_path . '/' . $filename );
            
            //Insert record in db 
            $Upload->create([
                'picture_name'	=> $filename,
                'created_at'		=> date('Y-m-d H:i:s')	
            ]);
        }

        return true;
        

        //return false;
	}

}