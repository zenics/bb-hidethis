<?php
/**
 jQuery script to hide entered node.
 */
?>
jQuery(function() {
  
if ( typeof FLBuilder == 'undefined' && typeof FLBuilderLayout != 'undefined' ) {


 var hiderItems = jQuery("[data-hider='true']");

 if(hiderItems.length !== 0){
  hiderItems.each(function(index, item){
        
var nodeToCheck = jQuery(item).attr('data-node');  
var wrappingNode = jQuery(item).attr('data-hiderwrapper'); 


var postModuleNoPost = jQuery('[data-node="' + nodeToCheck +'"]').find(".fl-module-content").children('.fl-post-grid-empty').length;
var moduleContentNotEmpty = jQuery('[data-hiderwrapper="' + wrappingNode +'"]').find(".fl-module-content").text().trim().length;


console.log(nodeToCheck,wrappingNode,postModuleNoPost,moduleContentNotEmpty);

    if(postModuleNoPost !== 0 || !moduleContentNotEmpty) {

 jQuery('[data-node="' + wrappingNode + '"]').hide();
jQuery('[data-node="' + nodeToCheck +'"]').hide();
}
 });
 }
    }
});
