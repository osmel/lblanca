<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

	class modelo_cliente extends CI_Model {
		
		private $key_hash;
		private $timezone;

		function __construct(){

			parent::__construct();
			$this->load->database("default");
			$this->key_hash    = $_SERVER['HASH_ENCRYPT'];
			$this->timezone    = 'UM1';
      date_default_timezone_set('America/Mexico_City');       

        $this->equipos             = $this->db->dbprefix('catalogo_equipo');
        $this->tecnicos    = $this->db->dbprefix('catalogo_tecnico');
        $this->estatus    = $this->db->dbprefix('catalogo_estatus');
        $this->clientes    = $this->db->dbprefix('clientes');
        $this->ordenes    = $this->db->dbprefix('orden');

    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////Clientes//////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////



        public function total_clientes(){
              $id_session = $this->session->userdata('id');
              $this->db->from($this->clientes.' as c');
              $cant = $this->db->count_all_results();          
              if ( $cant > 0 )
                 return $cant;
              else
                 return 0;         
       }     


      public function buscador_clientes($data){

          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];

          switch ($columa_order) {
                   case '0':
                        $columna = 'c.nombre';
                     break;
                   
                   default:
                        $columna = 'c.nombre';
                     break;
                 }                 

                                      

          $id_session = $this->db->escape($this->session->userdata('id'));

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          $this->db->select('c.id,c.uid, c.orden, c.baja');
          $this->db->select('c.fecha_entrada');
          $this->db->select('c.nombre, c.domicilio, c.referencia, c.id_equipo, c.marca, c.falla, c.reporte, c.subtotal, c.total, c.id_estatus');
          $this->db->select('e.equipo equipo');
          $this->db->select('s.estatu estatus');

          $this->db->from($this->clientes.' as c');
          $this->db->join($this->equipos.' As e', 'c.id_equipo = e.id','LEFT');
          $this->db->join($this->estatus.' As s', 'c.id_estatus = s.id','LEFT');

          
          //filtro de busqueda
       
          $where = '(
                      (
                        ( c.orden LIKE  "%'.$cadena.'%" ) OR (c.nombre LIKE  "%'.$cadena.'%")
                        
                       )
            )';   



  
          $this->db->where($where);
    
          //ordenacion
          $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      
                                      0=>$row->orden,
                                      1=>$row->fecha_entrada,
                                      2=>$row->nombre,
                                      3=>$row->equipo,
                                      4=>$row->falla,
                                      5=>$row->total,
                                      6=>$row->estatus,
                                      7=>self::clientes_en_uso($row->id),
                                      8=>$row->id,
                                      9=>$row->uid,
                                      10=>$row->baja,
                                    );
                      }


    


                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_clientes() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      } 


        public function eliminar_cliente( $data ){
                $this->db->set( 'baja', '(1 XOR '.$data["baja"].')', FALSE );
                $this->db->where('id', $data['id'] );
                $this->db->update($this->clientes );
                
                if ($this->db->affected_rows() > 0) {
                    return TRUE;
                }  else
                     return FALSE;
      
        }              



public function clientes_en_uso($id_cliente) {
                  return 0;

          $result = $this->db->query("
            select distinct r.id_cliente from (

            (select distinct id_cliente from ".$this->productos.")
              union   

            (select distinct id_cliente from ".$this->registros_temporales.")
              union   
            (select distinct id_cliente from ".$this->registros_cambios.")
              union   

            (select distinct id_cliente from ".$this->registros_entradas.")
              union   

            (select distinct id_cliente from ".$this->registros_salidas.")
              union   

            (select distinct id_cliente from ".$this->historico_registros_entradas.")
              union   

            (select distinct id_cliente from ".$this->historico_registros_salidas.")
              ) r 
           where r.id_cliente='".$id_cliente."'                                

          "
          );  

           if ( $result->num_rows() > 0 ) {
                  return 1;
              } else 
                  return 0;
            $result->free_result();                 

      }    


      //crear
        public function anadir_cliente( $data ){
          $id_session = $this->session->userdata('id');
          
          //$this->db->set( 'id_usuario',  $id_session );
          
          $this->db->set( 'orden', $data['orden'] );  
          $this->db->set( 'uid', $data['uid'] );  
          $this->db->set( 'nombre', $data['nombre'] );  
          
          $data['fecha_entrada'] = date("Y-m-d H:i:s", strtotime($data['fecha_entrada']) );

          $this->db->set( 'fecha_entrada', $data['fecha_entrada'] );  
          $this->db->set( 'domicilio', $data['domicilio'] );  
          $this->db->set( 'referencia', $data['referencia'] );  
          $this->db->set( 'id_equipo', $data['id_equipo'] );  
          $this->db->set( 'marca', $data['marca'] );  

          $this->db->set( 'falla', $data['falla'] );  
          $this->db->set( 'reporte', $data['reporte'] );  
          $this->db->set( 'subtotal', $data['subtotal'] );  
          $this->db->set( 'total', $data['total'] );  
          $this->db->set( 'id_estatus', $data['id_estatus'] );  

          $this->db->insert($this->clientes );
          if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }          



  //crear
        public function editar_cliente( $data ){
          $id_session = $this->session->userdata('id');
          
          //$this->db->set( 'id_usuario',  $id_session );
          
          $this->db->set( 'orden', $data['orden'] );  
          $this->db->set( 'nombre', $data['nombre'] );  


          $data['fecha_entrada'] = date("Y-m-d H:i:s", strtotime($data['fecha_entrada']) );

          $this->db->set( 'fecha_entrada', $data['fecha_entrada']  );  
          $this->db->set( 'domicilio', $data['domicilio'] );  
          $this->db->set( 'referencia', $data['referencia'] );  
          $this->db->set( 'id_equipo', $data['id_equipo'] );  
          $this->db->set( 'marca', $data['marca'] );  

          $this->db->set( 'falla', $data['falla'] );  
          $this->db->set( 'reporte', $data['reporte'] );  
          $this->db->set( 'subtotal', $data['subtotal'] );  
          $this->db->set( 'total', $data['total'] );  
          $this->db->set( 'id_estatus', $data['id_estatus'] );  

          $this->db->where( 'id', $data['id'] );  //

          $this->db->update($this->clientes );
          if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }   

  public function buscar_cliente_detalle($data){
          $this->db->select('c.id,c.uid, c.orden');
          $this->db->select('c.fecha_entrada');
          $this->db->select('c.nombre, c.domicilio, c.referencia, c.id_equipo, c.marca, c.falla, c.reporte, c.subtotal, c.total, c.id_estatus');
          $this->db->select('e.equipo equipo');
          $this->db->select('t.estatu estatus');
          $this->db->from($this->clientes.' as c');
          $this->db->join($this->equipos.' As e', 'c.id_equipo = e.id','LEFT');
          $this->db->join($this->estatus.' As t', 'c.id_estatus = t.id','LEFT');


          $where = '(
                      (
                        ( c.id =  '.$data['id'].' ) 
                        
                       )
          )';   
          $this->db->where($where);
          $result = $this->db->get();
              if ( $result->num_rows() > 0 ) {
                 return $result->row();
              } else {
                return false;
              }

              $result->free_result();           

      } 

  public function buscar_orden_detalle($data){
          $this->db->select('o.id,o.id_cliente');
          $this->db->select('o.fecha_entrega');
          $this->db->select('t.tecnico tecnico ');
          
          $this->db->select('o.id_estatus, o.id_tecnico');

          $this->db->select('o.falla, o.reporte, o.subtotal, o.total');
          $this->db->select('e.estatu estatus');

          $this->db->from($this->ordenes.' as o');
          $this->db->join($this->tecnicos.' As t', 'o.id_tecnico = t.id','LEFT');
          $this->db->join($this->estatus.' As e', 'o.id_estatus = e.id','LEFT');
          $where = '(
                      (
                        ( o.id_cliente =  '.$data['id'].' ) 
                        
                       )
          )';   
          $this->db->where($where);
          $result = $this->db->get();
              if ( $result->num_rows() > 0 ) {
                 return $result->row();
              } else {
                return false;
              }

              $result->free_result();           

      } 

  //crear
        public function anadir_orden( $data ){
          $id_session = $this->session->userdata('id');
          
          $this->db->set( 'id_cliente', $data['id_cliente'] );  
          $this->db->set( 'id_tecnico', $data['id_tecnico'] );  
          
          $data['fecha_entrega'] = date("Y-m-d H:i:s", strtotime($data['fecha_entrega']) );
          $this->db->set( 'fecha_entrega', $data['fecha_entrega'] );  

          $this->db->set( 'falla', $data['falla'] );  
          $this->db->set( 'reporte', $data['reporte'] );  
          $this->db->set( 'subtotal', $data['subtotal'] );  
          $this->db->set( 'total', $data['total'] );  
          $this->db->set( 'id_estatus', $data['id_estatus'] );  

          $this->db->insert($this->ordenes );
          if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }          

 //editar
        public function editar_orden( $data ){
          $id_session = $this->session->userdata('id');
          
          $this->db->set( 'id_cliente', $data['id_cliente'] );  
          $this->db->set( 'id_tecnico', $data['id_tecnico'] );  
          
          $data['fecha_entrega'] = date("Y-m-d H:i:s", strtotime($data['fecha_entrega']) );
          $this->db->set( 'fecha_entrega', $data['fecha_entrega'] );  

          $this->db->set( 'falla', $data['falla'] );  
          $this->db->set( 'reporte', $data['reporte'] );  
          $this->db->set( 'subtotal', $data['subtotal'] );  
          $this->db->set( 'total', $data['total'] );  
          $this->db->set( 'id_estatus', $data['id_estatus'] );  

          $this->db->update($this->ordenes );
          if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }          


	} 


?>
