<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class M_data extends CI_Model{
		function input_data($data,$table){
            $this->db->insert($table,$data);
        }
        function hapus_data($where,$table){
            $this->db->where($where);
            $this->db->delete($table);
        }
        function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }
        function semua($table){
            return $this->db->get($table);
        }
        function where($table,$where){
            return $this->db->get_where($table,$where);
        }
        function hs($where,$where1,$where2,$where3){
            $this->db->select('DISTINCT class_values as kelas');
            $this->db->where($where);
            $this->db->where($where1);
            $this->db->where($where2);
            $this->db->where($where3);
            return $this->db->get('training');
        }
        function ordernya($name,$or,$table){
            $this->db->order_by($name, $or);
            $query = $this->db->get($table);
            return $query;
        }
        function cus(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='buying'");
        }
         function cus2(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='buying' and atribut!='maint'");
        }
        function cus22(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='persons'");
        }
        function cus22x(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='maint'");
        }
        function cus22xx1(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='buying'");
        }
        function cus22xx2(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut !='maint' and atribut!='buying'");
        }
         function cus22xx3(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut !='maint' and atribut!='lug_boot'");
        }
        function cus22xx4(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut !='buying' and atribut!='maint'");
        }
        function cus22xx5(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut !='buying' and atribut!='persons'");
        }
        function cus22xx6(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut !='buying' and atribut!='lug_boot'");
        }
        function cus22xx6x1(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut !='buying' and atribut!='lug_boot' and atribut!='doors'");
        }
         function cus22xx6x2(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut !='buying' and atribut!='maint' and atribut!='lug_boot'");
        }
        function cus22_b2(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='persons' and atribut!='buying'");
        }
        function cus22_b2x(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='maint' and atribut!='buying'");
        }
        function cus22_b(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='maint'");
        }
        function cus222(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='persons' and atribut !='maint'");
        }
         function cus222w(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='persons' and atribut !='lug_boot'");
        }
        function cus222w1(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='persons' and atribut !='buying'");
        }
        function cus222w2(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='persons' and atribut !='buying' and atribut !='maint'");
        }
        function cus222x(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='safety' and atribut!='persons' and atribut !='buying'");
        }
        function cus3(){
            return $this->db->query("SELECT * FROM `atribut` where atribut!='buying' and atribut!='maint' and atribut !='doors'");
        }
        function trexzw(){
            return $this->db->query("SELECT DISTINCT safety,persons FROM `train` order by safety DESC ,persons DESC");
        }
        function trexzw1(){
            return $this->db->query("SELECT DISTINCT safety,persons,lug_boot FROM `train` where safety='med' and persons='more' order by safety DESC ,persons DESC, lug_boot DESC");
        }
        function trexzw2(){
            return $this->db->query("SELECT DISTINCT safety,persons,buying FROM `train` order by safety DESC ,persons DESC, buying DESC");
        }
         function trexzw3(){
            return $this->db->query("SELECT DISTINCT safety,persons,buying,maint FROM `train` order by safety DESC ,persons DESC, buying DESC,maint DESC");
        }
        function tree(){
            return $this->db->query("SELECT DISTINCT maint,doors FROM `train`");
        }
        function trex(){
            return $this->db->query("SELECT DISTINCT buying,maint FROM `training` order by buying DESC ,maint DESC");
        }
        
        function trexz(){
            return $this->db->query("SELECT DISTINCT safety,persons FROM `training` order by safety DESC ,persons DESC");
        }
        function trexzy(){
            return $this->db->query("SELECT DISTINCT safety,maint FROM `again3` order by safety DESC ,maint DESC");
        }
        function trexzyy1(){
            return $this->db->query("SELECT DISTINCT safety,maint,buying FROM `again3` order by safety DESC ,maint DESC,buying DESC");
        }
        function trexzyy2(){
            return $this->db->query("SELECT DISTINCT safety,maint,lug_boot FROM `again3` order by safety DESC ,maint DESC,lug_boot DESC");
        }
        function trexzy1(){
            return $this->db->query("SELECT DISTINCT safety,buying FROM `again3` order by safety DESC ,buying DESC");
        }
        function trexzyx1(){
            return $this->db->query("SELECT DISTINCT safety,buying,maint FROM `again3` order by safety DESC ,buying DESC,maint DESC");
        }
        function trexzyx2(){
            return $this->db->query("SELECT DISTINCT safety,buying,persons FROM `again3` order by safety DESC ,buying DESC,persons DESC");
        }
        function trexzyx3(){
            return $this->db->query("SELECT DISTINCT safety,buying,lug_boot FROM `again3` order by safety DESC ,buying DESC,lug_boot DESC");
        }
        function trexzyx4x(){
            return $this->db->query("SELECT DISTINCT safety,buying,lug_boot,doors FROM `again3` WHERE doors='3' order by safety DESC ,buying DESC,lug_boot DESC, doors DESC");
        }
        function trexzyx5x(){
            return $this->db->query("SELECT DISTINCT safety,buying,maint,lug_boot FROM `again3` where lug_boot='med' order by safety DESC ,buying DESC,maint DESC, lug_boot DESC");
        }
        function trexz_b(){
            return $this->db->query("SELECT DISTINCT safety,persons FROM `train5` order by safety DESC ,persons DESC");
        }
        function trexz_bx(){
            return $this->db->query("SELECT DISTINCT safety,persons,buying FROM `train5` order by safety DESC ,persons DESC,buying DESC");
        }
         function trexz_bx1(){
            return $this->db->query("SELECT DISTINCT safety,maint,buying FROM `train5` order by safety DESC ,persons DESC,buying DESC");
        }
        function trexz_bb(){
            return $this->db->query("SELECT DISTINCT safety,maint FROM `train5` order by safety DESC ,maint DESC");
        }
        function trexz1(){
            return $this->db->query("SELECT DISTINCT safety,persons,maint FROM `training` where safety='med' and persons='more' order by safety DESC ,persons DESC, maint DESC");
        }
        function trexz11(){
            return $this->db->query("SELECT DISTINCT safety,persons,maint FROM `training` where safety='med' and persons='more' and buying='buying' order by safety DESC ,persons DESC, maint DESC,buying DESC");
        }
        function trexz2(){
            return $this->db->query("SELECT DISTINCT safety,persons,buying FROM `training` order by safety DESC ,persons DESC, buying DESC");
        }
        function trexx(){
            return $this->db->query("SELECT DISTINCT buying,maint FROM `train` order by buying DESC ,maint DESC");
        }
        function trex2(){
            return $this->db->query("SELECT DISTINCT buying,maint,doors FROM `training` order by buying DESC ,maint DESC , doors ASC");
        }
         function trex22(){
            return $this->db->query("SELECT DISTINCT buying,maint,doors FROM `train` order by buying DESC ,maint DESC , doors ASC");
        }
        function treesss(){
            return $this->db->query("SELECT DISTINCT maint FROM `train` ");
        }
        
        function seluruh2(){
            return $this->db->query("SELECT * FROM `again3` where class_values ='vgood' limit 15");
        }
        
        function seluruh3(){
            return $this->db->query("SELECT DISTINCT petal_length FROM `train`");
        }
        function tr1(){
            return $this->db->query("SELECT DISTINCT middle_middle,middle_right FROM `train` where middle_middle='x'");
        }
        function seluruh($name,$or,$table){
            $this->db->order_by($name, $or);
//            $this->db->limit('420');
            $query = $this->db->get($table);
            return $query;
        }
        function where_c($name,$or,$table,$where){
            $this->db->order_by($name, $or);
            $this->db->limit('420');
            return $this->db->get_where($table,$where);
        }
    }