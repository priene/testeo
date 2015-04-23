$(document).ready(function() {	

	


	// Background Nosotros

	if($("#nosotros").length > 0){
		$("body").css("background","#AB1E22");
		$("footer").css({"position":"fixed","bottom":"0","left":"0"});
	}else{
		$("body").css("background","#201D19");
		$("footer").css({"position":"unset","bottom":"0","left":"0"});
	}

	if($(".users").length > 0){
		//$("footer").css({"position":"fixed","bottom":"0","left":"0"});
		$("footer").hide();
	}

	// Menu activo

	if ($(".agenda").length > 0 ||$(".menulogin").length > 0)
	{
	   $("nav ul li:nth-child(1)").addClass("active");
	}
	else if ($("#nosotros").length > 0 || $("#ingresar-fecha").length > 0)
	{
	   $("nav ul li:nth-child(2)").addClass("active");
	}
	else if ($("#calendario").length > 0 || $("#ingresar-fecha").length > 0 || $("#ingresar-banda").length > 0)
	{
	   $("nav ul li:nth-child(3)").addClass("active");
	}
	else if ($("#ingresar-lugar").length > 0)
	{
	   $("nav ul li:nth-child(4)").addClass("active");
	}
	else if ($("#ingresar-genero").length > 0)
	{
	   $("nav ul li:nth-child(5)").addClass("active");
	}


	$(document).scroll(function () {
    var y = $(this).scrollTop();

    //alert($(this).scrollTop("#banda3").position().top);

    if (y > 200) {
        $('#bandas > div:nth-of-type(1) > div:nth-of-type(1)').fadeOut(); 
    } else {
        $('#bandas > div:nth-of-type(1) > div:nth-of-type(1)').fadeIn(); 
    }

    if (y > 500 && y < 1000) {
        $('#bandas > div:nth-of-type(2) > div:nth-of-type(1)').fadeIn(); 
    } else {
        $('#bandas > div:nth-of-type(2) > div:nth-of-type(1)').fadeOut(); 
    }

    if (y > 1100) {
        $('#bandas > div:nth-of-type(3) > div:nth-of-type(1)').fadeIn();
    } else {
        $('#bandas > div:nth-of-type(3) > div:nth-of-type(1)').fadeOut(); 
    }

	});


	$(document).on("click","[name=banda]",function(e){
		
		var inp = $(this).attr("id");
		$("#" + inp).autocomplete({
			source: function (request, response){
		        $.ajax({
			            url: "Home/buscar_banda",
			            dataType: "json",
			            data:
			            {
			                term: request.term,
			            },
			            success: function (data)
			            {            	
		        			response($.map(data, function (item) {
                                return {
                            		idbn: item.idbanda,
                                    value: item.nombre
		                        }
		                    }));
			            }
		        });
		    },
		    select: function( event, ui ) {

				$(this).attr('data-idbn',"bn" + ui.item.idbn);
				$(this).val(ui.item.value);
				return false;
			}
		});
	});
	



	$(".addbanda").click(function(){
		
		var idbn = $(this).prev().attr("data-idbn");
		if ($(this).prev().val() != ""){
			$(this).next().show();
			$(this).next().children().show();
			$(this).next().children().children("tbody").append("<tr class='" + idbn + "'><td>" + $(this).prev().val() + "</td><td><a href='javascript:void(0);'>Eliminar</a></td></tr>");	
		}
		$(this).prev().val("");
	});

	$(".listabandas").on("click","a",function(){
		$(this).parent().parent().remove();
		if($(".listabandas tbody").html() == '')
			$(".listabandas").hide();
	});


	$(".tieneslider").click(function(){
		if($(this).prop('checked')){
			$(".imgslider-input").show();
			$(".posicion-slide-input").show();
		}else{
			$(".imgslider-input").hide();
			$(".posicion-slide-input").hide();
		}
	});


	// Ingresar Banda

	$(".showing").click(function(){
		$(".validar").trigger("reset");
		$(".msjinsertar").html("");
		if ($(this).html() == 'Ingresar Fecha'){
			$("#tablabandasing tbody").html("");
			$("#tablabandasmod tbody").html("");
			$("#tablabandasing").hide();
			$(".ing .imgslider-input").hide();
			$(".ing .posicion-slide-input").hide();
			$('.ing .tieneslider').prop('checked', false);
		}
		if ($(this).html() == 'Ingresar Banda'){
			$(".mod .contac2").hide();
			$(".ing .urlmedia").prop('disabled',true);
		}
		$(".busc").hide();
		$(".mod").hide();
		$(".ing").show();
	});

	$(".showbusc").click(function(){
		$(".validar_buscar").trigger("reset");

		if ($(this).html() == 'Buscar Fecha'){
			$("#tablabandasing tbody").html("");
			$("#tablabandasmod tbody").html("");
		}

		if ($(this).html() == 'Buscar Banda'){
			$("#validar_buscar_banda select[name='criterio']").val("");
			$(".bbc").html('<input type="text" id="ingresar-banda-buscar" value="" name="buscar" class="form-control">');
		}

		$(".ing").hide();
		$(".mod").hide();
		$(".resul").hide();
		$(".busc").show();

		if ($(".validar").attr("id") == 'validar_ingresar_genero'){

			$.ajax({
				url: "home/buscar_genero",
				type: "post",
				dataType: "json",
	          }).done(function(data) {


	    		$(".busc tbody").html("");
	          	$.each(data.genero, function(key, val) {
					$(".busc tbody").append("<tr class='gen" + val.id + "'><td>" + val.nombre + "</td><td><a class='modi' href='modificar_genero/" + val.id + "'>Editar</a></td><td><a class='elim' href='home/eliminar/genero/" + val.id + "'>Borrar</a></td></tr>");
				});

			}, 'json');

			return false;

		}

	});

	
	$(document).on("click",".modi",function(e){
		e.preventDefault();

		$(".msjinsertar").html("");
		var a = $(this).attr("href");
		var quees = a.split('/')[0];
		
		$.ajax({
		url: a,
		type: "post",
		dataType: "json",
		}).done(function(data) {
			if (quees == 'modificar_genero'){
				$("#idgenero").val(data.genero[0].id);
				$("#modificar-genero-nombre").val(data.genero[0].nombre);
			}
			else if (quees == 'modificar_lugar'){
				$("#idlugar").val(data.lugar[0].id);
				$("#modificar-lugar-nombre").val(data.lugar[0].nombre);
				$("#modificar-lugar-direccion").val(data.lugar[0].direccion);
				$("#modificar-lugar-telefono").val(data.lugar[0].telefono);
				$("#modificar-lugar-email").val(data.lugar[0].email);
				$("#modificar-lugar-nombre-contacto").val(data.lugar[0].nombre_contacto);
			}
			else if (quees == 'modificar_banda'){
				limpiar_form_modbanda();
				$("#idbanda").val(data.banda[0].bid);
				$("#modificar-banda-nombre").val(data.banda[0].bannom);
				$("#modificar-banda-nombre-contacto").val(data.contacto[0].nombre);
				$("#modificar-banda-tel-contacto").val(data.contacto[0].telefono);
				$("#modificar-banda-contacto").val(data.contacto[0].contacto);
				if(data.contacto[1] != undefined){
					$(".otrocontacto").trigger("change");
					$(".otrocontacto[value=si]").prop('checked', true);
					$("#modificar-banda-nombre-contacto2").val(data.contacto[1].nombre);
					$("#modificar-banda-tel-contacto2").val(data.contacto[1].telefono);
					$("#modificar-banda-contacto2").val(data.contacto[1].contacto);
				}

				if(data.media[0] != undefined){

					$.each(data.media,function(key,value){
						switch(value.media){
							case "1":
								$(".radiomedia[name='swradio']").trigger("change");
								$(".radiomedia[name='swradio']").prop('checked', true);
								$("#modificar-banda-sitioweb").val(value.url);	
							break;
							case "2":
								$(".radiomedia[name='scradio']").trigger("change");
								$(".radiomedia[name='scradio']").prop('checked', true);
								$("#modificar-banda-soundcloud").val(value.url);	
							break;
							case "3":
								$(".radiomedia[name='bcradio']").trigger("change");
								$(".radiomedia[name='bcradio']").prop('checked', true);
								$("#modificar-banda-bandcamp").val(value.url);	
							break;
							case "4":
								$(".radiomedia[name='ytradio']").trigger("change");
								$(".radiomedia[name='ytradio']").prop('checked', true);
								$("#modificar-banda-youtube").val(value.url);	
							break;
						}
					});
				}
				$("#modificar-banda-genero option[value=" + data.banda[0].id_genero + "]").prop('selected', true);
				$("#modificar-banda-pais option[value=" + data.banda[0].id_pais + "]").prop('selected', true);
				$("#modificar-banda-provincia option[value=" + data.banda[0].id_provincia + "]").prop('selected', true);
				

				$(".mod .lcl").html("<select name='localidad' class='form-control'></select>");
				$.each(data.localidades, function(key,value) {	
					$(".mod .lcl select").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
					if(value.id == data.banda[0].id_localidad)
						$(".mod .lcl option[value=" + data.banda[0].id_localidad + "]").prop('selected', true);
					$(".mod .localidad-input").show();
				});

					
        			
    				
				

				$(".modificar-banda-convocatoria[value=" + data.banda[0].id_convocatoria + "]").prop('checked', true);
				$(".modificar-banda-turno[value=" + data.banda[0].id_turno + "]").prop('checked', true);
				$(".modificar-banda-estado[value=" + data.banda[0].id_estado + "]").prop('checked', true);
			}
			else if (quees == 'modificar_fecha'){

				$(".mod #userfile").hide();
				$(".mod #imgslider").hide();

				$(".mod .eliminarimagen").prev().show();
				$(".mod .eliminarimagen").show();

				$('.mod .msjinsertarfecha').html("");

				$("#idfecha").val(data.fech[0].fid);
				$("#modificar-fecha-nombre").val(data.fech[0].nombre);
				$(".listabandas").show();	
				$.each(data.bandas, function(key, val) {
					$(".listabandas tbody").append("<tr class='bn" + val.id_banda + "'><td>" + val.nombre + "</td><td><a href='javascript:void(0);'>Eliminar</a></td></tr>");	
				});
				$("#modificar-fecha-fecha").val(data.fech[0].dia);
				$("#modificar-fecha-hora").val(data.fech[0].hora.slice(0,-3));

				if (data.env == 'development')
					var rutaimgs = "http://localhost/ranas2/assets/img/";
				else
					var rutaimgs = "http://www.ranasrojas.com.ar/assets/img"; //Esto va en PRD

				$("#userfileimg").attr("src",rutaimgs + "calimgs/" + data.fech[0].fimagen);

				if(data.fech[0].simagen != undefined){
					$('.mod .tieneslider').prop('checked', true);
					$("#cargadoslider").val(data.fech[0].simagen);
					$(".imgslider-input").show();
					$(".posicion-slide-input").show();
					$("#userfileimgslider").attr("src",rutaimgs + "sliderthumbs/" + data.fech[0].simagen);
					$("#userfileimgslider").show();
				}else{
					$("#eliminarimagenslider").trigger("click");
					$("#modificar_fecha_posicion option[value='']").prop('selected', true);
					$(".mod .imgslider-input").hide();
					$(".mod .posicion-slide-input").hide();
					$('.mod .tieneslider').prop('checked', false);


				}

				$("#modificar_fecha_lugar option[value=" + data.fech[0].id_lugar + "]").prop('selected', true);

				$("#modificar_fecha_posicion option[value=" + data.fech[0].sid + "]").prop('selected', true);

				$("#cargado").val(data.fech[0].fimagen);
				
			}
			$(".busc").hide();
			$(".mod").show();

	}, 'json');

		

	});	


	$(document).on("click",".elim",function(e){

		e.preventDefault();

		var a = $(this).attr("href");

		$(".respuesta").remove();	
		$(".pregunta").show();
		$(".btn1").show();
		$(".btn2").hide();			

		$("#dialog-confirm").dialog({
			resizable: false,
			height:300,
			modal: true,
			buttons: {
				"Eliminar registro": {
					text: 'Eliminar registro',
					class: 'btnelim btn1',
					click: function() {
					$.ajax({
						url: a,
						type: "post",
						dataType: "json",
						}).done(function(data) {
							$(".pregunta").hide();
							$(".btn1").hide();	
							$("#dialog-confirm").append("<p class='respuesta'>" + data.mensaje + "</p>");
							$(".btn2").show();	
					}, 'json');
					}
				},
				"Cancelar": {
					text: 'Cancelar',
					class: 'btncanc btn1',
					click: function() {
						$(this).dialog("close");
					}
				},
				"Cerrar": {
					text: 'Cerrar',
					class: 'btncerrar btn2',
					click: function() {
						$(this).dialog("close");
						$(".showbusc").trigger("click");
					}
				}
			}
		});
	});


	$('#validar_ingresar_fecha').submit(function(){

		var id = "";
		var ids = "";
		$(".listabandas tbody tr").each(function(){
			id = $(this).attr("class").replace("bn","");
			ids = ids + id + ",";
		});
		ids = ids.slice(0,-1);
		$(".idsbandas").val(ids);

		var form = $('#validar_ingresar_fecha');

		var formData = new FormData(form[0]);

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			dataType: "json",
			mimeType: "multipart/form-data",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
          }).done(function(data) {

          	$(".error").remove();
          	
           if(data.st == false){
           		
           		$('.msjinsertarfecha').html("");

				if(data.errors != undefined){
					$.each(data.errors, function(key, val) {
						$('[name="'+ key +'"]', form).after(val);
					});
				}

				if($("#tablabandasing .listabandas tbody").html() == ""){
					$('#tablabandasing .listabandas').after("<div class='error'><p>El campo de ingreso de bandas es obligatorio</p></div>");
				}

				if(data.imgerror != undefined){
				$.each(data.imgerror, function(key, val) {
					$('#userfile').after(val);
				});
				}

				if(data.imgerror2 != undefined){
				$.each(data.imgerror2, function(key, val) {
					$('#imgslider').after(val);
				});
				}

			}else{
				$(".listabandas tbody").html("");
				form.trigger("reset");
				$('.msjinsertarfecha').html("<p>" + data.mensaje + "</p>").hide().slideDown("slow");
			}

		}, 'json');

		return false;		

    });


	$('.validar_modificar_fecha').submit(function(e){

		e.preventDefault();

		var id = "";
		var ids = "";
		$(".mod .listabandas tbody tr").each(function(){
			id = $(this).attr("class").replace("bn","");
			ids = ids + id + ",";
		});
		ids = ids.slice(0,-1);
		$(".mod .idsbandas").val(ids);

		var form = $('.validar_modificar_fecha');

		var formData = new FormData(form[0]);

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			dataType: "json",
			mimeType: "multipart/form-data",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
          }).done(function(data) {

          	$(".error").remove();
          	
           if(data.st == false){
           		
           		$('.mod .msjinsertarfecha').html("");

				if(data.errors != undefined){
					$.each(data.errors, function(key, val) {
						$('[name="'+ key +'"]', form).after(val);
					});
				}

				if($("#tablabandasmod .listabandas tbody").html() == ""){
					$('#tablabandasmod .listabandas').after("<div class='error'><p>El campo de ingreso de bandas es obligatorio</p></div>");
				}

				if(data.imgerror != undefined){
				$.each(data.imgerror, function(key, val) {
					$('.mod #userfile').after(val);
				});
				}

				if(data.imgerror2 != undefined){
				$.each(data.imgerror2, function(key, val) {
					$('.mod #imgslider').after(val);
				});
				}

			}else{
				//$(".mod .listabandas tbody").html("");
				//form.trigger("reset");
				$('.mod .msjinsertarfecha').html("<p>" + data.mensaje + "</p>").hide().slideDown("slow");
			}

		}, 'json');

		return false;		

    });



    $('.validar_modificar').submit(function(e){

		e.preventDefault();

		var form = $(this);

		$.ajax({
           url: form.attr('action'),
           type: form.attr('method'),
           dataType: "json",
           data: form.serialize(),
          }).done(function(data) {
          	
           if(data.st == false){
			
				$(".error").remove();

				$.each(data.errors, function(key, val) {
					$('[name="'+ key +'"]', form).after(val);
					
				});
			}else{
				$('.msjinsertar').html("<p>" + data.mensaje + "</p>").hide().slideDown("slow");
			}

		}, 'json');

		return false;		

    });

    // Valida el ingreso de Banda, Lugar y Genero
    $('.validar').submit(function(e){

    	e.preventDefault();

		var form = $(this);
		$.ajax({
           url: form.attr('action'),
           type: form.attr('method'),
           dataType: "json",
           data: form.serialize(),
          }).done(function(data) {

          	$(".error").remove();
          	
           if(data.st == false){

				$.each(data.errors, function(key, val) {
					$('[name="'+ key +'"]', form).after(val);
					
				});
			}else{
				if (form.attr('action') == 'http://localhost/ranas2/validar_ingresar_banda'){
					$("#registrobanda form").hide();
					$('.msjinsertar').html("<p>" + data.mensaje + "</p>").hide().slideDown("slow");
				}
				else	
					$('.msjinsertar').html("<p>" + data.mensaje + "</p>").hide().slideDown("slow");
			}

		}, 'json');

		return false;		

    });






	$('.validar_buscar').submit(function(){

		var form = $(this);

		$.ajax({
           url: form.attr('action'),
           type: form.attr('method'),
           dataType: "json",
           data: form.serialize(),
          }).done(function(data) {
          	
           if(data.st == false){
           		
				$(".resul").hide();
				$(".error").remove();

				$.each(data.errors, function(key, val) {
					$('[name="'+ key +'"]', form).after(val);
					
				});
			}else{

				$(".resul tbody").html("");
				var obj = data.resul;
				$(".resul").show();
				if (obj != null){
					$.each(obj, function(key,value) {
						if (form.attr("id") == "validar_buscar_lugar")
							$("#resullugar tbody").append("<tr class='lg" + value.idlugar + "'><td>" + value.nombre + "</td><td>" + value.direccion + "</td><td>" + value.telefono + "</td><td>" + value.email + "</td><td>" + value.contacto + "</td><td><a class='modi' href='modificar_lugar/" + value.idlugar + "'>Editar</a></td><td><a class='elim' href='home/eliminar/lugar/" + value.idlugar + "'>Borrar</a></td></tr>");
						else if (form.attr("id") == "validar_buscar_banda")
							$("#resulbanda tbody").append("<tr class='bn" + value.idbanda + "'><td>" + value.nombre + "</td><td>" + value.genero + "</td><td><a class='verinfo' href='verinfo_banda/" + value.idbanda + "'>Informacion</a><td><a class='modi' href='modificar_banda/" + value.idbanda + "'>Editar</a></td><td><a class='elim' href='home/eliminar/banda/" + value.idbanda + "'>Borrar</a></td></tr>");
						else if (form.attr("id") == "validar_buscar_fecha")
							$("#resulfecha tbody").append("<tr class='bn" + value.idfecha + "'><td>" + value.nombre + "</td><td>" + value.fecha + "</td><td>" + value.hora + "</td><td>" + value.lugar + "</td><td class='verbandas'><a href='javascript:void(0);'>Ver bandas</a></td><td><a class='modi' href='modificar_fecha/" + value.idfecha + "'>Editar</a></td><td><a class='elim' href='home/eliminar/fecha/" + value.idfecha + "'>Borrar</a></td></tr>");
					});
				}
				else{
					$(".resul tbody").html("<tr><td colspan='7'>No se encontraron resultados</td></tr>");
				} 
			}

		}, 'json');

		return false;		

    });


	$("#validar_buscar_banda select[name='criterio']").change(function(){
		var valor = $(this).val();
		switch (valor) {
		    case 'genero':
		    	$(".bbc").html(""); 
		    	$.ajax({
					url: "home/get_select_criterio/genero",
					type: "post",
					dataType: "json",
					}).done(function(data) {
						$(".bbc").append("<select name='buscar' class='form-control'></select>");
						$.each(data.valores, function(key,value) {
							$(".bbc select").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
						});
						
					});
		        
		        break;
		    case 'turno': 
		    	$(".bbc").html(""); 
		    	$.ajax({
					url: "home/get_select_criterio/turno",
					type: "post",
					dataType: "json",
					}).done(function(data) {
						$(".bbc").append("<select name='buscar' class='form-control'></select>");
						$.each(data.valores, function(key,value) {
							$(".bbc select").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
						});
						
					});
		        break;
		    case 'convocatoria': 
		    	$(".bbc").html(""); 
		    	$.ajax({
					url: "home/get_select_criterio/convocatoria",
					type: "post",
					dataType: "json",
					}).done(function(data) {
						$(".bbc").append("<select name='buscar' class='form-control'></select>");
						$.each(data.valores, function(key,value) {
							$(".bbc select").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
						});
						
					});
		        break;     
		    case 'estado': 
		    	$(".bbc").html(""); 
		    	$.ajax({
					url: "home/get_select_criterio/estado",
					type: "post",
					dataType: "json",
					}).done(function(data) {
						$(".bbc").append("<select name='buscar' class='form-control'></select>");
						$.each(data.valores, function(key,value) {
							$(".bbc select").append("<option value='" + value.id + "'>" + value.nombre + "</option>");
						});
						
					});
		        break;
    		    case 'confirmada': 
			    	$(".bbc").html(""); 		    	
					$(".bbc").append("<select name='buscar' class='form-control'><option value='0'>No</option><option value='1'>Si</option></select>");
			        break;
	    	default:
	    		$(".bbc").html('<input type="text" id="ingresar-banda-buscar" value="" name="buscar" class="form-control">');
	    		break;
		}
	});






	$(document).on("click", ".verinfo", function(e){
	
		e.preventDefault();

		$(".dialogcontacto tbody").html("");
		$(".dialogmedia").html("");

		var a = $(this).attr("href");

		$.ajax({
			url: a,
			type: "post",
			dataType: "json",
			}).done(function(data) {	

				

				$("#dialog-confirm2 .dialognombre p").html(data.banda[0].bannom);
				$("#dialog-confirm2 .dialoggenero p").html(data.banda[0].gennom);

				$("#dialog-confirm2 .dialogpais p").html(data.banda[0].paisnombre);
				$("#dialog-confirm2 .dialogprovincia p").html(data.banda[0].provincianombre);
				$("#dialog-confirm2 .dialoglocalidad p").html(data.banda[0].localidadnombre);

				

				if (data.contacto[0] != undefined){
					$.each(data.contacto, function(key,value) {
						$(".dialogcontacto").show();
						$(".dialogcontacto tbody").append("<tr><td>" + value.nombre + "</td><td>" + value.telefono + "</td><td>" + value.contacto + "</td></tr>");
					});
				}else{
					$(".dialogcontacto").hide();
				}

				if (data.media[0] != undefined){
					$.each(data.media, function(key,value) {
						$(".dialogmedia").show();
						$(".dialogmedia").append("<tr><th>" + value.nombre + "</th><td>" + value.url + "</td></tr>");
					});
				}else{
					$(".dialogmedia").hide();
				}

				$("#dialog-confirm2 .dialogturno p").html(data.banda[0].turnom);
				$("#dialog-confirm2 .dialogconvocatoria p").html(data.banda[0].tipo);
				$("#dialog-confirm2 .dialogestado p").html(data.banda[0].estnom);
				if (data.banda[0].confirmada == 1)
					$("#dialog-confirm2 .dialogconfirmada p").html("SI");
				else
					$("#dialog-confirm2 .dialogconfirmada p").html("NO");

				$("#dialog-confirm2").dialog({
					resizable: false,
					height:500,
					width: 500,
					modal: true,
					buttons: {
						"Cerrar": {
							text: 'Cerrar',
							class: 'btncerrar',
							click: function() {
								
								$(this).dialog("close");
								
							}
						}
					}
				});
		});
	});


	$(".calendario_criterio").click(function(e){
		e.preventDefault();

		$.ajax({
           url: $(this).attr("href"),
           type:'post',
           dataType: "json",
          }).done(function(data) {

          	$(".fechascal").html("");
				var obj = data.fecha;
				var rutaimgs = "";
				if (obj != ""){
					$.each(obj, function(key,value) {

						rutaimgs = "http://localhost/ranas2";

						//rutaimgs = "http://www.ranasrojas.com.ar"; //Esto va en PRD

						$(".fechascal").append("<div class='itemcal'><div class='imgitem'><img src='" + rutaimgs + "/assets/img/calimgs/" + value.imagen + "'></div><div class='infoitem'><h2 class='fecbandas'>" + value.nombre + "</h2><p class='fecitem'>" + value.dia + " - " + value.hora + "</p><p class='feclugar'>" + value.lugar + "</p></div></div>");
					});
				}
				else{
					$(".fechascal").html("<p>No se encontraron resultados</p>");
			} 

		}, 'json');

		return false;
	});




	$(".radiomedia").change(function(){
		if ($(this).val() == 'si') {
        	$(this).next().next().prop('disabled', false);
        }
        else{
         	$(this).next().next().next().next().prop('disabled', true); 
        }
	});


	$(".otrocontacto").change(function(){
		if ($(this).val() == 'si') {
			$(".con2").val("");
        	$(".contac2").show();
        }
        else{
         	$(".contac2").hide();
        }
	});

	$("select[name='pais']").change(function(){

		if($(this).val() != '12'){
			$(this).parent().parent().next().hide();
			$(this).parent().parent().next().next().hide();
		}else{
			$(this).parent().parent().next().show();
			$(this).parent().parent().next().next().show();
		}
	});


	$("select[name='provincia']").change(function(){
		
		$.ajax({
			url: 'home/localidades/' + $(this).val(),
			type:'post',
			context: this,
			dataType: "json",
		}).done(function(data) {
			
			$(this).parent().parent().next().children().next().html("<select name='localidad' class='form-control'></select>");
			var pepe = $(this).parent().parent().next().children().next().children();
			pepe.html("");
			$.each(data.localidades, function(key,value) {
				pepe.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
				
			});
			$(this).parent().parent().next().show();

		});
	});

	
	$(document).on("click", ".verbandas", function(e){
		
		e.preventDefault();

		var idbn = $(this).parent().attr("class");
		idbn = idbn.slice(2);

		$.ajax({
			url: "home/ver_bandas/" + idbn,
			type: "post",
			dataType: "json",
          }).done(function(data) {

          	$("#dialog ul").html("");
          	$.each(data.fecbandas, function(key,value) {
				$("#dialog ul").append("<li>" + value.nombre + "</li>");
			});

    		$("#dialog").dialog({
               hide: "puff",
               show : "fold"      
            });

		}, 'json');

		return false;

  });


	$(".mod").on("click", ".eliminarimagen", function(e){
		e.preventDefault();
		$(this).prev().hide();
		$(this).hide();
		if ($(this).attr("id") == 'eliminarimagenevento'){
			$(".mod #userfile").show();
			$("#estacargado").val("1");
		}
		else{
			$(".mod #imgslider").show();
			$("#estacargadoslider").val("1");
		}
	});









	//-------------------------------------------------




	new WOW().init();
	
	$('.flexslider').flexslider({
		animation: "fade",
		directionNav: false,
    	controlNav: false,
    	smoothHeight: true,
    	slideshowSpeed: 5000 
	});


	$(function() {
		$('#da-thumbs .dtli').each(function(){
			$(this).hoverdir();
		});
	});


	$('.parallax').scrolly({bgParallax: true});


	$('#ingresar-fecha-hora').clockpicker({
		autoclose: true
	});

	$('.glyphicon-time').click(function(e){
	    // Have to stop propagation here
	    e.stopPropagation();
	    $('#ingresar-fecha-hora').clockpicker('show')
	            .clockpicker('toggleView', 'hours');
	});



	// DatePicker

	$.datepicker.regional['es'] = {
	closeText: 'Cerrar',
	prevText: '<Ant',
	nextText: 'Sig>',
	currentText: 'Hoy',
	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	weekHeader: 'Sm',
	dateFormat: 'dd/mm/yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
	
	$(function(){
    	$("#ingresar-fecha-fecha").datepicker({
    		dateFormat: "dd-mm-yy"
    	});
  	});


  	$(".animsition").animsition({
	  
	    inClass               :   'fade-in',
	    outClass              :   'fade-out',
	    inDuration            :    1500,
	    outDuration           :    1200,
	    linkElement           :   '.animsition-link',
	    // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
	    loading               :    true,
	    loadingParentElement  :   'body', //animsition wrapper element
	    loadingClass          :   'animsition-loading',
	    unSupportCss          : [ 'animation-duration',
	                              '-webkit-animation-duration',
	                              '-o-animation-duration'
	                            ],
	    //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
	    //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
	    
	    overlay               :   false,
	    
	    overlayClass          :   'animsition-overlay-slide',
	    overlayParentElement  :   'body'
	  });











});



function limpiar_form_modbanda(){
	$("#modificar-banda-tel-contacto").val("");
	$("#modificar-banda-contacto").val("");

	$(".otrocontacto[value=no]").prop('checked', true);
	$(".mod .contac2").hide();
	$("#modificar-banda-nombre-contacto2").val("");
	$("#modificar-banda-tel-contacto2").val("");
	$("#modificar-banda-contacto2").val("");

	$(".radiomedia[name='swradio']").prop('checked', false);
	$(".radiomedia[name='scradio']").prop('checked', false);
	$(".radiomedia[name='bcradio']").prop('checked', false);
	$(".radiomedia[name='ytradio']").prop('checked', false);

	$("#modificar-banda-sitioweb").val("");
	$("#modificar-banda-soundcloud").val("");	
	$("#modificar-banda-bandcamp").val("");	
	$("#modificar-banda-youtube").val("");	
}
