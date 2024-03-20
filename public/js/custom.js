$(document).on('change', '.loan_status', function() {
    console.log($(this).attr('loan-id'));
    var base_url = $('meta[name=base-url]').attr('content')
    $.ajax({
        type: "GET",
        url: base_url+'/loan-status-change/'+$(this).attr('loan-id'),
        success: function(result){
            console.log(result);
        }
    });
});