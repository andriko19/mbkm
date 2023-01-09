<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
  
  // Prakata
  public function getPrakata()
	{
		return  $this->db->order_by('id_prakata', 'DESC')->get('prakata')->result_array();
	}

  public function tambah_prakata($data)
	{
		$this->db->insert('prakata', $data);
	}

  public function getDataByIdPrakata($id_prakata)
	{
		$this->db->where('id_prakata', $id_prakata);
		return $this->db->get('prakata');
	}

	public function hapusPrakata($id_prakata)
	{
		$this->db->where('id_prakata', $id_prakata);
		return $this->db->delete('prakata');
	}

  // Team
  public function getTeam()
	{
		return  $this->db->order_by('id_team', 'DESC')->get('team')->result_array();
	}

  public function tambah_team($data)
	{
		$this->db->insert('team', $data);
	}

  public function getDataByIdTeam($id_team)
	{
		$this->db->where('id_team', $id_team);
		return $this->db->get('team');
	}

	public function hapusTeam($id_team)
	{
		$this->db->where('id_team', $id_team);
		return $this->db->delete('team');
	}

  // Berita
  public function tambah_berita($data)
	{
		$this->db->insert('berita', $data);
	}


}