<?php
class BarangModel extends CI_Model
{

    public function countDataBarang()
    {
        $query = " SELECT 
                count(*) as CountData 
            FROM barang b
        ";

        return $this->db->query($query)->result();
    }


    public function getWhere($where)
    {
        return $this->db->get_where('barang', $where)->result();
    }

    public function insertData($data)
    {
        $this->db->insert('barang', $data);
        return $this->db->insert_id();
    }

    public function insertDataBatch($data)
    {
        $this->db->insert_batch('barang', $data);
    }

    public function updateTriggerExistingBarang($data)
    {
        $this->db->insert_batch('trx_barang_update', $data);
    }

    /*
    public function updateLiveStocks($data)
    {
        $query = "UPDATE barang SET 
                    quantity_check=:quantity_check_barang
                WHERE 
                    kode=:kode
                AND nama_barang=:nama_barang
        ";
        $this->db->query($query);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('quantity_check_barang', $data['quantity_check_barang']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function selectDataLiveStocks($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $query = "SELECT quantity_check 
                from 
                    barang 
                WHERE 
                    kode=:kode
                AND nama_barang=:nama_barang
        ";
        $this->db->query($query);
        $this->db->bind('kode', $data['kode']);
        $this->db->bind('nama_barang', $data['nama_barang']);

        $allData = $this->db->resultset();
        return $allData;
    }

    */

    public function selectDataPaging($halamanAwal, $batasTampilData,$keyword)
    {
        $query="";
        if(isset($keyword) && $keyword !=""){
            
          $query = "  SELECT * from barang where UPPER(nama_barang)=UPPER('$keyword') or UPPER(kode)= UPPER('$keyword')  limit " . $halamanAwal . ", " . $batasTampilData;
        }else{
            
          $query = "  SELECT * from barang  limit " . $halamanAwal . ", " . $batasTampilData;
        }



        return $this->db->query($query)->result();
    }

    public function selectDataPagingCount($keyword)
    {
        $query="";
        if(isset($keyword) && $keyword !=""){
            
          $query = "  SELECT * from barang where UPPER(nama_barang)=UPPER('$keyword') or UPPER(kode)= UPPER('$keyword') ";
        }else{
            
          $query = "  SELECT * from barang ";
        }

        return $this->db->query($query)->result();
    }

    public function updateData($data, $where)
    {
        $this->db->set($data);
        $this->db->where($where);
        $this->db->update('barang');
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        //log_message('debug',$this->db->last_query());
        return $query->result();
    }

    // start datatables
    var $column_order = array(null, 'kode', 'nama_barang', 'quantity_pusat', 'quantity_sobat', 'satuan', 'harga_satuan'); //set column field database for datatable orderable
    var $column_search = array('nama_barang'); //set column field database for datatable searchable
    var $order = array('id' => 'desc'); // default order 

    private function _get_datatables_query()
    {
        $this->db->select('barang.*');
        $this->db->from('barang');
        //$this->db->join('kategori', 'barang.id_kategori = kategori.id_kategori');
        //$this->db->join('p_unit', 'p_item.unit_id = p_unit.unit_id');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        //log_message('debug',$this->db->last_query());
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from('barang');
        //$this->db->join('kategori', 'barang.id_kategori = kategori.id_kategori');
        //log_message('debug',$this->db->last_query());
        return $this->db->count_all_results();
    }
}
