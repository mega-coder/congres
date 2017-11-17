$(document).ready(function(){
    
        
    $('#all').click(function(){
        
       let participants=[];
        
       for(let i=0 ; i<$("tbody tr").length;i++){
           
           if($('input[name=validation'+i+']:checked').val()!=undefined)
               {
                   id=$('input[name=validation'+i+']:checked').parent().attr("id");
                   participant = {
                       'id':id,
                       'commentaire':$("#tr"+i).find('textarea').val(),
                       'validation' :$('input[name=validation'+i+']:checked').val()
                    };
                   participants.push(participant);
               }

       }
        
        
        let data={
            
            'participants':participants
        }
        

        if(participants.length>0){
            
               $.ajax({
                    url:"/congres/validation_reviseur.php",
                    type: 'POST',
                    data:data,
                    success: function (data){
                       // $("#content").html(data);
                        console.log('success');
                    }   
            });
            
        }
        
        
    });
    
});