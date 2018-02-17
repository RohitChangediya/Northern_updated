var Search ={
    users:null,
    category:null,
    init:function() {
       this.bind_events();
       this.loadData();
    },
    bind_events:function() {
       $('.in-check').on('click',function(){
          if($(this).is(':checked')){
              $(this).closest('.div-search-section').find('.in-text').show();
          }
          else
            $(this).closest('.div-search-section').find('.in-text').hide();
       });
       $('#input-date-check').trigger('click');
       $('#input-date').val(this.current_date());
       $('#input-delete-check').on('click',this.loadData);
        $('#input-date').on('change',this.loadData);
       $('#input-username').typeahead({
            source:Search.users,
            onSelect:function(item){
                $('#input-user-id').val(item.value);
                Search.loadData();
            }
      });
        $('#input-category').typeahead({
            source:Search.category,
            onSelect:function(item){
                $('#input-cat-id').val(item.value);
                Search.loadData();
            }
      });
      $('.tab-content').on('click','.delete-object',this.onDeleteAction);
    },
    onDeleteAction:function(){
        var $form_data = new FormData();
        $('form#form').serializeArray().forEach(function(field){
              $form_data.append(field.name, field.value);
        });
        $form_data.append("action", "deleteobject");
        $form_data.append("oid", $(this).attr('oid'));
        $form_data.append("otype",$(this).attr('otype'));
        $form_data.append("tablename", $(this).attr('table'));
        $.ajax({
              url: 'includes/User.php',
              type: 'POST',
              dataType: "JSON",
              data: $form_data,
              cache: false,              
              processData: false, // Don't process the files
              contentType: false
          })
          .done( function( data ) {
            if(data.status){
                var result=data.msg;
                if(result.otype=="video")
                    Search.showVideos(result.data);
                if(result.otype=="photos")
                    Search.showPhotos(result.data);
                if(result.otype=="posts")
                    Search.showPost(result.data);
                if(result.otype=="jobs")
                    Search.showJobs(result.data);
            }
            else{
                displaywarning(data.msg);
            }
          });
    },
    loadData:function(){
         var $form_data = new FormData();
        $('form#form').serializeArray().forEach(function(field){
              $form_data.append(field.name, field.value);
        });
        $form_data.append("action", "search");
         $.ajax({
              url: 'includes/User.php',
              type: 'POST',
               dataType: "JSON",
              data: $form_data,
                cache: false,              
              processData: false, // Don't process the files
              contentType: false
          })
          .done( function( data ) {
            if(data){
                Search.showPost(data.posts);
                Search.showPhotos(data.photos);
                Search.showJobs(data.jobs);
                Search.showVideos(data.videos);
            }
          });
    },
    showVideos:function(videos){
         var html="";
            for (i in videos) {
            html+='<div class="col-md-4" style="padding-top: 15px;padding-bottom: 15px;">\
                <iframe width="100%" height="200" src="'+videos[i].file_link+'" frameborder="0" allowfullscreen></iframe>\
                    <section class="list-left">\
                            <h5 class="title" style="margin-top:0px;">\
                            <a href="#" style="font-size: 17px;">';
                              if(videos[i].is_verify!=2)
                                html+='<img src="data:image/jpg;base64,'+videos[i].profile_photo+'" style="height:30px;width:30p" />'+videos[i].first_name+' '+videos[i].last_name;
                              else
                                html+='<img src="images/default.png" style="height:30px;width:30p" />'+videos[i].first_name+' '+videos[i].last_name;

                             html+='</a>\
                            <span class="date" style="font-size:14px;line-height: 1.42857143;color: #c1c1c1;text-align: right;float: right;">'+videos[i].add_date;
                            if(videos[i].is_deleted!=1)
                                html+='<a class="delete-vedio delete-object" oid='+videos[i].id+' otype="video" table="video_gallery"><i class="fa fa-trash" style="font-size:24px;color:#D15B47!important;"></i></a>';
                            html+='</span>\
                            </h5>\
                        </section>\
                        <section class="list-right">\
                            <span class="cityname"></span>\
                        </section>\
                        <div class="clearfix"></div>\
                </div>';
            };
        $('#videos-data').html(html);
    },
    showPhotos:function(photos){
         var html="";
            for (i in photos) {
                html+='<div class="col-lg-3 col-md-4 col-xs-6" style="padding-top: 15px;padding-bottom: 15px;">\
                     <a href="#" class="d-block mb-4 h-100">\
                    <img class="img-fluid img-thumbnail" style="height: 237px;" src="data:image/jpg;base64,'+photos[i].photo+'">\
                  </a>\
                <section class="list-left">\
                        <h5 class="title">\
                        <a href="#"style="font-size: 17px;">\
                            '+photos[i].first_name+' '+photos[i].last_name+'\
                        </a>\
                        <span class="date" style="font-size:14px;line-height: 1.42857143;color: #c1c1c1;text-align: right;float: right;">\
                        '+photos[i].added_date+' ';
                    if(photos[i].is_deleted!=1)
                        html+= '<a class="delete-photos delete-object" oid='+photos[i].id+' otype="photos" table="photo_gallery"><i class="fa fa-trash" style="font-size:18px;color:#D15B47!important;"></i></a>';
                       html+='</span>\
                        </h5>\
                    </section>\
                    <section class="list-right">\
                        <span class="cityname"></span>\
                    </section>\
                    <div class="clearfix"></div>\
                </div>\
            ';
            };
        $('#show-photos').html(html);
    },
    showPost:function(post){
        var html="";
            for (i in post) {
                html+='<li class="col-md-6" style="list-style:none;background: #fafafa;margin-bottom: 5px;margin-right: 5px;width: 49%;">';
                html+=' <a href="#">';
                  html+='<img id="myImg" src="data:image/jpg;base64,'+post[i].post_img+'" style="max-width: 100%; height: 250px;margin-top: 10px;" title="" alt="" />';
                   html+='<div class="clearfix"></div>';
                 html+='<section class="list-left">';
                 html+='<h5 class="title" style="margin-top:0px;margin-bottom:0px;">';
                 if(post[i].is_verify!=2)
                   html+='<img src="data:image/jpg;base64,'+post[i].profile_photo+'" style="height:30px;width:30px" title="" alt="" />';
                 else
                    html+='<img src="images/default.png" style="height:30px;width:30px" title="" alt="" />';
                 html+='</a>';
                  html+='<span class="cityname">  '+post[i].first_name+' '+post[i].last_name+'</span></h5>';
                 html+=' <span class="adpric"></span>';
                 html+='<p class="catpath">'+post[i].post+'</p>';
                 html+='</section>';
                 html+='<section class="list-right" style="text-align:right;margin-top:1%;">';
                  html+='<span class="date">'+post[i].add_date+'</span>';
                  if(post[i].is_deleted!=1)
                    html+='<a class="delete-vedio delete-object" oid='+post[i].id+' otype="posts" table="aad_post"><i class="fa fa-trash" style="font-size:24px;color:#D15B47!important;"></i></a>';
                  html+='</section>';
                 
               html+=' </a>';
                html+='</li>';
                /*if(i%2!=0){
                    html+='<div class="clearfix"></div>';
                }*/
              
            };
        $('#showpost').html(html);
    },
    showJobs:function(jobs){
        var html="";
         for (i in jobs) {
         html+='<div class="col-md-12 happy-clients-grid wow bounceIn" data-wow-delay="0.4s">\
            <div class="client col-md-2">';
              if(jobs[i].is_verify!=2)
                html+='<img src="data:image/jpg;base64,'+jobs[i].profile_photo+'" alt="">';
              else
                html+='<img src="images/default.png" alt="">';
            html+='<h4 style="margin-top:10px">'+jobs[i].first_name+' '+jobs[i].last_name+'</h4>\
            </div>\
            <div class="client-info col-md-10">\
                <h4 class="heading">'+jobs[i].title+'</h4><p>'+jobs[i].description+'</p>';
            if(jobs[i].is_deleted!=1)
                html+='<a class="delete-jobpost delete-object" oid='+jobs[i].id+' otype="jobs" table="bf_news"><i class="fa fa-trash pull-right" style="font-size:30px;color:#D15B47!important;"></i></a>';
            html+='</div>\
            <div class="clearfix"></div>\
            <hr> \
            <div id="container" style="color:#6a6b6c">\
                <i class="fa fa-comments"> Reply...</i>\
                <ul class="list">';
                if(jobs[i].applyjobs.length !=0)
                {
                    var applyjobs=jobs[i].applyjobs;
                    for (j in applyjobs) {
                         html+='<li>\
                        <a href="#"><img src="data:image/jpg;base64,'+applyjobs[j].profile_photo+'" title="" alt=""></a>\
                        <section class="list-left">\
                        <h5 class="title" style="margin-top:10px">'+applyjobs[j].first_name+' '+applyjobs[j].last_name+'</h5>\
                        </section>\
                        <div class="clearfix"></div>\
                        </li>';
                    }
                }
                else
                      html+='<span style="font-size: 18px;height: 37px;">No Application yet..!</span>';
          html+='</ul>\
            </div>\
        </div>';
        }
        $('#job-data').html(html);
    },
    displaysucess:function(msg)
    {
        swal("Success!", msg, "success")
    },
   displaywarning:function(msg)
    {
        swal("Error!", msg, "error")
    },
    current_date: function() {
        var date = new Date();
          var yyyy = date.getFullYear().toString();
          var mm = (date.getMonth()+1).toString(); // getMonth() is zero-based
          var dd  = date.getDate().toString();
          return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
    }
  
};