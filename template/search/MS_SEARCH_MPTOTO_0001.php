<div class="gb-header-search_mptoto">
    <form action="/index.php" method="get" accept-charset="utf-8">
        <div class="vk-newlist-banner-test-search" style="position: relative;">
            <input type="hidden" name="page" value="set-link">
            <input type="text" id="faq_search_input" name="q" placeholder="Bạn cần tìm sản phẩm...?" autocomplete="off">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="live-search" id="searchresultdata"></div>			
    </form>
</div>

<script>
   	$(document).ready(function() {
    $("#faq_search_input").keyup(function()
    {
        var faq_search_input = $(this).val();          
        var dataString = 'keyword='+ faq_search_input;   
        if(faq_search_input.length > 0)                   
        {
            // if (faq_search_input.length > 6) {
            //     setTimeout(function(){
            //         $.ajax({
            //             type: "GET",                             
            //             url: "/functions/ajax/ajax-search.php",
            //             data: dataString,                       
            //             beforeSend:  function() {               
            //                 $('input#faq_search_input').addClass('loading');
            //             },
            //             success: function(server_response)       
            //             {
            //                 $('#searchresultdata').html(server_response).show();     
            //             }
            //         });
            //     }, 500);
            // } else {
                $.ajax({
                    type: "GET",                             
                    url: "/functions/ajax/ajax-search.php",
                    data: dataString,                       
                    beforeSend:  function() {               
                        $('input#faq_search_input').addClass('loading');
                    },
                    success: function(server_response)       
                    {
                        $('#searchresultdata').html(server_response).show();     
                    }
                });
            // }
            
            
        }else{
        	$("#searchresultdata").hide();
        }
        return false;
    });
    });
</script>	