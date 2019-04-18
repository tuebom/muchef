<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventory_model extends CI_Model
{

    public $table = 'stock';
    public $id = 'kdurl';
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

    // get data by item code
    function code_exists($id)
    {
        $this->db->select('kdbar');
        $this->db->where('kdbar', $id);
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('kdbar, kdurl, nama, kdgol, kdgol2, kdgol3, deskripsi, satuan, merk, size, parent, pnj, lbr, tgi, '.
        'listrik, kapasitas, gas, berat, fitur, kriteria, tag, hjual, hpromo, publish, master, saldo, gambar, gambar2, gambar3');
        $this->db->where('kdurl', $id);
        return $this->db->get($this->table)->row();
    }

    // get data by kodeurl
    function get_by_kodeurl($id)
    {
        $this->db->select('kdbar, kdurl, nama, kdgol2, format(hjual,0,"id") as hjual, publish, pnj, lbr, tgi, gambar, gambar2, gambar3');
        $this->db->where('kdurl', $id);
        return $this->db->get($this->table)->row();
    }

    // get data brand
    function all_brands()
    {
        $this->db->order_by('name', 'ASC');
        return $this->db->get('brands')->result();
    }

    // get brand by category
    function all_brands_by_catgry($catgry_id)
    {
        $this->db->distinct();
        $this->db->select('merk as name');
        $this->db->where('kdgol2', $catgry_id);
        $this->db->order_by('merk', 'ASC');
        return $this->db->get('stock')->result();
    }

    // get data parent
    function all_parents()
    {
        $this->db->select('kdbar, nama');
        $this->db->where('master', 'Y');
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('stock')->result();
    }

    // get data by category
    function get_by_category($limit, $start = 0, $code)
    {
        $this->db->select('kdbar, kdurl, nama, format(hjual,0,"de") as hjual, pnj, lbr, tgi, gambar, gambar2, gambar3');
        // $this->db->where('kdgol2', $code);
        $this->db->like('kdgol', $code);
        $this->db->or_like('kdgol2', $code);
        if (strlen($code) == 8)
            $this->db->or_like('kdgol3', $code);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows($q = NULL, $c = NULL, $b = NULL) { //
        
        if ($q) {
            $this->db->group_start();
            $this->db->or_like(['s.kdbar'=> $q, 's.nama'=> $q, 'g.nama'=> $q, 'merk'=> $q, 's.kdgol'=> $q, 's.kdgol2'=> $q, 'pnj'=> $q, 'lbr'=> $q, 'tgi'=> $q, 'tag'=> $q]); // 'kdgol3'=> $q,
            if (strlen($q) == 8)
                $this->db->or_like('s.kdgol3', $q);
            $this->db->group_end();
        }

        // by category
        if ($c) {
            $this->db->where('s.kdgol2', $c);
        }

        // with brand condition
        if ($b) {
            if ($b !== 'OTHER') {
                $this->db->where('merk', $b);
            } else {
                $this->db->where('merk not in (select name from brands)');
            }
        }
        // $this->db->from($this->table);
        $this->db->from('golongan g, stock s');
        $this->db->where('g.kdgol = s.kdgol');
        return $this->db->count_all_results();
    }

    function get_limit_data($limit, $start = 0, $q = NULL, $c = NULL, $b = NULL) { //
        
        $qry = $this->db->select('kdbar, kdurl, s.nama, g.nama as nmgol, s.kdgol, s.kdgol2, s.kdgol3, s.satuan, s.merk, s.size, format(s.hjual,0,"id") as hjual, s.pnj, s.lbr, s.tgi, s.gambar');
        $this->db->from('golongan g, stock s');
        $this->db->where('g.kdgol = s.kdgol');
        
        if ($q) {
            $this->db->group_start();
            $this->db->or_like(['s.kdbar'=> $q, 's.nama'=> $q, 'g.nama'=> $q, 's.merk'=> $q, 's.kdgol'=> $q, 's.kdgol2'=> $q, 'pnj'=> $q, 'lbr'=> $q, 'tgi'=> $q]); // 's.kdgol3'=> $q,
            
            // if (!$c)
            //     $this->db->or_like('kdgol2', $q);
            if (strlen($q) == 8)
                $this->db->or_like('kdgol3', $q);
            $this->db->group_end();
        }

        // by category
        if ($c) {
            $this->db->where('s.kdgol2', $c);
        }

        // with brand condition
        if ($b) {
            if ($b !== 'OTHER') {
                $this->db->where('merk', $b);
            } else {
                $this->db->where('merk not in (select name from brands)');
            }
        }

        // if ($p1) {
        //     $this->db->order_by('hjual', $this->order);
        // } else {
            $this->db->order_by($this->id, $this->order);
        // }
	    $this->db->limit($limit, $start);
        return $this->db->get()->result(); //$this->table
    }
    
    // get total rows
    function total_history_rows($code, $q = NULL) { //, $b = NULL
        
        $this->db->where('o1.kdbar', $code);
        
        if ($q) {
            $this->db->group_start();
            $this->db->or_like(['o.id'=> $q, 'u.first_name'=> $q, 'u.last_name'=> $q, 'o1.qty'=> $q, 'o1.hjual'=> $q, 'o1.jumlah'=> $q]); // 'kdgol3'=> $q,  'merk'=> $q,
            $this->db->group_end();
        }

        // $this->db->from($this->table);
        $this->db->from('orders o, orders_detail o1, users u');
        $this->db->where('o.id = o1.id and o.status = "DLV" and o.mbrid = u.id');
        return $this->db->count_all_results();
    }

    // get history
    function get_history($code, $q = NULL)
    {
        $this->db->select('CONCAT(DAY(o.tglinput)," ",'. //o.tglinput,
        'CASE MONTH(o.tglinput) '.
          'WHEN 1 THEN "Jan" '.
          'WHEN 2 THEN "Feb" '.
          'WHEN 3 THEN "Mar" '.
          'WHEN 4 THEN "Apr" '.
          'WHEN 5 THEN "Mei" '.
          'WHEN 6 THEN "Jun" '.
          'WHEN 7 THEN "Jul" '.
          'WHEN 8 THEN "Agu" '.
          'WHEN 9 THEN "Sep" '.
          'WHEN 10 THEN "Okt" '.
          'WHEN 11 THEN "Nov" '.
          'WHEN 12 THEN "Des" '.
        'END," ", YEAR(o.tglinput)) as tglinput, o.id, concat(u.first_name, " ", u.last_name) as nama, o1.qty, o1.hjual, o1.jumlah');
        $this->db->from('orders o, orders_detail o1, users u');
        $this->db->where('o.id = o1.id and o.status = "DLV" and o.mbrid = u.id');
        $this->db->where('o1.kdbar', $code);
        
        if ($q) {
            $this->db->group_start();
            $this->db->or_like(['o.id'=> $q, 'u.first_name'=> $q, 'u.last_name'=> $q, 'o1.qty'=> $q, 'o1.hjual'=> $q, 'o1.jumlah'=> $q]); // 'kdgol3'=> $q,  'merk'=> $q,
            $this->db->group_end();
        }
        $this->db->order_by('o.tglinput', 'DESC');
        $this->db->order_by('o.id', 'ASC');
        return $this->db->get()->result();
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
        return ($this->db->error()['code'] == 0) ? TRUE : FALSE;
    }

    // delete data
    function delete($id)
    {
        // $this->db->where($this->id, $id);
        $this->db->where('kdbar', $id);
        $this->db->delete($this->table);
    }

}

/* End of file Inventory_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-05 15:06:53 */
/* http://harviacode.com */
