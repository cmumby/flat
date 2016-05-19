FEED = (function(){
	var FEED = FEED || {};
	FEED.init = function(){
      //Enable Feed Item Drag and Drop
      $( "#sortable-source, #sortable-custom" ).sortable({
        connectWith: ".list-group",
        receive:function(){
          $('.no-items').remove();
        }
      });
      $( "#sortable-source, #sortable-custom" ).disableSelection();

      //Drop Down Actions
      $(".feed-dropdown-option").click(function(){
        var labelledby = $(this).parent().parent().attr('aria-labelledby');
        var apiSourceUrl = 'http://flat.vm/feeds/api/source/get/';
        var apiFeedUrl = 'http://flat.vm/feeds/api/managed/get/';
        $('#' + labelledby ).html($(this).html() + "&nbsp;<span class=\"caret\"></span>");
        if(labelledby == "dropdownMenuSource"){
          apiSourceUrl += $(this).data('sourceid') ;
          FEED.getSourceData(apiSourceUrl,'sortable-source');

        }
        if(labelledby == "dropdownMenuFeed"){
          apiFeedUrl += $(this).data('sourceid') ;
          $('ul[aria-labelledby="dropdownMenuFeed"]').attr('data-entityid',  $(this).data('sourceid'));
          FEED.getSourceData(apiFeedUrl,'sortable-custom');

        }
      });

      //Feed Item Removal - Ajax Generated Items
      $(document).on('click', '.item-delete', function () {
        var deleteGuid = $(this).data('delete');
        $('li[data-guid="' + deleteGuid + '"]').remove();
        return false;
      });

      //Feed submenu button actions
      $('.badge.collapse').click(function(){
          $('.list-group').each(function(){

            if(!$(this).hasClass('hide-info')){
              $(this).addClass('hide-info');
              $('.badge.collapse').text('Expand Items');
            } else{
              $(this).removeClass('hide-info');
              $('.badge.collapse').text('Collapse Items');
            }
        });

      });
	};

  FEED.getSourceData = function(url,targetlist){
    $.ajax({
      url: url
      //  context: document.body
    }).done(function(response) {
      sourceListHTML = (response != false)?FEED.writeInputList(response):'';
      if(sourceListHTML !=''){
        $("#"+targetlist).html(sourceListHTML);
      } else{
        $("#"+targetlist).html('<li class="no-items list-group-item ui-sortable-handle">No Items Yet. Add Items Under This<span class="caret"></span></li> ');
      }
    });
  };

  FEED.writeInputList = function(items){
    var sourceListHTML = '';
    items.forEach(function(item){
    console.log(item);
    if(typeof item.description != 'string') item.description = "None";
    sourceListHTML += "<li class=\"list-group-item ui-sortable-handle\" data-guid=\""+item.guid+"\">"+
                        "<table style=\"width:100%\" class=\"table table-bordered\">"+
                          "<tr class=\"info\">"+
                            "<th>Title:</th>"+
                            "<td><span class=\"badge item-delete\" data-delete=\""+item.guid+"\">DELETE</span>"+item.title+"</td>"+
                          "</tr>"+
                          "<tr class=\"danger\">"+
                            "<th>URL:</th>"+
                            "<td><a href=\""+item.link+"\" target=\"_blank\" data-link=\""+item.link+"\">"+item.guid+"</td>"+
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
    return sourceListHTML;
  };

  return FEED;
})();

$(document).ready(function(){
	FEED.init();

});
