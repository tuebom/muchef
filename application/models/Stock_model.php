<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock_model extends CI_Model
{

    public $table = 'stock';
    public $id = 'kdbar';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('kdbar, kdurl, nama, deskripsi, kdgol2, format(hjual,0,"id") as hjual, pnj, lbr, tgi, berat, gambar');
        $this->db->where('kdbar', $id);
        return $this->db->get($this->table)->row();
    }

    // get data by kodeurl
    function get_by_kodeurl($id)
    {
        $this->db->select('kdbar, kdurl, nama, deskripsi, fitur, kdgol2, kdgol3, format(hjual,0,"id") as hjual,'.
        'hpromo, format(hpromo,0,"id") as hpromof, kriteria, merk, size, parent, pnj, lbr, tgi, berat, master, listrik, kapasitas, gas, gambar, gambar2, gambar3');
        $this->db->where('kdurl', $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total master
    function total_master($code) {
        $this->db->like('kdgol2', $code);
        if (strlen($code) == 8)
            $this->db->or_like('kdgol3', $code);
        $this->db->where('master', 'Y');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get sample product
    function get_sample($kode)
    {
        $this->db->select('kdbar, kdurl, nama, deskripsi, fitur, kdgol2, kdgol3, format(hjual,0,"id") as hjual,'.
        'hpromo, format(hpromo,0,"id") as hpromof, kriteria, merk, size, parent, pnj, lbr, tgi, master, listrik, kapasitas, gas, gambar, gambar2, gambar3');
        
        $this->db->where('parent', $kode);
        $this->db->order_by('kdbar', 'ASC');
        $this->db->limit(1, 0);
        return $this->db->get($this->table)->row();
    }

    // get varian data
    function get_varian($kode)
    {
        $this->db->distinct();
        $this->db->select('kdurl, size');
        $this->db->where('parent', $kode);
        $this->db->order_by('kdurl', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // get data by category
    function get_by_category($limit, $start = 0, $code)
    {
        $this->db->select('kdbar, kdurl, nama, deskripsi, format(hjual,0,"de") as hjual, format(hpromo,0,"de") as hpromof, kriteria, pnj, lbr, tgi, master, gambar');
        $this->db->like('kdgol', $code);
        $this->db->or_like('kdgol2', $code);
        
        if (strlen($code) == 8)
            $this->db->or_like('kdgol3', $code);
        
        $where = "(master = 'Y' or parent is null)";
        $this->db->where($where);
			
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get price range
    function get_price_range($code)
    {
        $this->db->select('MIN(hjual) as hmin, MAX(hjual) as hmax');
        $this->db->like('kdgol', $code);
        $this->db->or_like('kdgol2', $code);
        
        if (strlen($code) == 8)
            $this->db->or_like('kdgol3', $code);
        
        $where = "(master = 'Y' or parent is null)";
        $this->db->where($where);
        return $this->db->get($this->table)->row();
    }

    function get_price_range2($q = NULL, $b = NULL, $tag = NULL)
    {
        $this->db->select('MIN(hjual) as hmin, MAX(hjual) as hmax');
        
        if ($q) {
            $this->db->group_start();
            $this->db->or_like(['kdbar'=> $q, 'nama'=> $q, 'kdgol'=> $q, 'kdgol2'=> $q, 'pnj'=> $q, 'lbr'=> $q, 'tgi'=> $q]);
            if (strlen($q) == 8)
                $this->db->or_like('kdgol3', $q);
            $this->db->group_end();
        }
        
        if ($tag) {
            $this->db->where('tag', $tag);
        }

        // with brand condition
        if ($b) {
            $this->db->where('merk', $b);
        }
        
        $this->db->where('master', 'N');
        return $this->db->get($this->table)->row();
    }

    // get data by food category
    function get_by_food_category($limit = 8, $start = 0, $tag)
    {
        $this->db->select('kdbar, kdurl, nama, deskripsi, format(hjual,0,"de") as hjual, format(hpromo,0,"de") as hpromof, kriteria, pnj, lbr, tgi, gambar');
        // $this->db->where('kdgol2', $code);
        $this->db->like('tag', $tag);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data by brand
    function get_by_brand($limit = 8, $start = 0, $brand)
    {
        $this->db->where($this->merk, $brand);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->row();
    }

    // get related product
    function get_related($kode, $kdbar)
    {
        $this->db->select('kdbar, kdurl, nama, deskripsi, format(hjual,0,"id") as hjual, pnj, lbr, tgi, gambar');
        $this->db->from('stock');
        
        if (strlen($kode) == 5)
		{
			$this->db->where('kdgol2', $kode);
		}
		else
		{
			$this->db->where('kdgol3', $kode);
		}
        
        $this->db->where('kdbar !=', $kdbar);
        $this->db->where('master', 'N');
        $this->db->order_by('kdbar', 'ASC');
        
        return $this->db->get()->result();
    }

    // get new products
    function get_new_products($limit = 8, $start = 0)
    {
        $context = $this->session->userdata('context');

        $this->db->select('kdbar, kdurl, nama, deskripsi, format(hjual,0,"id") as hjual, format(hpromo,0,"de") as hpromof, kriteria, pnj, lbr, tgi, gambar');
        $this->db->from('stock');
        $this->db->where('kriteria', 'N');
        if ($context == 1)
        {
            $this->db->where('kdgol <', '21');
        }
        else
        {
            $this->db->where('kdgol >', '20');
        }
        $this->db->order_by('kdbar', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    // get total new products
    function total_new_products() {
        $context = $this->session->userdata('context');

        $this->db->where('kriteria', 'N');
        if ($context == 1)
        {
            $this->db->where('kdgol <', '21');
        }
        else
        {
            $this->db->where('kdgol >', '20');
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get promotion product
    function get_promotion($limit = 8, $start = 0)
    {
        $context = $this->session->userdata('context');

        $this->db->select('kdbar, kdurl, nama, deskripsi, format(hjual,0,"id") as hjual, format(hpromo,0,"id") as hpromo, format(hpromo,0,"de") as hpromof, kriteria, ROUND(100-hpromo*100/hjual,1) as diskon, pnj, lbr, tgi, gambar');
        $this->db->from('stock');
        $this->db->where('kriteria', 'P');
        if ($context == 1)
        {
            $this->db->where('kdgol <', '21');
        }
        else
        {
            $this->db->where('kdgol >', '20');
        }
        $this->db->order_by('kdbar', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    // get total promotions
    function total_promotions() {
        $context = $this->session->userdata('context');

        $this->db->where('kriteria', 'P');
        if ($context == 1)
        {
            $this->db->where('kdgol <', '21');
        }
        else
        {
            $this->db->where('kdgol >', '20');
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get best seller product
    function get_best_seller($limit = 8, $start = 0)
    {
        $context = $this->session->userdata('context');

        $this->db->select('kdbar, kdurl, nama, deskripsi, format(hjual,0,"id") as hjual, format(hpromo,0,"de") as hpromof, kriteria, pnj, lbr, tgi, gambar');
        $this->db->from('stock');
        $this->db->where('kriteria', 'B');
        if ($context == 1)
        {
            $this->db->where('kdgol <', '21');
        }
        else
        {
            $this->db->where('kdgol >', '20');
        }
        $this->db->order_by('kdbar', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    // get total best seller
    function total_best_seller() {
        $context = $this->session->userdata('context');

        $this->db->where('kriteria', 'B');
        if ($context == 1)
        {
            $this->db->where('kdgol <', '21');
        }
        else
        {
            $this->db->where('kdgol >', '20');
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get random product
    function get_random_products($kode, $kdbar)
    {
        $this->db->select('kdbar, kdurl, nama, deskripsi, format(hjual,0,"id") as hjual, format(hpromo,0,"de") as hpromof, kriteria, pnj, lbr, tgi, gambar')
            ->from('stock')
            ->where('kdgol2', $kode)
            ->where('kdbar !=', $kdbar)
            ->order_by('kdbar', 'ASC');
        return $this->db->get()->result();
    }
    
    // get total rows
    function total_rows($q = NULL, $b = NULL, $p1 = 0, $p2 = 0) {
        
        if ($q) {
            $this->db->group_start();
            $this->db->or_like(['kdbar'=> $q, 'nama'=> $q, 'kdgol'=> $q, 'kdgol2'=> $q, 'pnj'=> $q, 'lbr'=> $q, 'tgi'=> $q, 'tag'=> $q, 'merk'=> $q]); // 'kdgol3'=> $q,
            if (strlen($q) == 8)
                $this->db->or_like('kdgol3', $q);
            $this->db->group_end();
        }
        
        // with price condition
        if ($p2) {
            
            if ($p2 > 0) {
                // $this->db->where('hjual between '.$p1.' and '.$p2);
                $this->db->where('hjual >=', $p1);
                $this->db->where('hjual <=', $p2);
            }
            
        } elseif ($p1) {
            $this->db->where('hjual > '.$p1);
        }

        // with brand condition
        if ($b) {
            if ($b !== 'OTHER') {
                $this->db->where('merk', $b);
            } else {
                $this->db->where('merk not in (select name from brands)');
            }
        }
        
        $where = "(master = 'Y' or parent is null)";
        $this->db->where($where);

        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $q = NULL, $b = NULL, $p1 = 0, $p2 = 0) {
        
        $qry = $this->db->select('kdbar, kdurl, nama, deskripsi, format(hjual,0,"id") as hjual, format(hpromo,0,"de") as hpromof, kriteria, pnj, lbr, tgi, gambar');
        
        if ($q) {
            $this->db->group_start();
            $this->db->or_like(['kdbar'=> $q, 'nama'=> $q, 'kdgol'=> $q, 'kdgol2'=> $q, 'pnj'=> $q, 'lbr'=> $q, 'tgi'=> $q, 'merk'=> $q]); // 'kdgol3'=> $q,
            if (strlen($q) == 8)
                $this->db->or_like('kdgol3', $q);
            $this->db->group_end();
        }
        
        // with price condition
        if ($p2) {
            if ($p2 > 0) {
                // $this->db->where('hjual between '.$p1.' and '.$p2);
                $this->db->where('hjual >=', $p1);
                $this->db->where('hjual <=', $p2);
            }
        } elseif ($p1) {
            $this->db->where('hjual > '.$p1);
        }

        // with brand condition
        if ($b) {
            if ($b !== 'OTHER') {
                $this->db->where('merk', $b);
            } else {
                $this->db->where('merk not in (select name from brands)');
            }
        }
        
        $this->db->where('master = "N"');

        if ($p1) {
            $this->db->order_by('hjual', $this->order);
        } else {
            $this->db->order_by($this->id, $this->order);
        }
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Stock_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-05 15:06:53 */
/* http://harviacode.com */
