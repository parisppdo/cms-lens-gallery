// Summernote initialization
$(document).ready(function() {
    $('#summernote').summernote({
        height: 200
    });
  });

// Targeting the SelectAllBoxes id and checkBoxes class
$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        }
        else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    })
});

// Showing online users in admin navigation
function loadUsersOnline() {
    $.get("includes/online_users.php?onlineusers=result", function(data) {
        $(".usersonline").text(data);
    });
}
setInterval(function() {
    loadUsersOnline();
}, 500); // function is called every 500msec = 0,5sec
