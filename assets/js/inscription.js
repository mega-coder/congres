$(document).ready(function(){
    
    
           

    
    let nom_domaine = "http://localhost:8080/";
    
    let countries = [];
    
    
    $("form#form").submit(function(event){
        
        
        event.preventDefault();
        let form =this; 
        $.get(nom_domaine+"congres/verifyMail.php?email="+$("#e").val(),function(data){
                
                    if(data.message == "ok"){
                        
                         $("#message").text("Cet email existe déja").css("color","red");
                         $('#e').css("border","1px solid red");
                    }
                    else{
                            $("#telephonee").val("00"+$("#code").text()+$("#telephonee").val());
                            var formData = new FormData(form);
                            $.ajax({
                            url: "inscription.php",
                            type: 'POST',
                            data: formData,
                            success: function (data) {
                                console.log(data);
                                $("#form")[0].reset();
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                                
                                
                        });            

                    }
                    
                                        
    });
        
        
    return false;
                    
    });
    
    
    
    
    $.get('http://ip-api.com/json',function(data){
        
            
        let country = data.country;
        $.ajax({
            
                type: 'GET',
                crossDomain: true, 
                url:"https://restcountries.eu/rest/v2/all",
                success:function(data){
                    countries = data;
                    for(let i=0;i<countries.length;i++){
                        
                        if(countries[i]['name']==country)
                        {
                               $('#countries').append("<option value='"+data[i]['name']+"' selected>"+data[i]['name']+"</option>")
                               $('#telephone img').attr({'src':countries[i]['flag']});
                               $('#telephone span').text(countries[i]['callingCodes']); 
                            
                        }
                        
                        
                         else{
                               $('#countries').append("<option value='"+data[i]['name']+"'>"+data[i]['name']+"</option>")
                    }

                }
                }
            
        });
        
        
    });
    
    
    $('#e').keyup(function(){
            
          let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        
          let message = $("#message");
          if(!(re.test($(this).val()))){
              
              message.text("Le format de l'email est incorrect").css("color","red");
              $('#e').css('border','1px solid red');
              
          }
        
        else{       
            $.get(nom_domaine+"congres/verifyMail.php?email="+$(this).val(),function(data){
                
                    if(data.message == "ok"){
                        
                         message.text("Cet email existe déja").css("color","red");
                         $('#e').css("border","1px solid red");
                    }
                    else{
                       
                    $('#e').css("border","1px solid green");
                    message.text("");

                    }
                
            });            
        }
        
    });
    
    $('input[type=radio]').click(function(){
        
        if($("#x").is(':checked')){ 
            
           $('.avec_support').css("display","block");
           $('#formulaire').attr("required",true);
           $('#type').attr("required",true);
           $('#theme').attr("required",true);
           $('#grade').attr("required",true);
           $('.avec_support input[type=text]').attr("required",true);
        }
        
        else{
           $('.avec_support').css("display","none");
           $('#formulaire').removeAttr("required");
           $('#type').removeAttr("required");
           $('#theme').removeAttr("required");
           $('#grade').removeAttr("required");
           $('.avec_support input[type=text]').removeAttr("required");
        }
        
    })
    
    
    $('#countries').change(function(){
                           
            for(let i=0;i<countries.length;i++){
                
                if(countries[i]['name'] == $(this).val()){
                
                        $('#telephone img').attr({'src':countries[i]['flag']});
                        $('#telephone span').text(countries[i]['callingCodes']); 
                    }
            }
            
            
        
    });
    
    

        
     

    
    
 
});






