$(document).ready(function() {
        $("#loginForm").submit(function(event) {
          event.preventDefault();
          btn=$("#enviar");
          btn1=btn.html();
          app.btnL(btn);
          $.ajax({
            url:'../Controller/peticiones.php',
            type:'post',
            data:{'dir':'log','usuario':$("#username").val(),'contrasena':$("#pasword").val()},
            success:function(req){
              app.btnR(btn,btn1);
              try {
                r=$.parseJSON(req);
                if(r.error){
                  app.alert(r.msg,'red');
                }else{
                  app.alert(r.msg,'green');
                  setTimeout(function(){window.location.reload();},3000);
                }
              } catch(e) {
                // statements
                console.log(e);
              }
            },
            error:function(){
              app.alert('Erro inesperado','red');
              app.btnR(btn,btn1);
            }
          });
        });
      });