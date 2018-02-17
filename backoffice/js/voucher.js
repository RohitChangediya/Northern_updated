$(function(){
/*$("#date").datepicker({ startDate: new Date()});
$("#fromdate").datepicker({ startDate: new Date()});
$("#todate").datepicker({ startDate: new Date()});*/
 $("#addhotelbtn").on('click', function(event) {
        event.preventDefault(); 

         if( $("#hotname").val()=="") {
        $("#hotname").focus();
        alert("Please Enter valid hotel name.....!");
        return;
       }
        if( $("#desti").val()=="") {
        $("#desti").focus();
        alert("Please Select valid destination.....!");
        return;
       }
       if( $("#sightseeing").val()=="") {
        $("#sightseeing").focus();
        alert("Please Enter valid sightseeing.....!");
        return;
       }
         if($("#chkin").val()=="") {
        $("#chkin").focus();
        alert("Please Enter valid check in date .....!");
        return;
       }
if($("#chkout").val()=="") {
        $("#chkout").focus();
        alert("Please Enter valid check out date .....!");
        return;
       } 
    if($("#rroomtype").val()=="") {
        $("#rroomtype").focus();
        alert("Please Enter valid room type .....!");
        return;
       }
         if( $("#meals").val()=="") {
        $("#meals").focus();
        alert("Please Enter valid mealtype.....!");
        return;
       }

       var hotname=$("#hotname").val();
     
       var desti=$("#desti").val();
       var sightseeing=$("#sightseeing").val();
       var night=$("#night").val();
       var chkin=$("#chkin").val();
       var chkout=$("#chkout").val();
       var room_id=$("#rroomtype").val();
       var roomtype = $('#rroomtype option[value="'+room_id+'"]').html();
       var meals=$("#meals").val();

        var i;
        var row = 0;

        $('#datatablevoucher tr').each(function() {
          row = row + 1;
        });
                
        if (row == 0) {
          i = 0;
        }else{
          i = row;
        };
      var  tr = '<tr id="row_'+ (i+1) +'"  title="'+ (i+1) +'">';
           tr += '<td id="sr_'+ (i+1) +'" data-sr="'+ (i+1) +'">'+ (i+1) +'</td>';
         
           tr += '<td id="hotname_'+ (i+1) +'" data-hotname="'+ hotname+'">'+ hotname+'</td>';
 tr += '<td id="desti_'+ (i+1) +'" data-desti="'+ desti+'">'+ desti+'</td>';
 tr += '<td id="sightseeing_'+ (i+1) +'" data-sightseeing="'+ sightseeing+'">'+ sightseeing+'</td>';
 

           tr += '<td id="night_'+ (i+1) +'" data-night="'+ night+'">'+ night+'</td>';
tr += '<td id="chkin_'+ (i+1) +'" data-chkin="'+ chkin+'">'+ chkin+'</td>';
tr += '<td id="chkout_'+ (i+1) +'" data-chkout="'+ chkout+'">'+ chkout+'</td>';
           tr += '<td id="roomtype_'+ (i+1) +'" data-roomtype="'+ roomtype+'">'+ roomtype +'</td>';
           tr += '<td id="meals_'+ (i+1) +'" data-meals="'+ meals+'">'+ meals+'</td>';
            tr += '<td>';
            tr += '<a type="button" class="btn btn-danger btn-sm" id="remove_list" data-srno="'+ (i+1) +'"><i class="icon-trash"></i></a>';
              tr+=  '</td>';
               tr += '</tr>';
          $('#datatablevoucher').append(tr);
          $("#hotname").val("");
          $("#desti").val("");
 $("#sightseeing").val("");
 $("#night").val("");
          $("#chkin").val("");
          $("#chkout").val("");
          $("#rroomtype").val("");
 $("#meals").val("");

     });

  $('#datatablevoucher').on('click', '#remove_list', function(event) {
      event.preventDefault();
      /* Act on the event */
      var $this = $(this);
      var id = $this.data('srno')
      var tr = $this.parent().parent();
     // console.log(tr);
      
      //var parent = tr.find('#row_'+id).remove();
      var parent = $('#row_'+id).remove();
       
    });

$("#additday").on('click', function(event) {
        event.preventDefault(); 

         if( $("#dy").val()=="") {
        $("#dy").focus();
        alert("Please Enter valid day.....!");
        return;
       }
        if( $("#dsc").val()=="") {
        $("#dsc").focus();
        alert("Please Select valid description.....!");
        return;
       }

       var day=$("#dy").val();
     
       var descr=$("#dsc").val();
      
        var i;
        var row = 0;

        $('#datatableitinerary tr').each(function() {
          row = row + 1;
        });
                
        if (row == 0) {
          i = 0;
        }else{
          i = row;
        };
      var  tr = '<tr id="row_'+ (i+1) +'"  title="'+ (i+1) +'">';
           tr += '<td id="sr_'+ (i+1) +'" data-sr="'+ (i+1) +'">'+ (i+1) +'</td>';
         
           tr += '<td id="day_'+ (i+1) +'" data-day="'+ day+'">'+ day+'</td>';
 tr += '<td id="descr_'+ (i+1) +'" data-descr="'+ descr+'">'+ descr+'</td>';
 
            tr += '<td>';
            tr += '<a type="button" class="btn btn-danger btn-sm" id="remove_list" data-srno="'+ (i+1) +'"><i class="icon-trash"></i></a>';
              tr+=  '</td>';
               tr += '</tr>';
          $('#datatableitinerary').append(tr);
          $("#dy").val("");
          $("#dsc").val("");

     });

  $('#datatableitinerary').on('click', '#remove_list', function(event) {
      event.preventDefault();
      /* Act on the event */
      var $this = $(this);
      var id = $this.data('srno')
      var tr = $this.parent().parent();
     // console.log(tr);
      
      //var parent = tr.find('#row_'+id).remove();
      var parent = $('#row_'+id).remove();
       
    });
$("#voucherprint").on('click', function(event) {
        event.preventDefault();      
        
      
        $('#voucherprint').prop('disabled', true);
        if( $("#clientname1").val()=="") {
          alert("Please Enter valid clientname.....!");
        $("#clientname1").focus();
        return;
       }
       if($("#emailid").val()=="")
       {
        alert("Please Enter valid Email.....!");
        $("#emailid").focus();
        return;
       }
    
      var $formData = $('#voucherform').serialize();
   

var hotname=new Array();var desti=new Array();var sightseeing=new Array();var night=new Array();var chkin=new Array();var chkout= new Array();
   var roomtype=new Array(); var meals=new Array();
   var ind=0;
   $('#datatablevoucher tr').each(function(){
                    
                    id = $(this).attr('id');
                    var str = id;
                    var parsing_id = str.replace("row_", "");
                   var hotname1= $("#hotname_" + parsing_id).data('hotname');
                  var desti1= $("#desti_" + parsing_id).data('desti');
                    var sightseeing1= $("#sightseeing_" + parsing_id).data('sightseeing');
                    var night1= $("#night_" + parsing_id).data('night');
                    var chkin1= $("#chkin_" + parsing_id).data('chkin');

                      var chkout1= $("#chkout_" + parsing_id).data('chkout');
                        var roomtype1= $("#roomtype_" + parsing_id).data('roomtype');
                        var meals1= $("#meals_" + parsing_id).data('meals');
                  
                   hotname[ind]=hotname1;
           desti[ind]=desti1;
sightseeing[ind]=sightseeing1;
night[ind]=night1;
           chkin[ind]=chkin1;
           chkout[ind]=chkout1; 
roomtype[ind]=roomtype1;  
meals[ind]=meals1;
             ind++; 

                  });

var day=new Array();var descr=new Array();
   var ind=0;
   $('#datatableitinerary tr').each(function(){
                    
                    id = $(this).attr('id');
                    var str = id;
                    var parsing_id = str.replace("row_", "");
                   var day1= $("#day_" + parsing_id).data('day');
                  var descr1= $("#descr_" + parsing_id).data('descr');
                    
                  
                   day[ind]=day1;
           descr[ind]=descr1;
             ind++; 

                  });
   $formData+="&action=voucher&hotname="+hotname+"&desti="+desti+"&sightseeing="+sightseeing+"&night="+night+"&chkin="+chkin+"&chkout="+chkout+"&roomtype="+roomtype+"&meals="+meals+"&day="+day+"&descr="+descr;


        console.log($formData);

        var $request = $.ajax({
                              url :'inc/maintain_voucher.php',
                              type: "POST",
                              data: $formData,
                              dataType: 'json',
                
                            });
                      $request.done(function(data) {
             
                  if (data.status) {                 
                     alert(data.msg);          
             
                  } else {
                        alert(data.msg);                 
                     }
              });
              $request.always(function(data) {
          console.log(data);
            $('#voucherprint').prop('disabled', false);
              // resetmem();
              });
         //window.open("inc/maintain_voucher.php?"+$formData,'_blank');
      
      });


  });

