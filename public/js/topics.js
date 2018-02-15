var boostag_id, csrf_token;

$(document).ready(function(){
	csrf_token = $("meta[name='csrf-token']").attr('content');

    $('#tag').change(function(){

   	   boostag_id = this.value;
         $('#zjbtn').attr('disabled', 'true');
   	   $.ajax({
   	   		type:'get',
   	   		url: url,
   	   		dataType:'json',
               data:{
                  'boostag_id':boostag_id
               },
   	   	/*	headers:{
   	   			'X-CSRF-TOKEN':csrf_token
   	   		},*/
   	   		success:function(data){

                  if (data.status == 1) {

                     if (data.datas.length>0) {

                        tag = '<option  selected disabled value="non" >二级标签</option>';


                        data = data.datas;
                        for (i=0; i<data.length; i++) {

                           tag+='<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
                        }
                        $('#tag2').html(tag);
                        $('#tag2').css('display', 'block');
                     } else {
                        $('#tag2').css('display', 'none');
                     }
                     $('#zjbtn').removeAttr('disabled');
                  }
   	   		},
   	   		error:function(){
   	   			alert('网络异常');
   	   		}
   	   });

   });
});