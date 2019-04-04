var app={
	alert:function (text,color) {
		if (text==undefined) {text="pasa algo";}
		if (color==undefined) {color="blue";}
		Materialize.toast(text,3000,color);
	},
	send:function(data){
		a=false;
		if (data!=undefined) {
			a=true;
			try{$.ajax(data);}catch(e){console.log(e);a=false;}
		}
		return a;
	},
	btnL:function (btn) {
	   	btn.attr('disabled', true);
	   	btn.html('<i class="fa fa-spinner fa-spin"></i> Realizando');
	},
	btnR:function (btn,content) {
	   	btn.attr('disabled', false);
	   	btn.html(content);
	},
	reload:function(){window.location.reload();},
	salir:function (btn) {
		if (btn==undefined) {btn=$("#algo");}
		b=btn.html();
		data={
			url:'../Controller/peticiones.php',
			type:'post',
			data:{'dir':'salir'},
			beforeSend:function(){
				app.btnL(btn);
			},
			success:function(dat){
				btn.html(b);
				if (dat==1) {
					app.alert('La sesión fue cerrada','green');
					setTimeout(app.reload(), 2000);
				}else{
					app.alert('Error al cerrar la sesión','red');
				}
			},
			error:function (a,b,c) {
				app.alert('Error, intente mas tarde','red lighten-1');
			}
		};
		app.send(data);
	},
	controller:'./Inicio/',
	view:function (title,url,contenedor,titlec,load,datos) {
		if (title==undefined) {title="Titulo no especificado";}
		if (url==undefined) {title="No se puede realiar, no hay dirección a buscar";}
		if (contenedor==undefined) {contenedor=$("#contenido_vista");}
		if (titlec==undefined) {titlec=$("#titulo_vista");}
		if (load==undefined) {load=$("#loader_vista");}
		if (datos==undefined) {datos={};}
		titlec.html(title);
		contenedor.addClass('hide');
		load.removeClass('hide');
		data={
			url:app.controller+url,
			type:'post',
			data:datos,
			success:function (re) {
				contenedor.html(re);
				load.addClass('hide');
				contenedor.removeClass('hide');
			},
			error:function (a,b,c) {
				contenedor.html(app.error);
				setTimeout(function() {load.addClass('hide');contenedor.removeClass('hide');}, 1000);
				
			}
		};
		app.send(data);
	},
	/**Lista de Mensajes para las respuestas**/
	nodisponible:'<i class="t-red">Respuesta no disponible, intente más tarde</i>.',
	error:'<span class="t-red">Ha ocurrido un error, intente más tarde.</span>',
	loading:'<div class="preManin"><div class="preloader-wrapper big active"><div class="spinner-layer spinner-green-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div></div>',
	loadEl:function(urlp,panel){
		$('#'+panel).html(app.loading);
		datos={
			url:'../Controller/peticiones.php',
			data:{'dir':urlp},
			type:'post',
			success:function(req){
				setTimeout(function() {$('#'+panel).html(req);}, 200);
				
			},
			error:function(){
				setTimeout(function() {$('#'+panel).html('Ocurrio un error');}, 300);
				
			}
		};
		app.send(datos);
	},
	detalles:function (panel,param,file) {
		if (file) {}else{file='detalles.php';}
		if (param) {
			$('#'+panel).html(app.loading);
			datos={
				url:'../Controller/'+file,
				data:param,
				type:'post',
				success:function(req){
					setTimeout(function() {
						$('#'+panel).html(req);
						Materialize.updateTextFields();
						$('select').material_select()
					}, 200);
				},
				error:function(){
					setTimeout(function() {$('#'+panel).html('Ocurrio un error');}, 300);
					
				}
			};
			app.send(datos);
		}
	},
	changePas:function(){
		psa=$("#paswordant").val();
		psn=$("#paswordnue").val();
		bt=$("#savePasBT");
		var bts=bt.html();
		app.btnL(bt);
		datos={
				url:'../Controller/guardar.php',
				data:{psa:psa,psn:psn,dir:'password'},
				type:'post',
				success:function(req){
					app.btnR(bt,bts);
					if(req==1){
						app.alert('Contraseña guardada','green');
						$("#paswordant").val('');
						$("#paswordnue").val('');
						Materialize.updateTextFields();
					}else{
						app.alert(req,'red');
					}
				},
				error:function(){
					app.btnR(bt,bts);
					setTimeout(function() {$('#'+panel).html('Ocurrio un error');}, 300);
					
				}
			};
			app.send(datos);
	}
};
$(document).ready(function() {
	setTimeout(function() {$('.pre').fadeOut();}, 1000);
	$(".tab").click(function(event) {
		url=$(this).data('get');
		if (url) {
			app.loadEl(url,url);
		}		
	});
});