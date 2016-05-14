FEED = (function(){
	var FEED = FEED || {};
	FEED.init = function(){
      //Enable Feed Item Drag and Drop
      $( "#sortable-source, #sortable-custom" ).sortable({
        connectWith: ".list-group"
      });
      $( "#sortable-source, #sortable-custom" ).disableSelection();

      //Drop Down Actions
      $(".feed-dropdown-option").click(function(){
        var labelledby = $(this).parent().parent().attr('aria-labelledby');
        var apiUrl = 'http://flat.vm/feeds/api/get/';
        $('#' + labelledby ).html($(this).html() + "&nbsp;<span class=\"caret\"></span>");
        if(labelledby == "dropdownMenuSource"){
          apiUrl += $(this).data('sourceid') ;
          FEED.getSourceData(apiUrl,'sortable-source');

        }
      });

      //Feed Item Removal - Ajax Generated Items
      $(document).on('click', '.item-delete', function () {
        var deleteGuid = $(this).data('delete');
        $('li[data-guid="' + deleteGuid + '"]').remove();
        return false;
      });
	};

  FEED.getSourceData = function(url,targetlist){
  //  alert(url);
    $.ajax({
      url: url
    //  context: document.body
  }).done(function(response) {
      //$( this ).addClass( "done" );
      //console.log('response',response);
      var sourceListHTML = '';
      response.forEach(function(item){
        //console.log(item);
        sourceListHTML += "<li class=\"list-group-item\" data-guid=\""+item.guid+"\">"+
                            "<table style=\"width:100%\" class=\"table table-bordered\">"+
                              "<tr class=\"info\">"+
                                "<th>Title:</th>"+
                                "<td><span class=\"badge item-delete\" data-delete=\""+item.guid+"\">DELETE</span>"+item.title+"</td>"+
                              "</tr>"+
                              "<tr class=\"danger\">"+
                                "<th>URL:</th>"+
                                "<td><a href=\""+item.guid+"\" data-link=\""+item.link+"\">"+item.guid+"</td>"+
                              "</tr>"+
                              "<tr class=\"success\">"+
                                "<th>Description:</th>"+
                                "<td>"+item.description+"</td>"+
                              "</tr>"+
                              "<tr class=\"success\">"+
                                "<th>Published Date:</th>"+
                                "<td>"+item.pubDate+"</td>"+
                              "</tr>"+
                              "</table>"+
                          "</li>";
      });
    if(sourceListHTML !=''){
      $("#"+targetlist).html(sourceListHTML);
    }
    });
  }
	return FEED;
})();

$(document).ready(function(){
	FEED.init();

});
