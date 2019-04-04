var admin={
	wer:'',
	empresas:function () {
		$("#oterViews").fadeIn();
		app.detalles('oterViewContent',{dir:'empresas'},'peticiones.php');
	},
	categorias:function(){
		$("#oterViews").fadeIn();
		app.detalles('oterViewContent',{dir:'categorias'},'peticiones.php');
	},
	cerrarOterView:function () {
		$("#oterViews").fadeOut();
	}
	
};
$(document).ready(function(){
	$(".button-collapse").sideNav({
      menuWidth: 300, // Default is 300
      edge: 'left', // Choose the horizontal origin
      closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
      draggable: true});
	

});