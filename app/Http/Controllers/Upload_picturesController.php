<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\Upload\UploadRepositoryInterface as Upload_pic;
use Illuminate\Http\Request;
use League\Flysystem\Filesystem;
use  App\Upload as Upload;
use Session;

class Upload_picturesController extends Controller {

	protected $Upload_pic;

	/**
	 * Items to show per page when returning Index
	 * @var integer
	 */
	protected $per_page = 12;

	public function __construct(Upload_pic $Upload_pic)
	{
		$this->Upload_pic = $Upload_pic;
	}

	/**
	 * Show upload view.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('new_upload');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$images = $request->file('images');	

		foreach ($images as $image) 
		{
			$rules = array(
     			'image' => 'required|mimes:png,gif,jpeg,jpg|max:20000'
 		 	);

 		 	$validator = \Validator::make(array('image'=> $image), $rules);

 			if (! $validator->passes())
     		{
      			return redirect()->back()->withErrors($validator);
      		}
      	}

      	if( $this->Upload_pic->upload($images))
      	{
      		\Session::flash('success_message', 'Well done, images uploaded successfully.');
			return view('confirmation');
      	}

      	return false;
    }

    public function gallery($id = NULL)
	{
		if( $id != NULL ) 
		{

			$picture = $this->Upload_pic->show($id);

			return view('gallery-item' , compact('picture'));		
		}
		else
		{
			$pictures = $this->Upload_pic->get_paginate($this->per_page);
			$count = $pictures->count();
			return view('gallery', compact('pictures', 'count'));
		}
		
	}

	public function scrolling()
	{
		$shownData = \Input::get('displayedData');

		$dbData = $this->Upload_pic->uploadcount();

		//check to see if all the elements are already displayed
		if((int)$shownData === (int)sizeof($dbData)){

			//if this is true, return empty array
			return \Response::json(array());
		}

		$pictures = $this->Upload_pic->new_upload()->skip($shownData)->take($this->per_page)->get();

		return \Response::json($pictures);

	}

	
}
