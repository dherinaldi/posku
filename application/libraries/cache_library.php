<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cache_library {
	
	function __construct()
	{
		$CI=& get_instance();
		$CI->load->driver('cache', array('adapter' => $CI->config->item('cache_driver'), 'backup' => $CI->config->item('cache_folder')));	
	}
	
	function is_support()
	{		
		if ($this->cache->apc->is_supported())
		{
			return true;
		}else{
			return false;
		}
	}
	
	function simpan_cache($id,$data,$timeLive="")
	{
		$this->output->cache($timeLive);
		if($this->is_support())
		{
			if(empty($timeLive))
			{
				$this->cache->save($id, $data);
			}else{
				$this->cache->save($id, $data,$timeLive);
			}
		}
	}
	
	function ambil_cache($id)
	{
		if($this->is_support())
		{
			$is_data = $this->cache->get($id);
			if(empty($is_data))
			{
				return null;
			}else{
				return $is_data;
			}
		}
	}
	
	function hapus_cache($id)
	{
		if($this->is_support())
		{
			$is_data = $this->cache->get($id);
			if(empty($is_data))
			{
				return false;
			}else{
				$this->cache->delete($id);
				return true;
			}
		}
	}
	
	function bersih_cache()
	{
		if($this->is_support())
		{
			$this->cache->clean();
			return true;
		}
	}
	
	//COOKIES
	
	function simpan_cookie($data)
	{		
		$this->load->helper('cookie');
		$ok=$this->input->set_cookie($data); 
		if($ok)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function ambil_cookie($name)
	{
		$this->load->helper('cookie');
		if($this->input->cookie($name, TRUE))
		{
			return 	$this->input->cookie($nama);			
		}else{
			return false;
		}
	}
	
	function hapus_cookie($name)
	{
		$this->load->helper('cookie');
		if($this->input->cookie($name, TRUE))
		{
			$this->input->delete_cookie($nama);
			return true;
		}else{
			return false;
		}
	}
	
	function simpan_session($data)
	{
		$CI=& get_instance();
		$CI->load->library('session');
		$ok=$CI->session->set_userdata($data);
		if($ok)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function ambil_session($id)
	{
		$CI=& get_instance();
		$CI->load->library('session');
		$is_data=$CI->session->userdata($id);;
		if(!empty($is_data))
		{
			return $is_data;
		}else{
			return false;
		}
	}
	
	function hapus_session($id)
	{
		$this->load->library('session');
		$session_id = $this->session->userdata($id);
		if(!empty($session_id))
		{
			$this->session->unset_userdata($id);
		}
	}
	
	function hapus_semua_session($id)
	{
		$this->load->library('session');
		$session_id = $this->session->sess_destroy();
		if($session_id)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function simpan_session_cepat($id,$value)
	{
		$this->load->library('session');
		$ok=$this->session->set_flashdata($id,$value);
		if($ok)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function ambil_session_cepat($id)
	{
		$this->load->library('session');
		$is_data=$this->session->flashdata('item');
		if(!empty($is_data))
		{
			return $is_data;
		}else{
			return false;
		}
	}
	
}