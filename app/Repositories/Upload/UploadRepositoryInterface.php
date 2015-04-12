<?php namespace App\Repositories\Upload;
 
interface UploadRepositoryInterface {

	public function new_upload();
	public function get_paginate($per_page);
	public function show($id);
	public function upload($data);
	public function uploadcount();
}