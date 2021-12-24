(self.webpackChunk=self.webpackChunk||[]).push([[756],{1698:(e,t,r)=>{"use strict";r.d(t,{Z:()=>c});var o=r(5166);const n={class:"w-lg-100 d-flex justify-content-center mt-lg-5"},a=(0,o.createVNode)("h3",null,"No data found",-1);const s={render:function(e,t,r,s,c,l){return(0,o.openBlock)(),(0,o.createBlock)("div",n,[a])}},c=s},3756:(e,t,r)=>{"use strict";r.r(t),r.d(t,{default:()=>Fe});var o=r(5166);const n={class:"container-fluid flex-grow-1 container-p-y"},a=(0,o.createVNode)("h4",{class:"font-weight-bold py-3 mb-4"},"Managers",-1),s={class:"d-flex mb-3"},c=(0,o.createVNode)("i",{class:"opacity-75 ion ion-md-refresh icon-refresh"},null,-1),l={key:0,class:"table-responsive d-flex align-items-start"},i={class:"d-flex flex-column align-items-center col-6"};var d=r(1698);const u={class:"datatables-demo table table-striped table-bordered col-6"};const p=(0,o.createVNode)("tr",{class:"d-flex"},[(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"Created"),(0,o.createVNode)("th",{class:"text-left col-4 font-weight-bold"},"Login"),(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"Role"),(0,o.createVNode)("th",{class:"text-left col-2 font-weight-bold"},"Actions")],-1);const f={render:function(e,t,r,n,a,s){return(0,o.openBlock)(),(0,o.createBlock)("thead",null,[p])}},m=f,g={class:"col-3"},b={class:"col-4"},y={class:"col-3"},h={class:"d-flex col-2 justify-content-between align-items-center"};var v=r(7757),k=r.n(v),N=r(6564);function V(e,t,r,o,n,a,s){try{var c=e[a](s),l=c.value}catch(e){return void r(e)}c.done?t(l):Promise.resolve(l).then(o,n)}function w(e){return function(){var t=this,r=arguments;return new Promise((function(o,n){var a=e.apply(t,r);function s(e){V(a,o,n,s,c,"next",e)}function c(e){V(a,o,n,s,c,"throw",e)}s(void 0)}))}}const B={setup:function(e){var t=(0,N.oR)(),r=(0,o.inject)("emitter"),n=(0,o.inject)("container"),a="delete-user-"+e.user.id;function s(){return(s=w(k().mark((function e(){var t;return k().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:t={message:i(),event_id:a,action:"deleted"},r.emit("show-delete-modal",t);case 2:case"end":return e.stop()}}),e)})))).apply(this,arguments)}function c(){return l.apply(this,arguments)}function l(){return(l=w(k().mark((function o(){return k().wrap((function(o){for(;;)switch(o.prev=o.next){case 0:return o.prev=0,o.next=3,n.UserService.deleteUser(e.user);case 3:r.emit("notification-success"," manager "+e.user.login+" was deleted"),t.dispatch("user/deleteUser",e.user),o.next=11;break;case 7:o.prev=7,o.t0=o.catch(0),console.log(o.t0),r.emit("notification-error",o.t0.response.data);case 11:case"end":return o.stop()}}),o,null,[[0,7]])})))).apply(this,arguments)}function i(){var t="You want to delete manager: ";return t=e.user.login?t+"<strong>"+e.user.login+"</strong>":t+"<strong>"+e.user.role+"</strong>"}return r.on(a,c),(0,o.onBeforeUnmount)((function(){return r.off(a,c)})),{deleteWarning:function(){return s.apply(this,arguments)}}},props:{user:Object},render:function(e,t,r,n,a,s){return(0,o.openBlock)(),(0,o.createBlock)("a",{"data-toggle":"modal","data-target":"#deleteForm",onClick:t[1]||(t[1]=(...e)=>n.deleteWarning(...e)),type:"button",class:"fas fa-trash-alt danger"})}},O=B,j=(0,o.createVNode)("a",{type:"button",class:"fas fa-user-edit p-0 bg-transparent border-0",title:"Edit","data-toggle":"tooltip","data-placement":"right"},null,-1);const x={setup:function(e){var t=(0,o.inject)("emitter");return{showEditManagerForm:function(){return t.emit("edit-manager-form",e.user)}}},props:{user:Object},render:function(e,t,r,n,a,s){return(0,o.openBlock)(),(0,o.createBlock)("a",{"data-toggle":"modal","data-target":"#editManagerForm",onClick:t[1]||(t[1]=(...e)=>n.showEditManagerForm(...e))},[j])}},C={setup:function(){var e=(0,N.oR)();return{profile:(0,o.computed)((function(){return e.getters.getProfile}))}},props:{user:Object},components:{DeleteButton:O,EditButton:x},render:function(e,t,r,n,a,s){const c=(0,o.resolveComponent)("EditButton"),l=(0,o.resolveComponent)("DeleteButton");return(0,o.openBlock)(),(0,o.createBlock)("tr",{class:["d-flex",{"d-none":r.user.login===n.profile.login}]},[(0,o.createVNode)("td",g,(0,o.toDisplayString)(r.user.created_at),1),(0,o.createVNode)("td",b,(0,o.toDisplayString)(r.user.login),1),(0,o.createVNode)("td",y,(0,o.toDisplayString)(r.user.role),1),(0,o.createVNode)("td",h,[(0,o.createVNode)(c,{user:r.user},null,8,["user"]),(0,o.createVNode)(l,{user:r.user},null,8,["user"])])],2)}},F={setup:function(){var e=(0,N.oR)();return{users:(0,o.computed)((function(){return e.getters.getUsers}))}},components:{ManagersTableHead:m,ManagersTableRow:C},render:function(e,t,r,n,a,s){const c=(0,o.resolveComponent)("ManagersTableHead"),l=(0,o.resolveComponent)("ManagersTableRow");return(0,o.openBlock)(),(0,o.createBlock)("table",u,[(0,o.createVNode)(c),(0,o.createVNode)("tbody",null,[((0,o.openBlock)(!0),(0,o.createBlock)(o.Fragment,null,(0,o.renderList)(n.users,(e=>((0,o.openBlock)(),(0,o.createBlock)(l,{key:e.id+e.login,user:e},null,8,["user"])))),128))])])}},M=F,S={key:0,class:"datatables-demo table table-striped table-bordered col-9"},P=(0,o.createVNode)("thead",null,[(0,o.createVNode)("tr",{class:"d-flex"},[(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"HR"),(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"All"),(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"Hired"),(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"Conversion")])],-1);const _={class:"d-flex"},U={class:"col-3"},R={class:"col-3"},D={class:"col-3"},E={key:0,class:"col-3"},T={key:1,class:"col-3"};const H={props:{user:Object},render:function(e,t,r,n,a,s){return(0,o.openBlock)(),(0,o.createBlock)("tr",_,[(0,o.createVNode)("td",U,(0,o.toDisplayString)(r.user.login),1),(0,o.createVNode)("td",R,(0,o.toDisplayString)(r.user.hr_employees_count),1),(0,o.createVNode)("td",D,(0,o.toDisplayString)(r.user.good_hr_employees_count),1),r.user.good_hr_employees_count>0?((0,o.openBlock)(),(0,o.createBlock)("td",E,(0,o.toDisplayString)((r.user.good_hr_employees_count/r.user.hr_employees_count*100).toFixed(2))+"% ",1)):((0,o.openBlock)(),(0,o.createBlock)("td",T," 0%"))])}},A={setup:function(){var e=(0,N.oR)();(0,o.computed)((function(){return e.getters.getProfile}));return{users:(0,o.computed)((function(){return e.getters.getHrs}))}},components:{Row:H},render:function(e,t,r,n,a,s){const c=(0,o.resolveComponent)("Row");return Object.keys(n.users).length>0?((0,o.openBlock)(),(0,o.createBlock)("table",S,[P,(0,o.createVNode)("tbody",null,[((0,o.openBlock)(!0),(0,o.createBlock)(o.Fragment,null,(0,o.renderList)(n.users,(e=>((0,o.openBlock)(),(0,o.createBlock)(c,{key:e.id,user:e},null,8,["user"])))),128))])])):(0,o.createCommentVNode)("",!0)}},I=A,L={key:0,class:"datatables-demo table table-striped table-bordered col-9"},Z=(0,o.createVNode)("thead",null,[(0,o.createVNode)("tr",{class:"d-flex"},[(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"Personnel"),(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"All"),(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"Exported"),(0,o.createVNode)("th",{class:"text-left col-3 font-weight-bold"},"Conversion")])],-1);const W={class:"d-flex"},Y={class:"col-3"},q={class:"col-3"},z={class:"col-3"},G={key:0,class:"col-3"},J={key:1,class:"col-3"};const K={props:{user:Object},render:function(e,t,r,n,a,s){return(0,o.openBlock)(),(0,o.createBlock)("tr",W,[(0,o.createVNode)("td",Y,(0,o.toDisplayString)(r.user.login),1),(0,o.createVNode)("td",q,(0,o.toDisplayString)(r.user.personnel_employees_count),1),(0,o.createVNode)("td",z,(0,o.toDisplayString)(r.user.exported_personnel_employees_count),1),r.user.exported_personnel_employees_count>0?((0,o.openBlock)(),(0,o.createBlock)("td",G,(0,o.toDisplayString)((r.user.exported_personnel_employees_count/r.user.personnel_employees_count*100).toFixed(2))+"% ",1)):((0,o.openBlock)(),(0,o.createBlock)("td",J," 0% "))])}},Q={setup:function(){var e=(0,N.oR)();return{users:(0,o.computed)((function(){return e.getters.getPersonnels}))}},components:{Row:K},render:function(e,t,r,n,a,s){const c=(0,o.resolveComponent)("Row");return Object.keys(n.users).length>0?((0,o.openBlock)(),(0,o.createBlock)("table",L,[Z,(0,o.createVNode)("tbody",null,[((0,o.openBlock)(!0),(0,o.createBlock)(o.Fragment,null,(0,o.renderList)(n.users,(e=>((0,o.openBlock)(),(0,o.createBlock)(c,{key:e.id,user:e},null,8,["user"])))),128))])])):(0,o.createCommentVNode)("",!0)}},X={setup:function(){var e=(0,N.oR)(),t=(0,o.inject)("emitter");return{showManagerStoreForm:function(){return t.emit("create-manager-form")},users:(0,o.computed)((function(){return e.getters.getUsers})),refresh:function(){return e.dispatch("user/setUsersToStore")}}},components:{Managers:M,HrStatistics:I,PersonnelStatistics:Q,NoRecords:d.Z},render:function(e,t,r,d,u,p){const f=(0,o.resolveComponent)("Managers"),m=(0,o.resolveComponent)("PersonnelStatistics"),g=(0,o.resolveComponent)("HrStatistics"),b=(0,o.resolveComponent)("NoRecords");return(0,o.openBlock)(),(0,o.createBlock)("div",n,[a,(0,o.createVNode)("div",s,[(0,o.createVNode)("button",{onClick:t[1]||(t[1]=(...e)=>d.refresh(...e)),class:"btn btn-secondary",type:"button",title:"Refresh"},[c]),(0,o.createVNode)("button",{onClick:t[2]||(t[2]=(0,o.withModifiers)(((...e)=>d.showManagerStoreForm(...e)),["prevent"])),class:"btn btn-primary btn ml-2","data-toggle":"modal","data-target":"#addManagerForm"}," Add manager ")]),Object.keys(d.users).length>0?((0,o.openBlock)(),(0,o.createBlock)("div",l,[(0,o.createVNode)(f),(0,o.createVNode)("div",i,[(0,o.createVNode)(m),(0,o.createVNode)(g)])])):((0,o.openBlock)(),(0,o.createBlock)(b,{key:1}))])}},$=X,ee={class:"modal fade",id:"addManagerForm"},te={class:"modal-dialog"},re={class:"modal-content"},oe=(0,o.createVNode)("div",{class:"modal-header"},[(0,o.createVNode)("h5",{class:"modal-title"}," Add manager "),(0,o.createVNode)("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},"×")],-1),ne={class:"modal-body"},ae={class:"modal-footer"},se=(0,o.createVNode)("button",{id:"storeUserFormClose",type:"button",class:"btn btn-default","data-dismiss":"modal"},"Close ",-1);var ce=r(7076);function le(e,t,r,o,n,a,s){try{var c=e[a](s),l=c.value}catch(e){return void r(e)}c.done?t(l):Promise.resolve(l).then(o,n)}function ie(e){return function(){var t=this,r=arguments;return new Promise((function(o,n){var a=e.apply(t,r);function s(e){le(a,o,n,s,c,"next",e)}function c(e){le(a,o,n,s,c,"throw",e)}s(void 0)}))}}function de(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,o)}return r}function ue(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?de(Object(r),!0).forEach((function(t){pe(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):de(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function pe(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}const fe={setup:function(){var e=(0,N.oR)(),t=(0,o.inject)("container"),r=(0,o.inject)("emitter"),n=(0,o.ref)(null),a=ue({},e.getters.getEmptyUser),s=(0,o.reactive)(ue({},a));function c(){return(c=ie(k().mark((function o(){var a;return k().wrap((function(o){for(;;)switch(o.prev=o.next){case 0:return o.prev=0,o.next=3,n.value.validate();case 3:return o.next=5,t.UserService.storeUser(s);case 5:a=o.sent,e.commit("user/setUserById",a.data.model),document.getElementById("storeUserFormClose").click(),r.emit("notification-success","manager was added"),l(),o.next=15;break;case 12:o.prev=12,o.t0=o.catch(0),o.t0.response.data&&r.emit("notification-error",o.t0.response.data);case 15:case"end":return o.stop()}}),o,null,[[0,12]])})))).apply(this,arguments)}function l(){Object.keys(a).forEach((function(e){return s[e]=a[e]}))}return r.on("create-manager-form",l),(0,o.onBeforeUnmount)((function(){return r.off("create-manager-form",l)})),{manager:s,managerFields:n,storeManager:function(){return c.apply(this,arguments)}}},components:{ManagerFormFields:ce.Z},render:function(e,t,r,n,a,s){const c=(0,o.resolveComponent)("ManagerFormFields");return(0,o.openBlock)(),(0,o.createBlock)("div",ee,[(0,o.createVNode)("div",te,[(0,o.createVNode)("form",re,[oe,(0,o.createVNode)("div",ne,[(0,o.createVNode)(c,{ref:"managerFields",user:n.manager,"show-role-field":!0},null,8,["user"])]),(0,o.createVNode)("div",ae,[se,(0,o.createVNode)("button",{onClick:t[1]||(t[1]=(0,o.withModifiers)(((...e)=>n.storeManager(...e)),["prevent"])),type:"button",class:"btn btn-primary"},"Add ")])])])])}},me=fe,ge={class:"modal fade",id:"editManagerForm"},be={class:"modal-dialog"},ye={class:"modal-content"},he=(0,o.createVNode)("div",{class:"modal-header"},[(0,o.createVNode)("h5",{class:"modal-title"}," Edit manager "),(0,o.createVNode)("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},"×")],-1),ve={class:"modal-body"},ke={class:"modal-footer"},Ne=(0,o.createVNode)("button",{id:"editUserFormClose",type:"button",class:"btn btn-default","data-dismiss":"modal"},"Close ",-1);function Ve(e,t,r,o,n,a,s){try{var c=e[a](s),l=c.value}catch(e){return void r(e)}c.done?t(l):Promise.resolve(l).then(o,n)}function we(e){return function(){var t=this,r=arguments;return new Promise((function(o,n){var a=e.apply(t,r);function s(e){Ve(a,o,n,s,c,"next",e)}function c(e){Ve(a,o,n,s,c,"throw",e)}s(void 0)}))}}function Be(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,o)}return r}function Oe(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?Be(Object(r),!0).forEach((function(t){je(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):Be(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function je(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}const xe={setup:function(){var e=(0,N.oR)(),t=(0,o.inject)("container"),r=(0,o.inject)("emitter"),n=(0,o.ref)(null),a=Oe({},e.getters.getEmptyUser),s=(0,o.reactive)(Oe({},a));function c(){return(c=we(k().mark((function o(){return k().wrap((function(o){for(;;)switch(o.prev=o.next){case 0:return o.prev=0,o.next=3,n.value.validate();case 3:return null!==s.password&&void 0!==s.password||delete s.password,delete s.dataIsValid,delete s.avatar,o.next=8,t.UserService.updateUser(s);case 8:e.commit("user/setUserById",s),r.emit("notification-success","manager was updated"),document.getElementById("editUserFormClose").click(),o.next=17;break;case 13:o.prev=13,o.t0=o.catch(0),console.log(o.t0),o.t0.response.data&&r.emit("notification-error",o.t0.response.data);case 17:case"end":return o.stop()}}),o,null,[[0,13]])})))).apply(this,arguments)}function l(e){Object.keys(e).forEach((function(t){return s[t]=e[t]})),s.password=null}return r.on("edit-manager-form",l),(0,o.onBeforeUnmount)((function(){return r.off("edit-manager-form",l)})),{manager:s,managerFields:n,updateManager:function(){return c.apply(this,arguments)}}},components:{ManagerFormFields:ce.Z},render:function(e,t,r,n,a,s){const c=(0,o.resolveComponent)("ManagerFormFields");return(0,o.openBlock)(),(0,o.createBlock)("div",ge,[(0,o.createVNode)("div",be,[(0,o.createVNode)("form",ye,[he,(0,o.createVNode)("div",ve,[(0,o.createVNode)(c,{ref:"managerFields",user:n.manager,"show-role-field":!0},null,8,["user"])]),(0,o.createVNode)("div",ke,[Ne,(0,o.createVNode)("button",{type:"button",class:"btn btn-primary",onClick:t[1]||(t[1]=(...e)=>n.updateManager(...e))},"Update ")])])])])}},Ce={setup:function(){var e=(0,N.oR)(),t=0===Object.keys(e.getters.getUsers).length,r=0===Object.keys(e.getters.getCompanies).length,o=0===Object.keys(e.getters.getRoles).length,n=0===Object.keys(e.getters.getEmployees).length;r&&e.dispatch("company/setCompaniesToStore"),t&&e.dispatch("user/setUsersToStore"),n&&e.dispatch("employee/setEmployeesToStore"),o&&e.dispatch("user/setRolesToStore")},components:{ManagersTableBundle:$,StoreManagerForm:me,EditManagerForm:xe},render:function(e,t,r,n,a,s){const c=(0,o.resolveComponent)("ManagersTableBundle"),l=(0,o.resolveComponent)("StoreManagerForm"),i=(0,o.resolveComponent)("EditManagerForm");return(0,o.openBlock)(),(0,o.createBlock)(o.Fragment,null,[(0,o.createVNode)(c),(0,o.createVNode)(l),(0,o.createVNode)(i)],64)}},Fe=Ce}}]);