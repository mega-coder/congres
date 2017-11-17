$(document).ready(function(){
   
    $("#form").submit(function(e){
        e.preventDefault();
        let periode =$("#periode").val();
        participants=$(".activite");
        let activites ="";
        for(let i=0;i<participants.length;i++)
            {
                if(participants[i].checked == true){
                    activites=activites+participants[i].value+",";
                }
            }
        
        participant={
            'periode' : periode,
            'activites' : activites        
        }
        
        $.ajax({
            url:'/congres/sejour.php',
            type:'POST',
            data:participant,
            success:function(){                
                console.log('success');
                $("#attestation").css('display',"block");
                $("#form").css('display','none');
                $('#x').append('<div style="color:green;margin-top:15%;border:1px solid green;padding:1% 3%">données enregistrées avec succes!!!!</div>'); 

            }
            
        });
    });  
});