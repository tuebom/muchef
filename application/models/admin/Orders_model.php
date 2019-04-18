<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders_model extends CI_Model
{

    public $table = 'orders';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->select('select orders.id, concat(address.first_name, " ", address.last_name) as name, orders.tglinput, concat(address.address, ", ", address.district, ", ", address.regency, " - ", address.province, " ", address.post_code) as alamat, orders.gtotal')
        ->from('orders, address, users')
        ->where('orders.addrid = address.id and orders.mbrid = users.id')
        ->order_by('orders.id', 'ASC');
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('o.id, concat(a.first_name, " ", a.last_name) as name, '. //o.tglinput,'.
        'CONCAT(DAY(o.tglinput),"/",MONTH(o.tglinput),"/", YEAR(o.tglinput)) as tglinput,'.
        // 'a.address, d.name as district, r.name as regency, p.name as province, a.post_code,'.
        'a.address, r.name as regency, p.name as province, a.post_code,'.
        'a.phone, a.email, o.status, o.total, o.tax, o.shipcost, o.gtotal, o.delivery, o.package, o.note');
        $this->db->from('orders o');
        $this->db->join('address a', 'o.addrid = a.id');
        $this->db->join('provinces p', 'a.province = p.id');
        $this->db->join('regencies r', 'a.regency = r.id');
        // $this->db->join('districts d', 'a.district = d.id');
        $this->db->join('users u', 'o.mbrid = u.id');

        $this->db->where('o.id', $id);
        return $this->db->get()->row();
        // return $this->db->get($this->table)->row();
    }

    // get data by order id
    function get_by_order_id($order_id)
    {
        $this->db->select('id, order_id, status, gtotal');
        $this->db->from('orders');
        $this->db->where('order_id', $order_id);
        return $this->db->get()->row();
    }

    // daftar item order
    function get_order_detail($id)
    {
        $this->db->select('o1.urut, o1.kdbar, s.kdurl, s.nama, o1.qty, o1.hjual, o1.jumlah, s.gambar');
        $this->db->from('orders_detail o1, stock s');
        $this->db->where('o1.kdbar = s.kdbar');
        $this->db->where('o1.id', $id);
        $this->db->order_by('o1.urut', 'ASC');
        return $this->db->get()->result();
    }

    // daftar item belum bayar
    function get_item_pending($mbrid)
    {
        $this->db->select('o1.kdbar, s.kdurl, s.nama, o1.qty, o1.hjual, o1.jumlah, s.gambar');
        $this->db->from('orders o, orders_detail o1, stock s');
        $this->db->where('o.id = o1.id and o1.kdbar = s.kdbar and o.status = "PND"');
        $this->db->where('o.mbrid', $mbrid);
        $this->db->order_by('o1.urut', 'ASC');
        return $this->db->get()->result();
    }

    // daftar item dalam proses (belum dikirim)
    function get_item_processed($mbrid)
    {
        $this->db->select('o1.kdbar, s.kdurl, s.nama, o1.qty, o1.hjual, o1.jumlah, s.gambar');
        $this->db->from('orders o, orders_detail o1, stock s');
        $this->db->where('o.id = o1.id and o1.kdbar = s.kdbar and o.status = "PAID"');
        $this->db->where('o.mbrid', $mbrid);
        $this->db->order_by('o1.urut', 'ASC');
        return $this->db->get()->result();
    }

    // daftar item sudah dikirim (shipped)
    function get_item_shipped($mbrid)
    {
        $this->db->select('o1.kdbar, s.kdurl, s.nama, o1.qty, o1.hjual, o1.jumlah, s.gambar');
        $this->db->from('orders o, orders_detail o1, stock s');
        $this->db->where('o.id = o1.id and o1.kdbar = s.kdbar and o.status = "SHIP"');
        $this->db->where('o.mbrid', $mbrid);
        $this->db->order_by('o1.urut', 'ASC');
        return $this->db->get()->result();
    }

    // daftar item sudah sampai (delivered)
    function get_item_delivered($mbrid)
    {
        $this->db->select('o1.kdbar, s.kdurl, s.nama, o1.qty, o1.hjual, o1.jumlah, s.gambar');
        $this->db->from('orders o, orders_detail o1, stock s');
        $this->db->where('o.id = o1.id and o1.kdbar = s.kdbar and o.status = "DLV"');
        $this->db->where('o.mbrid', $mbrid);
        $this->db->order_by('o1.urut', 'ASC');
        return $this->db->get()->result();
    }

    // get history
    function get_history($mbrid)
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
        'END," ", YEAR(o.tglinput)) as tglinput, o.id, o1.kdbar, s.kdurl, s.nama, o1.qty, o1.hjual, o1.jumlah, s.gambar');
        $this->db->from('orders o, orders_detail o1, stock s');
        $this->db->where('o.id = o1.id and o1.kdbar = s.kdbar and o.status = "DLV"');
        $this->db->where('o.mbrid', $mbrid);
        $this->db->order_by('o.tglinput', 'DESC');
        $this->db->order_by('o.id', 'ASC');
        $this->db->order_by('o1.urut', 'ASC');
        return $this->db->get()->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->from('orders o');
        $this->db->join('address a', 'o.addrid = a.id');
        $this->db->join('provinces p', 'a.province = p.id');
        $this->db->join('regencies r', 'a.regency = r.id');
        // $this->db->join('districts d', 'a.district = d.id');
        $this->db->join('users u', 'o.mbrid = u.id');

        $this->db->like('o.id', $q);
        
        $this->db->or_like('a.first_name', $q);
        $this->db->or_like('a.last_name', $q);
        $this->db->or_like('a.address', $q);
        
        $this->db->or_like('p.name', $q);
        $this->db->or_like('r.name', $q);
        // $this->db->or_like('d.name', $q);

        $this->db->or_like('o.mbrid', $q);
        $this->db->or_like('o.total', $q);
        $this->db->or_like('o.payment', $q);
        $this->db->or_like('o.note', $q);
        $this->db->or_like('o.delivery', $q);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->select('o.id, concat(a.first_name, " ", a.last_name) as name, '. //o.tglinput,'.
        'CONCAT(DAY(o.tglinput)," ",'.
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
            'END," ", YEAR(o.tglinput)) as tglinput,'.
        'IF(o.status = "PND", "Pending", IF(o.status = "PAID", "Processing",'.
        'IF(o.status = "SHIP", "Shipped", "Delivered"))) as status,'.
        // 'CONCAT(a.address, ", ", d.name, ", ", r.name, " - ", p.name, " ", a.post_code) as address, o.gtotal');
        'CONCAT(a.address, ", ", r.name, " - ", p.name, " ", a.post_code) as address, o.total, o.tax, o.shipcost, o.gtotal, o.delivery, o.package');
        $this->db->from('orders o');
        $this->db->join('address a', 'o.addrid = a.id');
        $this->db->join('provinces p', 'a.province = p.id');
        $this->db->join('regencies r', 'a.regency = r.id');
        // $this->db->join('districts d', 'a.district = d.id');
        $this->db->join('users u', 'o.mbrid = u.id');

        $this->db->or_like('o.id', $q);
        
        $this->db->or_like('a.first_name', $q);
        $this->db->or_like('a.last_name', $q);
        $this->db->or_like('a.address', $q);
        
        $this->db->or_like('p.name', $q);
        $this->db->or_like('r.name', $q);
        // $this->db->or_like('d.name', $q);

        $this->db->or_like('o.mbrid', $q);
        $this->db->or_like('o.total', $q);
        $this->db->or_like('o.payment', $q);
        $this->db->or_like('o.note', $q);
        $this->db->or_like('o.delivery', $q);

        $this->db->order_by('o.id', 'ASC');
        
        $this->db->limit($limit, $start);
        return $this->db->get()->result(); //$this->table
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

/* End of file Orders_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-05 15:06:21 */
/* http://harviacode.com */