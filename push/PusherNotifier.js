function PusherNotifier(channel, options) {
  options = options || {};
  
  this.settings = {
    eventName: 'notification',
    title: 'Notification',
    titleEventProperty: null, // if set the 'title' will not be used and the title will be taken from the event
    image: 'images/notify.png',
    eventTextProperty: 'message',
    gritterOptions: {}
  };
  
  $.extend(this.settings, options);
  
  var self = this;
  channel.bind(this.settings.eventName, function(data){ self._handleNotification(data); });
};
PusherNotifier.prototype._handleNotification = function(data) {
  var gritterOptions = {
   title: (this.settings.titleEventProperty? data[this.settings.titleEventProperty] : this.settings.title),
   text: data[this.settings.eventTextProperty].replace(/\\/g, ''),
   image: this.settings.image
  };
  
  var notif_data = data[this.settings.eventTextProperty];
  //$.extend(gritterOptions, this.settings.gritterOptions);
  //
  //$.gritter.add(gritterOptions);
    var notif_reviewer_id = parseInt(JSON.parse(notif_data)[0][0]);
    var notif_author_id = parseInt(JSON.parse(notif_data)[0][1]);
    var notif_shared_id = parseInt(JSON.parse(notif_data)[0][2]);
    var notif_shared_time = parseInt(JSON.parse(notif_data)[0][3]);
  
  //alert("noti:" + notif_shared_time);


  
  var timeSince = function(date) {
   
       d = new Date();
   

   var seconds = Math.floor((d.getTime()- date)/1000);
   var intervalType;
   //
   //alert((d.getTime()));
   //alert(date);
   
   
   
   var interval = Math.floor(seconds / 31536000);
   if (interval >= 1) {
       intervalType = 'year';
   } else {
       interval = Math.floor(seconds / 2592000);
       if (interval >= 1) {
           intervalType = 'month';
       } else {
           interval = Math.floor(seconds / 86400);
           if (interval >= 1) {
               intervalType = 'day';
           } else {
               interval = Math.floor(seconds / 3600);
               if (interval >= 1) {
                   intervalType = "hour";
               } else {
                   interval = Math.floor(seconds / 60);
                   if (interval >= 1) {
                       intervalType = "minute";
                   } else {
                       interval = seconds;
                       intervalType = "second";
                   }
               }
           }
       }
   }

   if (interval > 1 || interval === 0) {
       intervalType += 's';
   }

   return interval + ' ' + intervalType+' ago';
};

var timeago = timeSince(notif_shared_time);
  
var x = $("#self_uploaded").find("[data-shared-id = '"+notif_shared_id+ "']");
var y = $("#received").find("[data-shared-id = '"+notif_shared_id+ "']");
x.html(timeago);
 
if(notif_author_id != notif_reviewer_id){
  
  
var curr_review_state = parseInt(x.closest(".ssc-content").attr('data-review-state'));


  if (curr_review_state == 0 ) {
    
    //var new_count = parseInt(x.parent().parent().parent().siblings('.new-review-count').html()) + 1;
    x.closest(".individual_file_container").find(".badge").html("new updates");
     x.closest(".ssc-content").css('background-color','lightgreen');
     x.closest(".ssc-content").attr('data-review-state','1');
  }
  
}

 if(notif_author_id == notif_reviewer_id) {
  
  y.closest(".individual_file_container").find("#received-badge").html("received-badge");
  
 }




  
};









