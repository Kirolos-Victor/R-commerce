var current_vendor_id = $('#current_vendor_id').val();
//realtime listening to new orders notifications
realTimeTrackingOrders : {
    /*    // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('a0258e0a0946ebf26cab', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            alert(JSON.stringify(data));
        });*/
}

$(document).on('click', '#notifyAreaSec', function () {
    $(this).find('.bell:eq(0)').removeClass('bell');
});
//TODO revert to real time tracking
setInterval(checkNewOrders, 60000);

function checkNewOrders() {
    var url = $('#refresh_route').val();
    var data = new FormData();

    $.ajax({
        url: url,
        type: 'GET',
        dataType: "JSON",
        data: data,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": "{{csrf_token()}}"
        },
        success: function (response, status) {
            console.log(response);
            //set btn as disabled until load is finished
            //     endLoading(currentElement);
            /*   swal.fire({
                   title: "Success",
                   text: "",
                   type: "success",
                   confirmButtonClass:
                       "btn btn-secondary m-btn m-btn--wide"
               }).then(function(result) {
                   //redirect to show all
                   window.location.replace(response.url);
               });*/
            if(response.success == 1){
                $('#notifyAreaSec').replaceWith(response.notifyAreaSec);
            }

        },
    });
}


