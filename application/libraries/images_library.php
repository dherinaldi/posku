<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images_library {

	

	function ambil_folder_upload()

	{

		$CI=& get_instance();

		$root_init=$_SERVER['DOCUMENT_ROOT'];

		$path_init=$CI->config->item('uploads_location');

		$name_folder=date("Y").'/'.date("m").'/';

		return $root_init.$path_init.$name_folder;

	}

	

	function upload_gambar($path,$allowtype,$maxSize,$field,$filename)

	{

		$CI=& get_instance();

		$config['upload_path'] = $path;

		

		$config['file_name']=$filename;

		$config['allowed_types'] = $allowtype;

		$config['max_size']	= $maxSize;



		$CI->load->library('upload', $config);

		if ( ! $CI->upload->do_upload($field))

		{

			return false;

		}

		else

		{

			return true;

		}

	}

	function upload_images($path,$field)
	{
		$CI=& get_instance();
		$CI->load->helper('inflector');
		$config['upload_path'] = $path;

		

		$config['file_name']=underscore($_FILES[$field]['name']);

		$config['allowed_types'] = 'jpg|jpeg|bmp|png';

		$config['max_size']	= '2048';



		$CI->load->library('upload', $config);

		if ( ! $CI->upload->do_upload($field))

		{

			return false;

		}

		else

		{

			return true;

		}
	}

	function create_thumbs($folder,$field,$width,$height)

	{

		$CI=& get_instance();

		$this->upload_images($folder,$field);

		$config['image_library'] = 'gd';
		$config['source_image'] =$CI->upload->upload_path.$CI->upload->file_name;
		$config['maintain_ratio'] = TRUE;
		$config2['create_thumb'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['new_image'] =$folder."/thumbs/";

		$CI->load->library('image_lib', $config);

		if(!$CI->image_lib->resize())

		{

			return false;

		}else{

			return true;

		}

	}

	

	function watermark_gambar($imgsrc,$text,$font,$fontsize,$fontcolor,$shadowcolor,$vertalign,$horalign)

	{

		$CI=& get_instance();

		$CI->load->library('image_lib');

		$config['source_image'] = $imgsrc;

		$config['wm_text'] = $text;

		$config['wm_type'] = 'text';

		$config['wm_font_path'] = $font;

		$config['wm_font_size'] = $fontsize;

		$config['wm_font_color'] = $fontcolor;

		$config['wm_vrt_alignment'] = $vertalign;

		$config['wm_hor_alignment'] = $horalign;

		$config['wm_shadow_color']=$shadowcolor;

		$config['wm_padding'] = '20';

		

		$CI->image_lib->initialize($config);

		

		if(!$CI->image_lib->watermark())

		{

			return false;

		}else{

			return true;

		}

	}

	

	

}