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
        if($('.badge.collapse').hasClass('hide')){
          $('.badge.collapse').removeClass('hide');
        }
        var labelledby = $(this).parent().parent().attr('aria-labelledby');
        var apiSourceUrl = 'http://flat.vm/feeds/api/source/get/';
        var apiFeedUrl = 'http://flat.vm/feeds/api/managed/get/';
        $('#' + labelledby ).html($(this).html() + "&nbsp;<span class=\"caret\"></span>");
        if(labelledby == "dropdownMenuSource"){
          apiSourceUrl += $(this).data('sourceid') ;
          FEED.processSourceData(apiSourceUrl,'sortable-source');

        }
        if(labelledby == "dropdownMenuFeed"){
          if($('.badge.save').hasClass('hide')){
            $('.badge.save').removeClass('hide');
            $('.badge.create').removeClass('hide');
          }
          apiFeedUrl += $(this).data('sourceid') ;
          $('ul[aria-labelledby="dropdownMenuFeed"]').attr('data-entityid',  $(this).data('sourceid'));
          FEED.processSourceData(apiFeedUrl,'sortable-custom');

        }
      });

      //Feed Item Removal - Ajax Generated Items
      $(document).on('click', '.item-delete', function () {
        var deleteGuid = $(this).data('delete');
        var listTarget = 'li[data-guid="' + deleteGuid + '"]';
        var deleteUrl = 'feeds/api/managed/item/delete';

        if($(listTarget).data('managedid') != 'source-item'){
          $.post(deleteUrl, {id: $(listTarget).data('managedid') });
        }

        $(listTarget).remove();
        FEED.checkifReadyForSave();
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
      $('.badge.create').click(function(){
        var createTime = new Date();
        var formTimestamp = createTime.getTime();
        var createForm = new Object;
        var formContainer = new Array;
        createForm.title = '<input name="title" type="text" value="" class="form-control" />';
        createForm.linkForm = '<input name="link" type="text" value="" class="form-control" />';
        createForm.description = '<textarea name="description" rows="5" value="" class="form-control" />';
        createForm.pubDate = '<input name="date" type="text" value="'+createTime+'" class="form-control" />';
        createForm.guid = 'create-form-at-' +formTimestamp;
        formContainer.push(createForm);
        var newItem = FEED.writeInputList(formContainer);
        $('#sortable-custom').prepend(newItem);
        FEED.checkifReadyForSave();
      });

      $('.badge.save').click(function(){
        var managedFeedSelector = 'ul[aria-labelledby="dropdownMenuFeed"]';
        var managedFeedID = $(managedFeedSelector).data('entityid');
        var mangedFeedData = new Array;
        var managedFeedName = $('#dropdownMenuFeed').text();
        var postUrl = '/feeds/api/managed/save/' + managedFeedID;

        $('#sortable-custom li').each(function(){
          var managedFeedItem = new Object;
          managedFeedItem.id = $(this).data('managedid');
          managedFeedItem.guid = $(this).data('guid');
          managedFeedItem.title = $(this).find('span.item-title').text();
          managedFeedItem.description = $(this).find('tr.description td').text();
          managedFeedItem.link = $(this).find('tr.link td').text();
          managedFeedItem.pubdate = $(this).find('tr.pubdate td').text();
          mangedFeedData.push(managedFeedItem);
        });

        $.post(postUrl, {items: mangedFeedData }).done(function(){
            var createTime = new Date();
            var alertTimeStamp = createTime.getTime();
            var alertId= 'alert-at-' + alertTimeStamp;
            var success = '<div id="'+alertId+'" class="alert alert-success fade in" style="margin-top:18px;">'+
                            '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+
                            '<strong>Success!</strong> The Managed Feed "<strong>'+managedFeedName+'</strong>" has been updated.'+
                          '</div>';
            $('.stage').prepend(success);
            $("#"+alertId).fadeTo(5000, 500).fadeOut(500, function(){
              $("#"+alertId).alert('close');
            });
          });
      });

      //Create new Item From "Create Item Form"
      $(document).on('click', '.badge.item-add', function () {
        //Need to keep track of the form's guid data to target values for new item
        var formGuid = $(this).data('add');
        var createForm = new Object;
        var formContainer = new Array;
        var itemTarget = 'li[data-guid="' + formGuid + '"]';
        createForm.title = $(itemTarget).find('input[name="title"]').val();
        createForm.link = $(itemTarget).find('input[name="link"]').val();
        createForm.description = $(itemTarget).find('textarea[name="description"]').val();
        createForm.pubDate = $(itemTarget).find('input[name="date"]').val();
        createForm.guid = createForm.link;
        formContainer.push(createForm);
        var newItem = FEED.writeInputList(formContainer);
        $('#sortable-custom').prepend(newItem);
        $(itemTarget).remove();
        $('.no-items').remove();
        FEED.checkifReadyForSave();
      });

      //Update the values for the form items on input for direct insertion to feed
      $(document).on('input' ,'.feed-items input, .feed-items textarea', function(e){
        $(this).attr('value',$(this).val());
      });
	};
  /** processSourceData
    * Retrieves source data from specified url and handles the info
    * @param url:string - Address of the RSS Feed containing data
    * @param targetlist:string - id of the element reciving the item markup
  */
  FEED.processSourceData = function(url,targetlist){
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
  /** checkifReadyForSave
    * checks managed feed list to see if it's ready for save started
    * hides or shows 'Save Feed' button based on state
  */
  FEED.checkifReadyForSave = function(){
    var isReady = true;
    $('ul#sortable-custom li').each(function(){
      if($(this).data('guid').indexOf('create-form-at-') > -1 ){
        isReady = false;
      }
    });
    if(isReady == false){
      $('.badge.save').addClass('hide');
    } else {
      $('.badge.save').removeClass('hide');
    }

  };
  /** writeInputList
    * Updates feeds with specified item data
    * @param items:Array - list of items to be added
  */
  FEED.writeInputList = function(items){
    var sourceListHTML = '';
    var hideClass = ' hide';
    items.forEach(function(item){
    //console.log(item);
    if(item.id == undefined) item.id = "source-item"
    if(typeof item.description != 'string') item.description = "None";
    if(item.linkForm != null){ item.link = ''; item.text =''; hideClass = ''; } else { item.linkForm = ''; item.text = item.guid }
    sourceListHTML += "<li class=\"list-group-item ui-sortable-handle\" data-guid=\""+item.guid+"\" data-managedid=\""+item.id+"\">"+
                        "<table style=\"width:100%\" class=\"table table-bordered\">"+
                          "<tr class=\"info title\">"+
                            "<th>Title:</th>"+
                            "<td>"+
                            "<span class=\"badge item-delete\" data-delete=\""+item.guid+"\">DELETE</span>"+
                            "<span class=\"badge item-add"+ hideClass+"\" data-add=\""+item.guid+"\">ADD TO FEED</span><span class=\"item-title\">"+item.title+"</span></td>"+
                          "</tr>"+
                          "<tr class=\"danger link\">"+
                            "<th>URL:</th>"+
                            "<td>"+item.linkForm+"<a href=\""+item.link+"\" target=\"_blank\" data-link=\""+item.link+"\">"+item.text+"</td>"+
                          "</tr>"+
                          "<tr class=\"success description\">"+
                            "<th>Description:</th>"+
                            "<td>"+item.description+"</td>"+
                          "</tr>"+
                          "<tr class=\"success pubdate\">"+
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
