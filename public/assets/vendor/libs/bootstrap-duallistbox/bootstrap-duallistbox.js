!function(e,t){for(var n in t)e[n]=t[n]}(window,function(e){var t={};function n(i){if(t[i])return t[i].exports;var s=t[i]={i:i,l:!1,exports:{}};return e[i].call(s.exports,s,s.exports,n),s.l=!0,s.exports}return n.m=e,n.c=t,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var s in e)n.d(i,s,function(t){return e[t]}.bind(null,s));return i},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=565)}({565:function(e,t,n){"use strict";n.r(t);n(566)},566:function(e,t){!function(e,t,n,i){var s="bootstrapDualListbox",l={bootstrap2Compatible:!1,filterTextClear:"show all",filterPlaceHolder:"Filter",moveSelectedLabel:"Move selected",moveAllLabel:"Move all",removeSelectedLabel:"Remove selected",removeAllLabel:"Remove all",moveOnSelect:!0,moveOnDoubleClick:!0,preserveSelectionOnMove:!1,selectedListLabel:!1,nonSelectedListLabel:!1,helperSelectNamePostfix:"_helper",selectorMinimalHeight:100,showFilterInputs:!0,nonSelectedFilter:"",selectedFilter:"",infoText:"Showing all {0}",infoTextFiltered:'<span class="label label-warning">Filtered</span> {0} from {1}',infoTextEmpty:"Empty list",filterOnValues:!1,sortByInputOrder:!1,eventMoveOverride:!1,eventMoveAllOverride:!1,eventRemoveOverride:!1,eventRemoveAllOverride:!1},o=/android/i.test(navigator.userAgent.toLowerCase());function r(t,n){this.element=e(t),this.settings=e.extend({},l,n),this._defaults=l,this._name=s,this.init()}function a(e){e.element.trigger("change")}function c(t){t.element.find("option").each((function(n,i){var s=e(i);void 0===s.data("original-index")&&s.data("original-index",t.elementCount++),void 0===s.data("_selected")&&s.data("_selected",!1)}))}function h(t,n,i){t.element.find("option").each((function(s,l){var o=e(l);o.data("original-index")===n&&(o.prop("selected",i),i?(o.attr("data-sortindex",t.sortIndex),t.sortIndex++):o.removeAttr("data-sortindex"))}))}function m(e,t){return e.replace(/\{(\d+)\}/g,(function(e,n){return void 0!==t[n]?t[n]:e}))}function d(e){if(e.settings.infoText){var t=e.elements.select1.find("option").length,n=e.elements.select2.find("option").length,i=e.element.find("option").length-e.selectedElements,s=e.selectedElements,l="";l=0===i?e.settings.infoTextEmpty:m(t===i?e.settings.infoText:e.settings.infoTextFiltered,[t,i]),e.elements.info1.html(l),e.elements.box1.toggleClass("filtered",!(t===i||0===i)),l=0===s?e.settings.infoTextEmpty:m(n===s?e.settings.infoText:e.settings.infoTextFiltered,[n,s]),e.elements.info2.html(l),e.elements.box2.toggleClass("filtered",!(n===s||0===s))}}function u(t){t.selectedElements=0,t.elements.select1.empty(),t.elements.select2.empty(),t.element.find("option").each((function(n,i){var s=e(i);s.prop("selected")?(t.selectedElements++,t.elements.select2.append(s.clone(!0).prop("selected",s.data("_selected")))):t.elements.select1.append(s.clone(!0).prop("selected",s.data("_selected")))})),t.settings.showFilterInputs&&(f(t,1),f(t,2)),d(t)}function f(t,n){if(t.settings.showFilterInputs){v(t,n),t.elements["select"+n].empty().scrollTop(0);var i=new RegExp(e.trim(t.elements["filterInput"+n].val()),"gi"),s=t.element.find("option"),l=t.element;(l=1===n?s.not(":selected"):l.find("option:selected")).each((function(l,o){var r=e(o),a=!0;(o.text.match(i)||t.settings.filterOnValues&&r.attr("value").match(i))&&(a=!1,t.elements["select"+n].append(r.clone(!0).prop("selected",r.data("_selected")))),s.eq(r.data("original-index")).data("filtered"+n,a)})),d(t)}}function v(t,n){var i=t.element.find("option");t.elements["select"+n].find("option").each((function(t,n){var s=e(n);i.eq(s.data("original-index")).data("_selected",s.prop("selected"))}))}function p(e){var t=e.children("option");t.sort((function(e,t){var n=parseInt(e.getAttribute("data-sortindex")),i=parseInt(t.getAttribute("data-sortindex"));return n>i?1:n<i?-1:0})),t.detach().appendTo(e)}function g(t,n){t.find("option").sort((function(t,n){return e(t).data("original-index")>e(n).data("original-index")?1:-1})).appendTo(t),u(n)}function b(t){"all"!==t.settings.preserveSelectionOnMove||t.settings.moveOnSelect?"moved"!==t.settings.preserveSelectionOnMove||t.settings.moveOnSelect||v(t,1):(v(t,1),v(t,2)),t.elements.select1.find("option:selected").each((function(n,i){var s=e(i);s.data("filtered1")||h(t,s.data("original-index"),!0)})),u(t),a(t),t.settings.sortByInputOrder?p(t.elements.select2):g(t.elements.select2,t)}function x(t){"all"!==t.settings.preserveSelectionOnMove||t.settings.moveOnSelect?"moved"!==t.settings.preserveSelectionOnMove||t.settings.moveOnSelect||v(t,2):(v(t,1),v(t,2)),t.elements.select2.find("option:selected").each((function(n,i){var s=e(i);s.data("filtered2")||h(t,s.data("original-index"),!1)})),u(t),a(t),g(t.elements.select1,t),t.settings.sortByInputOrder&&p(t.elements.select2)}function O(t){t.elements.form.submit((function(e){t.elements.filterInput1.is(":focus")?(e.preventDefault(),t.elements.filterInput1.focusout()):t.elements.filterInput2.is(":focus")&&(e.preventDefault(),t.elements.filterInput2.focusout())})),t.element.on("bootstrapDualListbox.refresh",(function(e,n){t.refresh(n)})),t.elements.filterClear1.on("click",(function(){t.setNonSelectedFilter("",!0)})),t.elements.filterClear2.on("click",(function(){t.setSelectedFilter("",!0)})),!1===t.settings.eventMoveOverride&&t.elements.moveButton.on("click",(function(){b(t)})),!1===t.settings.eventMoveAllOverride&&t.elements.moveAllButton.on("click",(function(){!function(t){"all"!==t.settings.preserveSelectionOnMove||t.settings.moveOnSelect?"moved"!==t.settings.preserveSelectionOnMove||t.settings.moveOnSelect||v(t,1):(v(t,1),v(t,2)),t.element.find("option").each((function(n,i){var s=e(i);s.data("filtered1")||(s.prop("selected",!0),s.attr("data-sortindex",t.sortIndex),t.sortIndex++)})),u(t),a(t)}(t)})),!1===t.settings.eventRemoveOverride&&t.elements.removeButton.on("click",(function(){x(t)})),!1===t.settings.eventRemoveAllOverride&&t.elements.removeAllButton.on("click",(function(){!function(t){"all"!==t.settings.preserveSelectionOnMove||t.settings.moveOnSelect?"moved"!==t.settings.preserveSelectionOnMove||t.settings.moveOnSelect||v(t,2):(v(t,1),v(t,2)),t.element.find("option").each((function(t,n){var i=e(n);i.data("filtered2")||(i.prop("selected",!1),i.removeAttr("data-sortindex"))})),u(t),a(t)}(t)})),t.elements.filterInput1.on("change keyup",(function(){f(t,1)})),t.elements.filterInput2.on("change keyup",(function(){f(t,2)}))}r.prototype={init:function(){this.container=e('<div class="bootstrap-duallistbox-container"> <div class="box1">   <label></label>   <span class="info-container">     <span class="info"></span>     <button type="button" class="btn clear1 pull-right"></button>   </span>   <input class="filter" type="text">   <div class="btn-group buttons">     <button type="button" class="btn moveall">       <i></i>       <i></i>     </button>     <button type="button" class="btn move">       <i></i>     </button>   </div>   <select multiple="multiple"></select> </div> <div class="box2">   <label></label>   <span class="info-container">     <span class="info"></span>     <button type="button" class="btn clear2 pull-right"></button>   </span>   <input class="filter" type="text">   <div class="btn-group buttons">     <button type="button" class="btn remove">       <i></i>     </button>     <button type="button" class="btn removeall">       <i></i>       <i></i>     </button>   </div>   <select multiple="multiple"></select> </div></div>').insertBefore(this.element),this.elements={originalSelect:this.element,box1:e(".box1",this.container),box2:e(".box2",this.container),filterInput1:e(".box1 .filter",this.container),filterInput2:e(".box2 .filter",this.container),filterClear1:e(".box1 .clear1",this.container),filterClear2:e(".box2 .clear2",this.container),label1:e(".box1 > label",this.container),label2:e(".box2 > label",this.container),info1:e(".box1 .info",this.container),info2:e(".box2 .info",this.container),select1:e(".box1 select",this.container),select2:e(".box2 select",this.container),moveButton:e(".box1 .move",this.container),removeButton:e(".box2 .remove",this.container),moveAllButton:e(".box1 .moveall",this.container),removeAllButton:e(".box2 .removeall",this.container),form:e(e(".box1 .filter",this.container)[0].form)},this.originalSelectName=this.element.attr("name")||"";var t="bootstrap-duallistbox-nonselected-list_"+this.originalSelectName,n="bootstrap-duallistbox-selected-list_"+this.originalSelectName;return this.elements.select1.attr("id",t),this.elements.select2.attr("id",n),this.elements.label1.attr("for",t),this.elements.label2.attr("for",n),this.selectedElements=0,this.sortIndex=0,this.elementCount=0,this.setBootstrap2Compatible(this.settings.bootstrap2Compatible),this.setFilterTextClear(this.settings.filterTextClear),this.setFilterPlaceHolder(this.settings.filterPlaceHolder),this.setMoveSelectedLabel(this.settings.moveSelectedLabel),this.setMoveAllLabel(this.settings.moveAllLabel),this.setRemoveSelectedLabel(this.settings.removeSelectedLabel),this.setRemoveAllLabel(this.settings.removeAllLabel),this.setMoveOnSelect(this.settings.moveOnSelect),this.setMoveOnDoubleClick(this.settings.moveOnDoubleClick),this.setPreserveSelectionOnMove(this.settings.preserveSelectionOnMove),this.setSelectedListLabel(this.settings.selectedListLabel),this.setNonSelectedListLabel(this.settings.nonSelectedListLabel),this.setHelperSelectNamePostfix(this.settings.helperSelectNamePostfix),this.setSelectOrMinimalHeight(this.settings.selectorMinimalHeight),c(this),this.setShowFilterInputs(this.settings.showFilterInputs),this.setNonSelectedFilter(this.settings.nonSelectedFilter),this.setSelectedFilter(this.settings.selectedFilter),this.setInfoText(this.settings.infoText),this.setInfoTextFiltered(this.settings.infoTextFiltered),this.setInfoTextEmpty(this.settings.infoTextEmpty),this.setFilterOnValues(this.settings.filterOnValues),this.setSortByInputOrder(this.settings.sortByInputOrder),this.setEventMoveOverride(this.settings.eventMoveOverride),this.setEventMoveAllOverride(this.settings.eventMoveAllOverride),this.setEventRemoveOverride(this.settings.eventRemoveOverride),this.setEventRemoveAllOverride(this.settings.eventRemoveAllOverride),this.element.hide(),O(this),u(this),this.element},setBootstrap2Compatible:function(e,t){return this.settings.bootstrap2Compatible=e,e?(this.container.removeClass("row").addClass("row-fluid bs2compatible"),this.container.find(".box1, .box2").removeClass("col-md-6").addClass("span6"),this.container.find(".clear1, .clear2").removeClass("btn-default btn-xs").addClass("btn-mini"),this.container.find("input, select").removeClass("form-control"),this.container.find(".btn").removeClass("btn-default"),this.container.find(".moveall > i, .move > i").removeClass("glyphicon glyphicon-arrow-right").addClass("icon-arrow-right"),this.container.find(".removeall > i, .remove > i").removeClass("glyphicon glyphicon-arrow-left").addClass("icon-arrow-left")):(this.container.removeClass("row-fluid bs2compatible").addClass("row"),this.container.find(".box1, .box2").removeClass("span6").addClass("col-md-6"),this.container.find(".clear1, .clear2").removeClass("btn-mini").addClass("btn-default btn-xs"),this.container.find("input, select").addClass("form-control"),this.container.find(".btn").addClass("btn-default"),this.container.find(".moveall > i, .move > i").removeClass("icon-arrow-right").addClass("glyphicon glyphicon-arrow-right"),this.container.find(".removeall > i, .remove > i").removeClass("icon-arrow-left").addClass("glyphicon glyphicon-arrow-left")),t&&u(this),this.element},setFilterTextClear:function(e,t){return this.settings.filterTextClear=e,this.elements.filterClear1.html(e),this.elements.filterClear2.html(e),t&&u(this),this.element},setFilterPlaceHolder:function(e,t){return this.settings.filterPlaceHolder=e,this.elements.filterInput1.attr("placeholder",e),this.elements.filterInput2.attr("placeholder",e),t&&u(this),this.element},setMoveSelectedLabel:function(e,t){return this.settings.moveSelectedLabel=e,this.elements.moveButton.attr("title",e),t&&u(this),this.element},setMoveAllLabel:function(e,t){return this.settings.moveAllLabel=e,this.elements.moveAllButton.attr("title",e),t&&u(this),this.element},setRemoveSelectedLabel:function(e,t){return this.settings.removeSelectedLabel=e,this.elements.removeButton.attr("title",e),t&&u(this),this.element},setRemoveAllLabel:function(e,t){return this.settings.removeAllLabel=e,this.elements.removeAllButton.attr("title",e),t&&u(this),this.element},setMoveOnSelect:function(e,t){if(o&&(e=!0),this.settings.moveOnSelect=e,this.settings.moveOnSelect){this.container.addClass("moveonselect");var n=this;this.elements.select1.on("change",(function(){b(n)})),this.elements.select2.on("change",(function(){x(n)}))}else this.container.removeClass("moveonselect"),this.elements.select1.off("change"),this.elements.select2.off("change");return t&&u(this),this.element},setMoveOnDoubleClick:function(e,t){if(o&&(e=!1),this.settings.moveOnDoubleClick=e,this.settings.moveOnDoubleClick){this.container.addClass("moveondoubleclick");var n=this;this.elements.select1.on("dblclick",(function(){b(n)})),this.elements.select2.on("dblclick",(function(){x(n)}))}else this.container.removeClass("moveondoubleclick"),this.elements.select1.off("dblclick"),this.elements.select2.off("dblclick");return t&&u(this),this.element},setPreserveSelectionOnMove:function(e,t){return o&&(e=!1),this.settings.preserveSelectionOnMove=e,t&&u(this),this.element},setSelectedListLabel:function(e,t){return this.settings.selectedListLabel=e,e?this.elements.label2.show().html(e):this.elements.label2.hide().html(e),t&&u(this),this.element},setNonSelectedListLabel:function(e,t){return this.settings.nonSelectedListLabel=e,e?this.elements.label1.show().html(e):this.elements.label1.hide().html(e),t&&u(this),this.element},setHelperSelectNamePostfix:function(e,t){return this.settings.helperSelectNamePostfix=e,e?(this.elements.select1.attr("name",this.originalSelectName+e+"1"),this.elements.select2.attr("name",this.originalSelectName+e+"2")):(this.elements.select1.removeAttr("name"),this.elements.select2.removeAttr("name")),t&&u(this),this.element},setSelectOrMinimalHeight:function(e,t){this.settings.selectorMinimalHeight=e;var n=this.element.height();return this.element.height()<e&&(n=e),this.elements.select1.height(n),this.elements.select2.height(n),t&&u(this),this.element},setShowFilterInputs:function(e,t){return e?(this.elements.filterInput1.show(),this.elements.filterInput2.show()):(this.setNonSelectedFilter(""),this.setSelectedFilter(""),u(this),this.elements.filterInput1.hide(),this.elements.filterInput2.hide()),this.settings.showFilterInputs=e,t&&u(this),this.element},setNonSelectedFilter:function(e,t){if(this.settings.showFilterInputs)return this.settings.nonSelectedFilter=e,this.elements.filterInput1.val(e),t&&u(this),this.element},setSelectedFilter:function(e,t){if(this.settings.showFilterInputs)return this.settings.selectedFilter=e,this.elements.filterInput2.val(e),t&&u(this),this.element},setInfoText:function(e,t){return this.settings.infoText=e,e?(this.elements.info1.show(),this.elements.info2.show()):(this.elements.info1.hide(),this.elements.info2.hide()),t&&u(this),this.element},setInfoTextFiltered:function(e,t){return this.settings.infoTextFiltered=e,t&&u(this),this.element},setInfoTextEmpty:function(e,t){return this.settings.infoTextEmpty=e,t&&u(this),this.element},setFilterOnValues:function(e,t){return this.settings.filterOnValues=e,t&&u(this),this.element},setSortByInputOrder:function(e,t){return this.settings.sortByInputOrder=e,t&&u(this),this.element},setEventMoveOverride:function(e,t){return this.settings.eventMoveOverride=e,t&&u(this),this.element},setEventMoveAllOverride:function(e,t){return this.settings.eventMoveAllOverride=e,t&&u(this),this.element},setEventRemoveOverride:function(e,t){return this.settings.eventRemoveOverride=e,t&&u(this),this.element},setEventRemoveAllOverride:function(e,t){return this.settings.eventRemoveAllOverride=e,t&&u(this),this.element},getContainer:function(){return this.container},refresh:function(e){var t;c(this),e?(t=this).elements.select1.find("option").each((function(){t.element.find("option").data("_selected",!1)})):(v(this,1),v(this,2)),u(this)},destroy:function(){return this.container.remove(),this.element.show(),e.data(this,"plugin_"+s,null),this.element}},e.fn[s]=function(t){var n,i=arguments;return void 0===t||"object"==typeof t?this.each((function(){e(this).is("select")?e.data(this,"plugin_"+s)||e.data(this,"plugin_"+s,new r(this,t)):e(this).find("select").each((function(n,i){e(i).bootstrapDualListbox(t)}))})):"string"==typeof t&&"_"!==t[0]&&"init"!==t?(this.each((function(){var l=e.data(this,"plugin_"+s);l instanceof r&&"function"==typeof l[t]&&(n=l[t].apply(l,Array.prototype.slice.call(i,1)))})),void 0!==n?n:this):void 0}}(jQuery,window,document)}}));