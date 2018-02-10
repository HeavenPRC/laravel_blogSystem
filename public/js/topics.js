var boostag_id, csrf_token;

$(document).ready(function(){
   $('#tag').change(function(){
   	   boostag_id = this.value;
   	   csrf_token = $("meta[name='csrf-token']").attr('content');
   	   $.ajax({
   	   		type:'get',
   	   		url:'boostags/'+boostag_id,
   	   		dataType:'json',
   	   		data:'',
   	   		success:function(data){
   	   			alert(data);
   	   		},
   	   		error:function(){
   	   			alert('网络异常');
   	   		}
   	   }
   	   );
   });
});