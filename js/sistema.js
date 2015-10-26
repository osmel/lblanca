jQuery(document).ready(function($) {



//////////////////////////////////////////////////////////
/////////////////////USUARIOS/////////////////////////////
/////////////////////////////////////////////////////////


jQuery('#tabla_clientes').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "procesando_clientes",
              "type": "POST",
              
       },   

    "language": {  //tratamiento de lenguaje
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No hay registros",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "No hay registros disponibles",
      "infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
      "emptyTable":     "No hay registros",
      "infoPostFix":    "",
      "thousands":      ",",
      "loadingRecords": "Leyendo...",
      "processing":     "Procesando...",
      "search":         "Buscar:",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
      },
      "aria": {
        "sortAscending":  ": Activando para ordenar columnas ascendentes",
        "sortDescending": ": Activando para ordenar columnas descendentes"
      },
    },


    "columnDefs": [
    		/*
            { 
 					visible: false,
                    "targets": [7,8,9]//
            },*/
            { 
                    "render": function ( data, type, row ) {
                        return data;
                    },
                    "targets": [1,2,3,4,5,6]//
            },
            {
                "render": function ( data, type, row ) {

	            texto='<td>';
	              texto+='<a href="detalles_cliente/'+jQuery.base64.encode(row[8])+'" type="button"'; 
	              texto+=' class="btn btn-warning btn-sm btn-block" >';
	                texto+=' <span class="glyphicon glyphicon-edit"></span>';
	              texto+=' </a>';
	            texto+='</td>';
	              return texto; 
                },
                "targets": 7
            },
            {
                "render": function ( data, type, row ) {

                  if (row[7]==0) {
	                  texto=' <td>';                
	                  texto+=' <a href="eliminar_cliente/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
	                  texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
	                  texto+=' <span class="glyphicon glyphicon-off"></span>';
	                  texto+=' </a>';
	                texto+=' </td>';  
	                      } else {
	                  texto=' <fieldset disabled> <td>';                
	                  texto+=' <a href="#"'; 
	                  texto+=' class="btn btn-danger btn-sm btn-block">';
	                  texto+=' <span class="glyphicon glyphicon-off"></span>';
	                  texto+=' </a>';
	                texto+=' </td></fieldset>'; 
                  }
            	  return texto; 
                },
                "targets": 8
            },
               
               
            ],
  }); 



//////////////////////////////////////////////////////////
/////////////////////USUARIOS/////////////////////////////
/////////////////////////////////////////////////////////
//gestion de usuarios (crear, editar y eliminar usuarios )
	jQuery('body').on('submit','#form_usuarios', function (e) {
		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);
		jQuery(this).ajaxSubmit({
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				

				}else{
  							$catalogo = e.target.name;
							spinner.stop();
							jQuery('#foo').css('display','none');
							window.location.href = '/'+$catalogo;	
				}
			} 
		});
		return false;
	});	


jQuery('#tabla_usuarios').dataTable( {
					"pagingType": "full_numbers",
					"processing": true,
					"serverSide": true,
					"ajax": {
				            	"url" : "procesando_usuarios",
				         		"type": "POST",
								 "data": function ( d ) {
								        //d.id_modulo = jQuery("#id_modulo").val();  
								 }
				     },   

					"infoCallback": function( settings, start, end, max, total, pre ) {
					    return pre
					},    
				   "columnDefs": [
				    			{ 
					                "render": function ( data, type, row ) {
										return data;	
					                },
					                "targets": [0,1,2]
					            },

								 {
					                "render": function ( data, type, row ) {

									texto='<td>';
										texto+=' <a href="editar_usuario/'+(row[4])+ '"'; 
										texto+=' class="btn btn-warning btn-sm btn-block" > ';
											texto+=' <span class="glyphicon glyphicon-edit"></span>';
										texto+=' </a>';
									texto+='</td>';


										return texto;	
					                },
					                "targets": 3
					            },


								 {
					                "render": function ( data, type, row ) {

									texto='<td>';
										texto+=' <a href="eliminar_usuario/'+(row[4])+'/'+jQuery.base64.encode(row[0])+ '"'; 
										texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage"> ';
											texto+=' <span class="glyphicon glyphicon-remove"></span>';
										texto+=' </a>';
									texto+='</td>';


										return texto;	
					                },
					                "targets": 4
					            },



					],	

					"language": {  //tratamiento de lenguaje
						"lengthMenu": "Mostrar _MENU_ registros por paginas",
						"zeroRecords": "No hay registros - disculpe",
						"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
						"emptyTable":     "No hay disponibles datos en la tabla",
						"infoPostFix":    "",
						"thousands":      ",",
						"loadingRecords": "Leyendo...",
						"processing":     "Procesando...",
						"search":         "Buscar:",
						"paginate": {
							"first":      "Primero",
							"last":       "Último",
							"next":       "Próximo",
							"previous":   "Anterior"
						},
						"aria": {
							"sortAscending":  ": Activando para ordenar columnas ascendentes",
							"sortDescending": ": Activando para ordenar columnas descendentes"
						},
					},
});






//////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

abrir = function(verb, url, data, target) {
  var form = document.createElement("form");
  form.action = url;
  form.method = verb;
  form.target = target || "_self";
  if (data) {
    for (var key in data) {
      var input = document.createElement("textarea");
      input.name = key;
      input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
      form.appendChild(input);
    }
  }
  form.style.display = 'none';
  document.body.appendChild(form);
  form.submit();
};


//Agregar las estradas a salidas
jQuery('body').on('click','#exportar_general', function (e) {


										var fecha = (jQuery('.fecha_general').val()).split(' / ');
										fecha_inicial = fecha[0];
										fecha_final = fecha[1];

										var recorrido = new Array();
										jQuery('.check_recorrido:checked').each(function(){
											//cada elemento seleccionado
											recorrido.push(jQuery(this).attr('identificador'));
											
										});
										console.log(recorrido);
										//recorrido = recorrido;
										busqueda      = jQuery('input[type=search]').val();
	        

    abrir('POST', 'exportar_reportes', {
	        recorrido:recorrido,
			fecha_inicial: fecha_inicial,
			fecha_final :fecha_final,
			busqueda:busqueda,
    }, '_blank' );
		        
	
});





	var opts = {
		lines: 13, 
		length: 20, 
		width: 10, 
		radius: 30, 
		corners: 1, 
		rotate: 0, 
		direction: 1, 
		color: '#E8192C',
		speed: 1, 
		trail: 60,
		shadow: false,
		hwaccel: false,
		className: 'spinner',
		zIndex: 2e9, 
		top: '50%', // Top position relative to parent
		left: '50%' // Left position relative to parent		
	};

	jQuery(".navigacion").change(function()	{
	    document.location.href = jQuery(this).val();
	});



	var target = document.getElementById('foo');

	//tratamiento de fechas
	var fecha_actual = new Date();
	
	var fecha_anterior = new Date( fecha_actual.getTime() - (30 * 24 * 3600 * 1000));

	var dd = fecha_actual.getDate();
	var dd_anterior = fecha_anterior.getDate();

	var mm = fecha_actual.getMonth()+1;
	var mm_anterior = fecha_anterior.getMonth()+1;
	if(dd<10) {
    	dd='0'+dd;
	} 
	if(dd_anterior<10) {
    	dd_anterior='0'+dd_anterior;
	} 

	if(mm<10) {
	    mm='0'+mm;
	} 

	if(mm_anterior<10) {
	    mm_anterior='0'+mm_anterior;
	} 


	//var fecha_actual = new Date('December 25, 2005 23:15:00');
	var yyyy = fecha_actual.getFullYear();
	var yyyy_anterior = fecha_anterior.getFullYear();
	
	var fecha_formateada = dd+mm+yyyy;		

	var fecha_ayer = yyyy_anterior+'/'+mm_anterior+'/'+dd_anterior;
	var fecha_hoy = dd+'/'+mm+'/'+yyyy;	

	var fecha_hoy_uno = dd+'/'+mm+'/'+yyyy;	


 	jQuery('.fecha').datepicker({ format: 'dd-mm-yyyy'});





	//fecha
				  

	jQuery('.fecha_general').daterangepicker(
		  { 
	    locale: { cancelLabel: 'Cancelar',
	    		  applyLabel: 'Aceptar',
	    		  fromLabel : 'Desde',
	    		  toLabel: 'Hasta',
	    		  monthNames : "ene._feb._mar_abr._may_jun_jul._ago_sep._oct._nov._dec.".split("_"),
	    		  daysOfWeek: "Do_Lu_Ma_Mi_Ju_Vi_Sa".split("_"),
	     } , 
	    separator: ' / ',
	    format: 'DD-MM-YYYY',
	    //startDate: fecha_hoy, //'2014/09/01',
	    //endDate: fecha_hoy //'2014/12/31'
	  }
	);

	jQuery('.fecha_general').on('apply.daterangepicker', function(ev, picker) {
		comienzo=true; //para indicar que start comience en 0;
		var oTable =jQuery('#tabla_general').dataTable();
		oTable._fnAjaxUpdate();

	});
									




	jQuery('#modalMessage').on('hide.bs.modal', function(e) {
	    jQuery(this).removeData('bs.modal');
	});	



//equipos

//gestion de usuarios (crear, editar y eliminar usuarios )
	jQuery('body').on('submit','#form_catalogos', function (e) {
		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);
		jQuery(this).ajaxSubmit({
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				

				}else{
  							$catalogo = e.target.name;
							spinner.stop();
							jQuery('#foo').css('display','none');
							window.location.href = '/'+$catalogo;	
				}
			} 
		});
		return false;
	});	



	jQuery('#tabla_cat_equipos').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "procesando_cat_equipos",
	         		"type": "POST",
	         		
	     },   

		"language": {  //tratamiento de lenguaje
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"zeroRecords": "No hay registros",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
			"emptyTable":     "No hay registros",
			"infoPostFix":    "",
			"thousands":      ",",
			"loadingRecords": "Leyendo...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Último",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": Activando para ordenar columnas ascendentes",
				"sortDescending": ": Activando para ordenar columnas descendentes"
			},
		},


		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1];
		                },
		                "targets": [0] //,2,3,4
		            },

			    

		            {
		                "render": function ( data, type, row ) {

						texto='<td>';
							texto+='<a href="editar_equipo/'+(row[0])+'" type="button"'; 
							texto+=' class="btn btn-warning btn-sm btn-block" >';
								texto+=' <span class="glyphicon glyphicon-edit"></span>';
							texto+=' </a>';
						texto+='</td>';


							return texto;	
		                },
		                "targets": 1
		            },

		            
		            {
		                "render": function ( data, type, row ) {

		                	if (row[2]==0) {
	   							texto='	<td>';								
									texto+=' <a href="eliminar_equipo/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
									texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
									texto+=' <span class="glyphicon glyphicon-remove"></span>';
									texto+=' </a>';
								texto+=' </td>';	
		                	} else {
	   							texto='	<fieldset disabled> <td>';								
									texto+=' <a href="#"'; 
									texto+=' class="btn btn-danger btn-sm btn-block">';
									texto+=' <span class="glyphicon glyphicon-remove"></span>';
									texto+=' </a>';
								texto+=' </td></fieldset>';	
	                		
		                	}
									


							return texto;	
		                },
		                "targets": 2
		            },
		           
		            
		        ],
	});	



jQuery('#tabla_cat_tecnicos').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "procesando_cat_tecnicos",
	         		"type": "POST",
	         		
	     },   

		"language": {  //tratamiento de lenguaje
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"zeroRecords": "No hay registros",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
			"emptyTable":     "No hay registros",
			"infoPostFix":    "",
			"thousands":      ",",
			"loadingRecords": "Leyendo...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Último",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": Activando para ordenar columnas ascendentes",
				"sortDescending": ": Activando para ordenar columnas descendentes"
			},
		},


		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1];
		                },
		                "targets": [0] //,2,3,4
		            },

			    

		            {
		                "render": function ( data, type, row ) {

						texto='<td>';
							texto+='<a href="editar_tecnico/'+(row[0])+'" type="button"'; 
							texto+=' class="btn btn-warning btn-sm btn-block" >';
								texto+=' <span class="glyphicon glyphicon-edit"></span>';
							texto+=' </a>';
						texto+='</td>';


							return texto;	
		                },
		                "targets": 1
		            },

		            
		            {
		                "render": function ( data, type, row ) {

		                	if (row[2]==0) {
	   							texto='	<td>';								
									texto+=' <a href="eliminar_tecnico/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
									texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
									texto+=' <span class="glyphicon glyphicon-remove"></span>';
									texto+=' </a>';
								texto+=' </td>';	
		                	} else {
	   							texto='	<fieldset disabled> <td>';								
									texto+=' <a href="#"'; 
									texto+=' class="btn btn-danger btn-sm btn-block">';
									texto+=' <span class="glyphicon glyphicon-remove"></span>';
									texto+=' </a>';
								texto+=' </td></fieldset>';	
	                		
		                	}
									


							return texto;	
		                },
		                "targets": 2
		            },
		           
		            
		        ],
	});	




jQuery('#tabla_cat_estatus').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "procesando_cat_estatus",
              "type": "POST",
              
       },   

    "language": {  //tratamiento de lenguaje
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No hay registros",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "No hay registros disponibles",
      "infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
      "emptyTable":     "No hay registros",
      "infoPostFix":    "",
      "thousands":      ",",
      "loadingRecords": "Leyendo...",
      "processing":     "Procesando...",
      "search":         "Buscar:",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
      },
      "aria": {
        "sortAscending":  ": Activando para ordenar columnas ascendentes",
        "sortDescending": ": Activando para ordenar columnas descendentes"
      },
    },


    "columnDefs": [
            
            { 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //,2,3,4
                },

          

                {
                    "render": function ( data, type, row ) {

            texto='<td>';
              texto+='<a href="editar_estatu/'+(row[0])+'" type="button"'; 
              texto+=' class="btn btn-warning btn-sm btn-block" >';
                texto+=' <span class="glyphicon glyphicon-edit"></span>';
              texto+=' </a>';
            texto+='</td>';


              return texto; 
                    },
                    "targets": 1
                },

                
                {
                    "render": function ( data, type, row ) {

                      if (row[2]==0) {
                  texto=' <td>';                
                  texto+=' <a href="eliminar_estatu/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
                  texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
                  texto+=' </a>';
                texto+=' </td>';  
                      } else {
                  texto=' <fieldset disabled> <td>';                
                  texto+=' <a href="#"'; 
                  texto+=' class="btn btn-danger btn-sm btn-block">';
                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
                  texto+=' </a>';
                texto+=' </td></fieldset>'; 
                      
                      }
                  


              return texto; 
                    },
                    "targets": 2
                },
               
                
            ],
  }); 








});



