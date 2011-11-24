$(function(){
    $('#BoardAddForm').validationEngine({
		validationEventTrigger: 'submit',
		promptPosition : 'topRight',
		scroll: false
	});
    
	$('.group-box > h3').click(function(){
        $(this).parent().toggleClass('expanded');
    });
    
    $('.network-list li').click(function(){
        var networkId = $(this).attr('id').replace(/network-/, '');
        if (!$(this).hasClass('active')) {
            // Deactivate all panels
            $(this).parent().children('li').removeClass('active');
            $('#choose-participants .participants-wrap').removeClass('active');
            // Activate selected panel
            $(this).addClass('active');
            $('#participants-panel-' + networkId).addClass('active');
        };
    });
    
    var tableSorterOptions = {
        headers: { 0: { sorter: false } },
        cssAsc: 'asc',
        cssDesc: 'desc',
        cssHeader: '',
        sortList: [[1,0]],
        sortAppend: [[1,0]]
    };
    $('.participants-wrap table').tablesorter(tableSorterOptions);
    
    $('.participants-wrap th input[type="checkbox"]').live('change', function(){
        var $allCheckboxes = $(this).parents('table:first').find('td input[type="checkbox"]');
        if ($(this).is(':checked')) {
            $allCheckboxes.attr('checked', 'checked');
        } else {
            $allCheckboxes.removeAttr('checked');
        }
        $allCheckboxes.change();
    });
    
    $('.participants-wrap td').live('click', function(event){
        var $target = $(event.target);
        if ($target.is('td')) { // Prevents double trigger of check/uncheck
            $(this).parent().find('input[type="checkbox"]').toggleCheck();
        }
    });
    
    $('.participants-wrap td input[type="checkbox"]').live('change', function(){
        var id = $(this).val();
        var $similarlyNamedCheckboxes = $('input[type="checkbox"][name="' + $(this).attr('name').replace(/\[/, '\\[') + '"]');
        if ($(this).is(':checked')) {
            var name = $(this).parents('tr:first').find('td.name').text().trim();
            var network, networkId;
            // Find active network
            if ($(this).parents('#choose-participants').length != 0) {
                var $activeNetwork = $('#choose-participants').find('.network-list li.active');
                network = $activeNetwork.text().trim();
                networkId = $activeNetwork.attr('id').replace(/network-/, '');
            }
            addToBoard(name, id, network, networkId);
            $similarlyNamedCheckboxes.attr('checked', 'checked');
        } else {
            removeFromBoard(id);
            $similarlyNamedCheckboxes.removeAttr('checked');
        }
    });
    
    $('.group-box .dlt-co-name').live('click', function(){
        var id = $(this).siblings('input[type="hidden"]').val();
        // Uncheck all related checkboxes, and as a consequence, remove name from board
        var $relatedCheckboxes = $('input[type="checkbox"][name="data\\[board_participants\\]\\[' + id + '\\]"]');
        $relatedCheckboxes.removeAttr('checked').change();
    });
    
    var searchXhr;
    $('#search-participants-box')
        .keyup(function(e){
            if (searchXhr) { searchXhr.abort(); }
            var query = encodeURIComponent($(this).val());
            var $dummyText = $(this).parent().find('.dummy-text-group');
            var $participantsWrap = $(this).parent().find('.participants-wrap');
            if (query == '') {
                $dummyText.show();
                $participantsWrap.hide();
            } else {
                var url = BASEURL + 'boards/search_users/limit:4/?query=' + query;
                searchXhr = $.get(url, function(data){
                    $('#participants-panel').replaceWith(data);
                    $('#participants-panel').find('input[type="checkbox"][name^="data\\[board_participants\\]"]').each(function(){
                        var id = $(this).val();
                        if (boardUsers.indexOf(id) != -1) {
                            $(this).attr('checked', 'checked');
                        }
                    });
                    $('#participants-panel table').tablesorter(tableSorterOptions);
                    $dummyText.hide();
                    $participantsWrap.show();
                }, 'html');
            }
        })
        .keypress(function(e){
            if (e.which == 13) {
                return false;
            }
        });
});

$.fn.toggleCheck = function(){
    if (this.is(':checked')) {
        this.removeAttr('checked');
    } else {
        this.attr('checked', 'checked');
    }
    this.change();
    return this;
}

$.fn.addToCounter = function(number){
    var $groupBoxCounter = this.find('.group-box-counter');
    if ($groupBoxCounter.length != 0) { // For all group boxes except 'Other'
        $groupBoxCounter.text(parseInt($groupBoxCounter.text()) + number);
        if ($groupBoxCounter.text() <= 0) {
            this.hide();
        } else {
            this.show();
        }
    }
    return this;
}

var boardUsers = new Array();

function addToBoard(name, id, network, networkId) {
    if (boardUsers.indexOf(id) != -1) { return false; }
    var $groupBox = networkId ? $('#group-box-' + networkId) : $('#group-box-other');
    var newUser = '<li>';
    newUser += name;
    newUser += '<input type="hidden" name="data[User][User][' + id + ']" value="' + id + '" />';
    newUser += '<a href="javascript:void(0);" class="dlt-co-name"></a>'
    newUser += '</li>';
    $groupBox.addToCounter(1).find('ul').append(newUser);
    $groupBox.find('li').sortElements();
    boardUsers.push(id);
    return true;
}

function removeFromBoard(id) {
    if (boardUsers.indexOf(id) == -1) { return false; }
    $('.group-box').each(function(){
        var $hiddenField = $(this).find('input[name="data\\[User\\]\\[User\\]\\[' + id + '\\]"]');
        if ($hiddenField.length != 0) {
            $hiddenField.parent().remove();
            $(this).addToCounter(-1);
        }
    });
    removeByElement(boardUsers, id);
    return true;
}

function removeByElement(arr, elem) {
    for (var i = 0; i < arr.length; i++) { 
        if (arr[i] == elem) {
            arr.splice(i,1);
        }
    }
}

/**
 * $.fn.sortElements
 * --------------
 * @param Function comparator:
 *   Exactly the same behaviour as [1,2,3].sort(comparator)
 *   
 * @param Function getSortable
 *   A function that should return the element that is
 *   to be sorted. The comparator will run on the
 *   current collection, but you may want the actual
 *   resulting sort to occur on a parent or another
 *   associated element.
 *   
 *   E.g. $('td').sortElements(comparator, function(){
 *      return this.parentNode; 
 *   })
 *   
 *   The <td>'s parent (<tr>) will be sorted instead
 *   of the <td> itself.
 */
$.fn.sortElements = (function(){
 
    var sort = [].sort;
 
    return function(comparator, getSortable) {
 
        getSortable = getSortable || function(){return this;};
 
        var placements = this.map(function(){
 
            var sortElement = getSortable.call(this),
                parentNode = sortElement.parentNode,
 
                // Since the element itself will change position, we have
                // to have some way of storing its original position in
                // the DOM. The easiest way is to have a 'flag' node:
                nextSibling = parentNode.insertBefore(
                    document.createTextNode(''),
                    sortElement.nextSibling
                );
 
            return function() {
 
                if (parentNode === this) {
                    throw new Error(
                        "You can't sort elements if any one is a descendant of another."
                    );
                }
 
                // Insert before flag:
                parentNode.insertBefore(this, nextSibling);
                // Remove flag:
                parentNode.removeChild(nextSibling);
 
            };
 
        });
        
        if (!comparator) {
            comparator = function(a, b){
                return $(a).text() > $(b).text() ? 1 : -1;
            }
        }
 
        return sort.call(this, comparator).each(function(i){
            placements[i].call(getSortable.call(this));
        });
 
    };
 
})();