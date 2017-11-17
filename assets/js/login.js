$(document).ready(function(){
    
    
    let nom_domaine = "http://localhost:8080/";

    
    $("#form").submit(function(e){
        
        let form = $('#form');
        
        console.log($('input[name=email]').val());
        console.log($('input[name=password]').val());
        var data = {
            
            "email":$('input[name=email]').val(),
            "password":$('input[name=password]').val()
        }
        
        e.preventDefault();
                            $.ajax({
                            url: nom_domaine+"congres/verifylogin.php",
                            type: 'POST',
                            data:data,
                            success: function (data) {
                                let newdata = data;
                                console.log(data.role);
                                if(data.message=="ko"){
                                    $('#error_message').append('<span style="color:red;margin-bottom:2%;display:block;border: 1px solid red;text-align:center">login ou password incorrect !!!!</span>');
                                }
                                
                                else{
                                    
                                    $.ajax({
                                            url: nom_domaine+"congres/createsession.php",
                                            type: 'POST',
                                            data:newdata,
                                            success: function (data) {
                                                 console.log(data);
                                            }
                                        
                                        
                                    });
                                    
                                    
                                    if(data.role=="admin"){
                                        
                                        document.location.href="admin.php";
                                        
                                    }
                                    
                                     else if(data.role=="participant"){
                                        
                                        document.location.href="participant.php";
                                        
                                    }
                                    
                                    else{
                                    
                                        document.location.href="reviseur.php";

                                        
                                    }
                                    
                                   
                               
                                    
                                }
                            },      
                    });            
        
        
    })
})