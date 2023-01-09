$(function() {//https://learn.jquery.com/using-jquery-core/document-ready/
    $("tr").click(function(){
        var $table = $(this).closest('table');
        console.log($(this))
        var cells = $(this).find('.slds-truncate');
        var url = '/loaditform/';
        $.each(cells,function(index){
            var colName = $table.find('th').eq(index).text();
            var value = $(this).attr('title').trim();

            if(value != ''){
                if(value.indexOf('http') !== -1){
                    value = encodeURIComponent(value);
                    console.log(value);
                }    
                url += colName+'='+value+'&';
            }
            
            
        });

        console.log(url);
        console.log(url.slice(0,-1));
        //window.location.href = url.slice(0,-1);
        //$(this).clone().appendTo('tbody');
    });


});