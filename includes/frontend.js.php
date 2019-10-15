<?php

?>

jQuery(function() {

if ( typeof FLBuilder == 'undefined' && typeof FLBuilderLayout != 'undefined' ) {
var hiderItems = jQuery("[data-hider='true']");
if(hiderItems.length !== 0){
hiderItems.each(function(index, item){

var nodeToCheck = jQuery(item).attr('data-node');
var wrappingNode = jQuery(item).attr('data-hiderwrapper');
var wrappingNodeArr = wrappingNode.split(',');
console.log(wrappingNodeArr);

var postModuleNoPost = jQuery('[data-node="' + nodeToCheck +'"]').find(".fl-module-content").find('div[class*="grid-empty"]').length;
//var moduleContentNotEmpty = jQuery('[data-hiderwrapper="' + wrappingNode +'"]').find(".fl-module-content").text().trim().length;
if(postModuleNoPost !== 0 ) {
$.each(wrappingNodeArr, function (index, value) {
jQuery('[data-node="' + value + '"]').hide();
});
jQuery('[data-node="' + nodeToCheck +'"]').hide();
}
});
}
}
});