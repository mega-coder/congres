$(document).ready(function(){
    
    
    let nom_domaine = "http://localhost:8080/";

   
    $('.edit').click(function(){
        
     td = $(this).parent().parent();
     td.find('div').css('display','none'); 
     td.find('select').css('display','block');
        
    });
    
    
    $('.change').change(function(){
       id=$(this).parent().parent().find('input[type=checkbox]').val();
       theme=$(this).val();
        data = {
            id:id,
            theme:theme
        };
        
        $.ajax({
                    url: nom_domaine+"congres/changetheme.php",
                    type: 'POST',
                    data:data,
                    success: function (data) {
                        console.log("success");
                    }
            });
            


       $(this).parent().find('div').css('display','block').find('img').remove();
       $(this).parent().find('div').find('span').text(theme);
       $(this).remove();
        
        
                        });
    
    $('#all').click(function(){
        
       console.log("***************");
        ids=[];
        participants=$('.participant');
        for(let i=0;i<participants.length;i++){
            if(participants[i].checked){
                email =$("#"+i).find('.email').text();
                participant={
                    'email':email,
                    'id':participants[i].value  
                }
                ids.push(participant);
            }
        }
        
        
        
        
            data={
                'ids':ids            
            }
        
            
     if(ids.length>0)
        {
        
      $.ajax({
                    url: nom_domaine+"congres/valider.php",
                    type: 'POST',
                    data:data,
                    dataType:'html',
                    success: function (data) {
                        $("#table").html(data); 
                    }   
            });
            
        }
                   
    });
    
    
    
    
    $('#status').change(function(){
        status =$(this).val();
        let data={'status':status};
        if(status !="0"){
            
              $.ajax({
                    url: nom_domaine+"congres/filtrer.php",
                    type:'POST',
                    data:data,
                    dataType: 'html',
                    success:function (data) {
                        
                        console.log($(".edit").length); 
                        if(status == "en cours"){
                            $("#all").css('display',"block");
                        }
                        
                        else{
                            $("#all").css('display',"none");

                        }
                        $("#table").html(data); 
                    }
            });                        
        }
    });
  
        
        
});
    
 
