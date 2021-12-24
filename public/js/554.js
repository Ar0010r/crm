(self.webpackChunk=self.webpackChunk||[]).push([[554],{1698:(e,t,o)=>{"use strict";o.d(t,{Z:()=>a});var r=o(5166);const n={class:"w-lg-100 d-flex justify-content-center mt-lg-5"},l=(0,r.createVNode)("h3",null,"No data found",-1);const c={render:function(e,t,o,c,a,s){return(0,r.openBlock)(),(0,r.createBlock)("div",n,[l])}},a=c},7417:(e,t,o)=>{"use strict";o.d(t,{Z:()=>V});var r=o(5166);const n={class:"modal fade",id:"addLetterForm"},l={class:"modal-dialog"},c={class:"modal-content"},a=(0,r.createVNode)("div",{class:"modal-header"},[(0,r.createVNode)("h5",{class:"modal-title"}," Add letters info "),(0,r.createVNode)("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},"×")],-1),s={class:"modal-body"},i={class:"modal-footer"},d=(0,r.createVNode)("button",{id:"storeLetterFormClose",type:"button",class:"btn btn-default","data-dismiss":"modal"},"Close ",-1);var u=o(7757),f=o.n(u),p=o(1210),m=o(6564);function h(e,t,o,r,n,l,c){try{var a=e[l](c),s=a.value}catch(e){return void o(e)}a.done?t(s):Promise.resolve(s).then(r,n)}function g(e){return function(){var t=this,o=arguments;return new Promise((function(r,n){var l=e.apply(t,o);function c(e){h(l,r,n,c,a,"next",e)}function a(e){h(l,r,n,c,a,"throw",e)}c(void 0)}))}}function v(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,r)}return o}function b(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?v(Object(o),!0).forEach((function(t){y(e,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):v(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}function y(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}const k={setup:function(){var e=(0,m.oR)(),t=(0,r.inject)("container"),o=(0,r.inject)("emitter"),n=(0,r.ref)(null),l=(0,r.computed)((function(){return e.getters.getProfile})),c=b({},e.getters.getEmptyLetter);"hr"!==l.value.role&&"top hr"!==l.value.role||(c.hr_id=l.value.id),console.log("emptyLetter",c);var a=(0,r.reactive)(b({},c));function s(){return(s=g(f().mark((function r(){var l;return f().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return r.prev=0,r.next=3,n.value.validate();case 3:return r.next=5,t.LetterService.store(a);case 5:l=r.sent,console.log("wgdgds",l.data.model),e.commit("letter/setLetterById",l.data.model),document.getElementById("storeLetterFormClose").click(),o.emit("notification-success","letter was added"),i(),r.next=16;break;case 13:r.prev=13,r.t0=r.catch(0),r.t0.response.data&&o.emit("notification-error",r.t0.response.data);case 16:case"end":return r.stop()}}),r,null,[[0,13]])})))).apply(this,arguments)}function i(){Object.keys(c).forEach((function(e){return a[e]=c[e]}))}return o.on("create-letter-form",i),(0,r.onBeforeUnmount)((function(){return o.off("create-letter-form",i)})),{letter:a,letterFields:n,storeLetter:function(){return s.apply(this,arguments)}}},components:{LetterFormFields:p.Z},render:function(e,t,o,u,f,p){const m=(0,r.resolveComponent)("LetterFormFields");return(0,r.openBlock)(),(0,r.createBlock)("div",n,[(0,r.createVNode)("div",l,[(0,r.createVNode)("form",c,[a,(0,r.createVNode)("div",s,[(0,r.createVNode)(m,{ref:"letterFields",letter:u.letter},null,8,["letter"])]),(0,r.createVNode)("div",i,[d,(0,r.createVNode)("button",{onClick:t[1]||(t[1]=(0,r.withModifiers)(((...e)=>u.storeLetter(...e)),["prevent"])),type:"button",class:"btn btn-primary"},"Add ")])])])])}},V=k},6151:(e,t,o)=>{"use strict";o.d(t,{Z:()=>V});var r=o(5166);const n={class:"modal fade",id:"editLetterForm"},l={class:"modal-dialog"},c={class:"modal-content"},a=(0,r.createVNode)("div",{class:"modal-header"},[(0,r.createVNode)("h5",{class:"modal-title"}," Edit letter "),(0,r.createVNode)("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},"×")],-1),s={class:"modal-body"},i={class:"modal-footer"},d=(0,r.createVNode)("button",{id:"editLetterFormClose",type:"button",class:"btn btn-default","data-dismiss":"modal"},"Close ",-1);var u=o(7757),f=o.n(u),p=o(1210),m=o(6564);function h(e,t,o,r,n,l,c){try{var a=e[l](c),s=a.value}catch(e){return void o(e)}a.done?t(s):Promise.resolve(s).then(r,n)}function g(e){return function(){var t=this,o=arguments;return new Promise((function(r,n){var l=e.apply(t,o);function c(e){h(l,r,n,c,a,"next",e)}function a(e){h(l,r,n,c,a,"throw",e)}c(void 0)}))}}function v(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,r)}return o}function b(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?v(Object(o),!0).forEach((function(t){y(e,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):v(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}function y(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}const k={setup:function(){var e=(0,m.oR)(),t=(0,r.inject)("container"),o=(0,r.inject)("emitter"),n=(0,r.ref)(null),l=b({},e.getters.getEmptyLetter),c=(0,r.reactive)(b({},l));function a(){return(a=g(f().mark((function r(){return f().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return r.prev=0,r.next=3,n.value.validate();case 3:return r.next=5,t.LetterService.update(c);case 5:e.commit("letter/setLetterById",c),o.emit("notification-success","letter was updated"),document.getElementById("editLetterFormClose").click(),r.next=14;break;case 10:r.prev=10,r.t0=r.catch(0),console.log(r.t0),r.t0.response.data&&o.emit("notification-error",r.t0.response.data);case 14:case"end":return r.stop()}}),r,null,[[0,10]])})))).apply(this,arguments)}function s(e){Object.keys(e).forEach((function(t){return c[t]=e[t]})),c.password=null}return o.on("edit-letter-form",s),(0,r.onBeforeUnmount)((function(){return o.off("edit-letter-form",s)})),{letter:c,letterFields:n,updateLetter:function(){return a.apply(this,arguments)}}},components:{LetterFormFields:p.Z},render:function(e,t,o,u,f,p){const m=(0,r.resolveComponent)("LetterFormFields");return(0,r.openBlock)(),(0,r.createBlock)("div",n,[(0,r.createVNode)("div",l,[(0,r.createVNode)("form",c,[a,(0,r.createVNode)("div",s,[(0,r.createVNode)(m,{ref:"letterFields",letter:u.letter,"show-role-field":!0},null,8,["letter"])]),(0,r.createVNode)("div",i,[d,(0,r.createVNode)("button",{type:"button",class:"btn btn-primary",onClick:t[1]||(t[1]=(...e)=>u.updateLetter(...e))},"Update ")])])])])}},V=k},1210:(e,t,o)=>{"use strict";o.d(t,{Z:()=>R});var r=o(5166);const n={class:"form-row mb-2 d-flex flex-column"},l={key:0,id:"letterHrField",class:"form-row mb-2 d-flex flex-column"},c={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},a=(0,r.createVNode)("label",{class:"form-label col-md-2"},"Hr",-1),s=(0,r.createVNode)("option",{disabled:"",selected:"",value:null}," -- select hr --",-1),i=(0,r.createVNode)("small",{class:"col-md-12 invalid-feedback text-right p-0"},"please select hr",-1),d={class:"form-row mb-2 d-flex flex-column"},u={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},f=(0,r.createVNode)("label",{class:"form-label col-md-2"},"Google",-1),p={class:" col-md-12 invalid-feedback text-right p-0"},m={class:"form-row mb-2 d-flex flex-column"},h={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},g=(0,r.createVNode)("label",{class:"form-label col-md-2"},"Yahoo",-1),v={class:" col-md-12 invalid-feedback text-right p-0"},b={class:"form-row mb-2 d-flex flex-column"},y={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},k=(0,r.createVNode)("label",{class:"form-label col-md-2"},"Outlook",-1),V={class:" col-md-12 invalid-feedback text-right p-0"},N={class:"form-row mb-2 d-flex flex-column"},w={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},B=(0,r.createVNode)("label",{class:"form-label col-md-2"},"Other",-1),x={class:" col-md-12 invalid-feedback text-right p-0"},L={class:"form-row mb-2 d-flex flex-column"},C={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},O=(0,r.createVNode)("label",{class:"form-label col-md-2"},"Received",-1),j={class:" col-md-12 invalid-feedback text-right p-0"};var P=o(7757),_=o.n(P),D=o(6564),F=o(2954),S=o(7561);function I(e,t,o,r,n,l,c){try{var a=e[l](c),s=a.value}catch(e){return void o(e)}a.done?t(s):Promise.resolve(s).then(r,n)}function H(e){return function(){var t=this,o=arguments;return new Promise((function(r,n){var l=e.apply(t,o);function c(e){I(l,r,n,c,a,"next",e)}function a(e){I(l,r,n,c,a,"throw",e)}c(void 0)}))}}const T={setup:function(e){var t=(0,D.oR)(),o=(0,r.inject)("emitter"),n=S.Ry({hr:S.Z_().nullable().required(),google:S.Z_().required().trim().matches("^[0-9]*$","please enter numeric amount of letters you received"),yahoo:S.Z_().required().trim().matches("^[0-9]*$","please enter numeric amount of letters you received"),outlook:S.Z_().required().trim().matches("^[0-9]*$","please enter numeric amount of letters you received"),other:S.Z_().required().trim().matches("^[0-9]*$","please enter numeric amount of letters you received"),received:S.Z_().nullable().matches("^((?:19|20)[0-9][0-9])-(0[1-9]|1[012])-([12][0-9]|3[01]|0[1-9])$","valid date format is yyyy-mm-dd")}),l=(0,F.cI)({validationSchema:n.nullable()}),c=l.errors,a=l.validate,s=(0,F.U$)("google",{value:(0,r.computed)((function(){return e.letter.google}))}),i=(0,F.U$)("yahoo",{value:(0,r.computed)((function(){return e.letter.yahoo}))}),d=(0,F.U$)("outlook",{value:(0,r.computed)((function(){return e.letter.outlook}))}),u=(0,F.U$)("other",{value:(0,r.computed)((function(){return e.letter.other}))}),f=(0,F.U$)("received_at",{value:(0,r.computed)((function(){return e.letter.received_at}))}),p=(0,F.U$)("hr_id",{value:(0,r.computed)((function(){return e.letter.hr_id}))}),m=[{field:s,name:"google"},{field:i,name:"yahoo"},{field:d,name:"outlook"},{field:u,name:"other"},{field:f,name:"received_at"},{field:p,name:"hr_id"}];function h(){[s,i,d,u].forEach((function(e){e.value.value=0}));var t=new Date,o=t.getDate(),r=t.getMonth()+1,n=t.getFullYear();o<10&&(o="0"+o),r<10&&(r="0"+r),f.value.value=n+"-"+r+"-"+o,m.forEach((function(t){e.letter[t.name]=t.field.value.value}))}function g(){return(g=H(_().mark((function t(){var o;return _().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return m.forEach((function(t){t.field.meta.dirty=!0,t.field.meta.touched=!0,t.field.value.value=e.letter[t.name]})),t.next=3,a();case 3:if((o=t.sent).valid){t.next=6;break}throw{message:"Please fix form errors:",errors:Object.keys(o.errors).map((function(e){return[o.errors[e]]}))};case 6:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function v(){m.forEach((function(t){return t.field.value.value=e.letter[t.name]}))}return o.on("create-letter-form",h),o.on("edit-letter-form",v),(0,r.onBeforeUnmount)((function(){o.off("create-letter-form",h),o.off("edit-letter-form",v)})),{schema:n,errors:c,validate:function(){return g.apply(this,arguments)},google:s,yahoo:i,outlook:d,other:u,received:f,hr:p,hrs:(0,r.computed)((function(){return t.getters.getHrs})),profile:(0,r.computed)((function(){return t.getters.getProfile}))}},props:{letter:Object},render:function(e,t,o,P,_,D){return(0,r.openBlock)(),(0,r.createBlock)("div",n,["admin"===P.profile.role?((0,r.openBlock)(),(0,r.createBlock)("div",l,[(0,r.createVNode)("div",c,[a,(0,r.withDirectives)((0,r.createVNode)("select",{class:["custom-select form-control form-control-sm col-md-10",{"is-invalid":!P.hr.meta.valid&&P.hr.meta.touched}],name:"hr","onUpdate:modelValue":t[1]||(t[1]=e=>o.letter.hr_id=e),onFocus:t[2]||(t[2]=e=>P.hr.meta.touched=!1),onChange:t[3]||(t[3]=(...e)=>P.hr.handleChange(...e)),onBlur:t[4]||(t[4]=(...e)=>P.hr.handleBlur(...e))},[s,((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,null,(0,r.renderList)(P.hrs,(e=>((0,r.openBlock)(),(0,r.createBlock)("option",{selected:o.letter.hr_id===e.id,value:e.id},(0,r.toDisplayString)(e.login),9,["selected","value"])))),256))],34),[[r.vModelSelect,o.letter.hr_id]]),i])])):(0,r.createCommentVNode)("",!0),(0,r.createVNode)("div",d,[(0,r.createVNode)("div",u,[f,(0,r.withDirectives)((0,r.createVNode)("input",{class:["form-control col-md-10",{"is-invalid":!P.google.meta.valid&&P.google.meta.touched}],type:"text",placeholder:"Google",name:"google","onUpdate:modelValue":t[5]||(t[5]=e=>o.letter.google=e),onFocus:t[6]||(t[6]=e=>P.google.meta.touched=!1),onInput:t[7]||(t[7]=(...e)=>P.google.handleChange(...e)),onBlur:t[8]||(t[8]=(...e)=>P.google.handleBlur(...e))},null,34),[[r.vModelText,o.letter.google]]),(0,r.createVNode)("small",p,(0,r.toDisplayString)(P.errors.google||"google is required"),1)])]),(0,r.createVNode)("div",m,[(0,r.createVNode)("div",h,[g,(0,r.withDirectives)((0,r.createVNode)("input",{class:["form-control col-md-10",{"is-invalid":!P.yahoo.meta.valid&&P.yahoo.meta.touched}],type:"text",placeholder:"Yahoo",name:"yahoo","onUpdate:modelValue":t[9]||(t[9]=e=>o.letter.yahoo=e),onFocus:t[10]||(t[10]=e=>P.yahoo.meta.touched=!1),onInput:t[11]||(t[11]=(...e)=>P.yahoo.handleChange(...e)),onBlur:t[12]||(t[12]=(...e)=>P.yahoo.handleBlur(...e))},null,34),[[r.vModelText,o.letter.yahoo]]),(0,r.createVNode)("small",v,(0,r.toDisplayString)(P.errors.yahoo||"yahoo is required"),1)])]),(0,r.createVNode)("div",b,[(0,r.createVNode)("div",y,[k,(0,r.withDirectives)((0,r.createVNode)("input",{class:["form-control col-md-10",{"is-invalid":!P.outlook.meta.valid&&P.outlook.meta.touched}],type:"text",placeholder:"Outlook",name:"outlook","onUpdate:modelValue":t[13]||(t[13]=e=>o.letter.outlook=e),onFocus:t[14]||(t[14]=e=>P.outlook.meta.touched=!1),onInput:t[15]||(t[15]=(...e)=>P.outlook.handleChange(...e)),onBlur:t[16]||(t[16]=(...e)=>P.outlook.handleBlur(...e))},null,34),[[r.vModelText,o.letter.outlook]]),(0,r.createVNode)("small",V,(0,r.toDisplayString)(P.errors.outlook||"outlook is required"),1)])]),(0,r.createVNode)("div",N,[(0,r.createVNode)("div",w,[B,(0,r.withDirectives)((0,r.createVNode)("input",{class:["form-control col-md-10",{"is-invalid":!P.other.meta.valid&&P.other.meta.touched}],type:"text",placeholder:"Other",name:"other","onUpdate:modelValue":t[17]||(t[17]=e=>o.letter.other=e),onFocus:t[18]||(t[18]=e=>P.other.meta.touched=!1),onInput:t[19]||(t[19]=(...e)=>P.other.handleChange(...e)),onBlur:t[20]||(t[20]=(...e)=>P.other.handleBlur(...e))},null,34),[[r.vModelText,o.letter.other]]),(0,r.createVNode)("small",x,(0,r.toDisplayString)(P.errors.other||"other is required"),1)])]),(0,r.createVNode)("div",L,[(0,r.createVNode)("div",C,[O,(0,r.withDirectives)((0,r.createVNode)("input",{class:["form-control col-md-10",{"is-invalid":!P.received.meta.valid&&P.received.meta.touched}],type:"text",placeholder:"Received",name:"received_at","onUpdate:modelValue":t[21]||(t[21]=e=>o.letter.received_at=e),onFocus:t[22]||(t[22]=e=>P.received.meta.touched=!1),onInput:t[23]||(t[23]=(...e)=>P.received.handleChange(...e)),onBlur:t[24]||(t[24]=(...e)=>P.received.handleBlur(...e))},null,34),[[r.vModelText,o.letter.received_at]]),(0,r.createVNode)("small",j,(0,r.toDisplayString)(P.errors.received_at||"received_at is required"),1)])])])}},R=T},554:(e,t,o)=>{"use strict";o.r(t),o.d(t,{default:()=>De});var r=o(5166);const n={class:"container-fluid flex-grow-1 container-p-y"},l=(0,r.createVNode)("h4",{class:"font-weight-bold py-3 mb-4"}," Mails ",-1),c={key:0,class:" table-responsive d-flex align-items-start"};const a={class:"datatables-demo table table-striped table-bordered col-6"};const s=(0,r.createVNode)("tr",{class:""},[(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Received"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Hr"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Google"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Outlook"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Yahoo"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Other"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Total"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Actions")],-1);const i={render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("thead",null,[s])}},d=i,u=(0,r.createVNode)("tr",{class:""},[(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Received"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Google"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Outlook"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Yahoo"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Other"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Actions")],-1);const f={render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("thead",null,[u])}},p=f;var m=o(6564);const h={setup:function(){var e=(0,m.oR)();return{profileIsAdmin:(0,r.computed)((function(){return"admin"===e.getters.getProfile.role})),profileIsPersonnel:(0,r.computed)((function(){return"personnel"===e.getters.getProfile.role})),profileIsHr:(0,r.computed)((function(){return"hr"===e.getters.getProfile.role||"top hr"===e.getters.getProfile.role}))}},components:{AdminHead:d,HrHead:p},render:function(e,t,o,n,l,c){const a=(0,r.resolveComponent)("HrHead"),s=(0,r.resolveComponent)("AdminHead");return(0,r.openBlock)(),(0,r.createBlock)(r.Fragment,null,[n.profileIsHr?((0,r.openBlock)(),(0,r.createBlock)(a,{key:0})):(0,r.createCommentVNode)("",!0),n.profileIsPersonnel||n.profileIsAdmin?((0,r.openBlock)(),(0,r.createBlock)(s,{key:1})):(0,r.createCommentVNode)("",!0)],64)}},g=h,v={class:"d-flex mb-3 mt-2"},b=(0,r.createVNode)("i",{class:"opacity-75 ion ion-md-refresh icon-refresh"},null,-1),y=(0,r.createVNode)("option",{value:"",selected:""},"Hr",-1);var k=o(7757),V=o.n(k);function N(e,t,o,r,n,l,c){try{var a=e[l](c),s=a.value}catch(e){return void o(e)}a.done?t(s):Promise.resolve(s).then(r,n)}function w(e){return function(){var t=this,o=arguments;return new Promise((function(r,n){var l=e.apply(t,o);function c(e){N(l,r,n,c,a,"next",e)}function a(e){N(l,r,n,c,a,"throw",e)}c(void 0)}))}}const B={setup:function(){var e=(0,m.oR)(),t=(0,r.inject)("emitter"),o=(0,r.computed)((function(){return e.getters.getEmployeeQueryParams}));function n(){return(n=w(V().mark((function t(){return V().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e.commit("letter/setQueryParam",{key:"hr_id",value:o.value.hr_id}),t.next=3,l();case 3:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function l(){return c.apply(this,arguments)}function c(){return(c=w(V().mark((function t(){return V().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.dispatch("letter/setLettersToStore",{page:1,"filter[hr_id]":o.value.hr_id,take:o.value.take});case 2:case"end":return t.stop()}}),t)})))).apply(this,arguments)}return(0,r.watch)((function(){return o}),(function(e,t){return function(){return n.apply(this,arguments)}()}),{deep:!0}),{profile:(0,r.computed)((function(){return e.getters.getProfile})),letters:(0,r.computed)((function(){return e.getters.getLetters})),initializeLetterStoreForm:function(){return t.emit("create-letter-form")},hrs:(0,r.computed)((function(){return e.getters.getHrs})),activeFilters:o,take:[150,200,300,500],refresh:function(){l(),e.dispatch("user/setProfileToStore")}}},render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("div",v,[(0,r.createVNode)("button",{onClick:t[1]||(t[1]=(...e)=>n.refresh(...e)),class:"btn btn-secondary",type:"button",title:"Refresh"},[b]),(0,r.createVNode)("button",{onClick:t[2]||(t[2]=(...e)=>n.initializeLetterStoreForm(...e)),class:"btn btn-primary btn ml-2","data-toggle":"modal","data-target":"#addLetterForm"}," Add record "),"admin"===n.profile.role||"top hr"===n.profile.role?(0,r.withDirectives)(((0,r.openBlock)(),(0,r.createBlock)("select",{key:0,"onUpdate:modelValue":t[3]||(t[3]=e=>n.activeFilters.hr_id=e),class:"custom-select form-control ml-2 col-sm-2 col-1"},[y,((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,null,(0,r.renderList)(n.hrs,(e=>((0,r.openBlock)(),(0,r.createBlock)("option",{value:e.id},(0,r.toDisplayString)(e.login),9,["value"])))),256))],512)),[[r.vModelSelect,n.activeFilters.hr_id]]):(0,r.createCommentVNode)("",!0)])}},x=B;const L={class:"odd gradeX"},C={class:" pr-0"},O={class:""},j={class:""},P={class:""},_={class:""},D={class:""},F={class:""},S={class:"d-flex  justify-content-between align-items-center "};function I(e,t,o,r,n,l,c){try{var a=e[l](c),s=a.value}catch(e){return void o(e)}a.done?t(s):Promise.resolve(s).then(r,n)}function H(e){return function(){var t=this,o=arguments;return new Promise((function(r,n){var l=e.apply(t,o);function c(e){I(l,r,n,c,a,"next",e)}function a(e){I(l,r,n,c,a,"throw",e)}c(void 0)}))}}const T={setup:function(e){var t=(0,m.oR)(),o=(0,r.inject)("emitter"),n=(0,r.inject)("container"),l="delete-letter-"+e.letter.id;function c(){return(c=H(V().mark((function e(){var t;return V().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:t={message:i(),event_id:l,action:"deleted"},o.emit("show-delete-modal",t);case 2:case"end":return e.stop()}}),e)})))).apply(this,arguments)}function a(){return s.apply(this,arguments)}function s(){return(s=H(V().mark((function r(){return V().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return r.prev=0,r.next=3,n.LetterService.delete(e.letter);case 3:o.emit("notification-success"," letter received on "+e.letter.received_at+" was deleted"),t.dispatch("letter/deleteLetter",e.letter),r.next=10;break;case 7:r.prev=7,r.t0=r.catch(0),o.emit("notification-error",r.t0.response.data);case 10:case"end":return r.stop()}}),r,null,[[0,7]])})))).apply(this,arguments)}function i(){return"You want to delete letter received on: <strong>"+e.letter.received_at+"</strong>"}return o.on(l,a),(0,r.onBeforeUnmount)((function(){return o.off(l,a)})),{deleteWarning:function(){return c.apply(this,arguments)},deleteEventId:l}},props:{letter:Object},render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("a",{"data-toggle":"modal","data-target":"#deleteForm",onClick:t[1]||(t[1]=(...e)=>n.deleteWarning(...e)),type:"button",class:"ion ion-md-trash danger"})}},R=T,E={"data-toggle":"modal","data-target":"#editLetterForm"};const A={setup:function(e){var t=(0,r.inject)("emitter");return{showEditLetterForm:function(){return t.emit("edit-letter-form",e.letter)}}},props:{letter:Object},render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("a",E,[(0,r.createVNode)("button",{type:"button",class:"ion ion-md-cog p-0 bg-transparent border-0","data-toggle":"tooltip","data-target":"#editLetterForm","data-placement":"right",title:"Edit",onClick:t[1]||(t[1]=(...e)=>n.showEditLetterForm(...e))})])}},U=A,Z={props:{letter:Object},setup:function(e){return{total:(0,r.computed)((function(){return parseInt(e.letter.google)+parseInt(e.letter.outlook)+parseInt(e.letter.yahoo)+parseInt(e.letter.other)}))}},components:{DeleteButton:R,EditButton:U},render:function(e,t,o,n,l,c){const a=(0,r.resolveComponent)("EditButton"),s=(0,r.resolveComponent)("DeleteButton");return(0,r.openBlock)(),(0,r.createBlock)("tr",L,[(0,r.createVNode)("td",C,(0,r.toDisplayString)(o.letter.received_at),1),(0,r.createVNode)("td",O,(0,r.toDisplayString)(o.letter.hr.login),1),(0,r.createVNode)("td",j,(0,r.toDisplayString)(o.letter.google),1),(0,r.createVNode)("td",P,(0,r.toDisplayString)(o.letter.outlook),1),(0,r.createVNode)("td",_,(0,r.toDisplayString)(o.letter.yahoo),1),(0,r.createVNode)("td",D,(0,r.toDisplayString)(o.letter.other),1),(0,r.createVNode)("td",F,(0,r.toDisplayString)(n.total),1),(0,r.createVNode)("td",S,[(0,r.createVNode)(a,{letter:o.letter},null,8,["letter"]),(0,r.createVNode)(s,{letter:o.letter},null,8,["letter"])])])}},$={class:"odd gradeX"},q={class:"pr-0"},M={class:""},Y={class:""},G={class:""},X={class:""},z={class:"d-flex  justify-content-between align-items-center "};const Q={props:{letter:Object},components:{DeleteButton:R,EditButton:U},render:function(e,t,o,n,l,c){const a=(0,r.resolveComponent)("EditButton"),s=(0,r.resolveComponent)("DeleteButton");return(0,r.openBlock)(),(0,r.createBlock)("tr",$,[(0,r.createVNode)("td",q,(0,r.toDisplayString)(o.letter.received_at),1),(0,r.createVNode)("td",M,(0,r.toDisplayString)(o.letter.google),1),(0,r.createVNode)("td",Y,(0,r.toDisplayString)(o.letter.outlook),1),(0,r.createVNode)("td",G,(0,r.toDisplayString)(o.letter.yahoo),1),(0,r.createVNode)("td",X,(0,r.toDisplayString)(o.letter.other),1),(0,r.createVNode)("td",z,[(0,r.createVNode)(a,{letter:o.letter},null,8,["letter"]),(0,r.createVNode)(s,{letter:o.letter},null,8,["letter"])])])}},W={setup:function(){var e=(0,m.oR)();return{profile:(0,r.computed)((function(){return e.getters.getProfile})),profileIsAdmin:(0,r.computed)((function(){return"admin"===e.getters.getProfile.role})),profileIsTopHr:(0,r.computed)((function(){return"top hr"===e.getters.getProfile.role})),profileIsHr:(0,r.computed)((function(){return"hr"===e.getters.getProfile.role}))}},props:{letter:Object},components:{AdminRow:Z,HrRow:Q},render:function(e,t,o,n,l,c){const a=(0,r.resolveComponent)("HrRow"),s=(0,r.resolveComponent)("AdminRow");return(0,r.openBlock)(),(0,r.createBlock)(r.Fragment,null,[n.profileIsHr?((0,r.openBlock)(),(0,r.createBlock)(a,{key:0,letter:o.letter},null,8,["letter"])):(0,r.createCommentVNode)("",!0),n.profileIsTopHr||n.profileIsAdmin?((0,r.openBlock)(),(0,r.createBlock)(s,{key:1,letter:o.letter},null,8,["letter"])):(0,r.createCommentVNode)("",!0)],64)}},J=W;var K=o(7417),ee=o(6151);const te={setup:function(){var e=(0,m.oR)();return{letters:(0,r.computed)((function(){return e.getters.getLetters}))}},components:{LettersTableHead:g,LettersTableRow:J,LettersTableControl:x,CreateLetterForm:K.Z,EditLetterForm:ee.Z},render:function(e,t,o,n,l,c){const s=(0,r.resolveComponent)("LettersTableHead"),i=(0,r.resolveComponent)("LettersTableRow");return(0,r.openBlock)(),(0,r.createBlock)("table",a,[(0,r.createVNode)(s),(0,r.createVNode)("tbody",null,[((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,null,(0,r.renderList)(n.letters,(e=>((0,r.openBlock)(),(0,r.createBlock)(i,{letter:e,key:e.id+e.name},null,8,["letter"])))),128))])])}},oe=te,re={class:"datatables-demo table table-striped table-bordered"};const ne=(0,r.createVNode)("tr",null,[(0,r.createVNode)("th",{class:"text-left font-weight-bold col-2"},"Hr"),(0,r.createVNode)("th",{class:"text-left font-weight-bold col-2"},"Google"),(0,r.createVNode)("th",{class:"text-left font-weight-bold col-2"},"Outlook"),(0,r.createVNode)("th",{class:"text-left font-weight-bold col-2"},"Yahoo"),(0,r.createVNode)("th",{class:"text-left font-weight-bold col-2"},"Other"),(0,r.createVNode)("th",{class:"text-left font-weight-bold col-2"},"Total")],-1);const le={render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("thead",null,[ne])}},ce=le,ae=(0,r.createVNode)("tr",null,[(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Google"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Outlook"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Yahoo"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Other"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Total"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Hired"),(0,r.createVNode)("th",{class:"text-left font-weight-bold"},"Rate")],-1);const se={render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("thead",null,[ae])}},ie={setup:function(){var e=(0,m.oR)();return{profileIsAdmin:(0,r.computed)((function(){return"admin"===e.getters.getProfile.role})),profileIsPersonnel:(0,r.computed)((function(){return"personnel"===e.getters.getProfile.role})),profileIsHr:(0,r.computed)((function(){return"hr"===e.getters.getProfile.role||"top hr"===e.getters.getProfile.role}))}},components:{AdminHead:ce,HrHead:se},render:function(e,t,o,n,l,c){const a=(0,r.resolveComponent)("HrHead"),s=(0,r.resolveComponent)("AdminHead");return(0,r.openBlock)(),(0,r.createBlock)(r.Fragment,null,[n.profileIsHr?((0,r.openBlock)(),(0,r.createBlock)(a,{key:0})):(0,r.createCommentVNode)("",!0),n.profileIsPersonnel||n.profileIsAdmin?((0,r.openBlock)(),(0,r.createBlock)(s,{key:1})):(0,r.createCommentVNode)("",!0)],64)}};const de={class:"odd gradeX"},ue={class:"col-2"},fe={class:"col-2"},pe={class:"col-2"},me={class:"col-2"},he={class:"col-2"},ge={class:"col-2"};const ve={props:{hr:Object},setup:function(e){return{total:(0,r.computed)((function(){var t,o,r,n;return parseInt(null!==(t=e.hr.google_total)&&void 0!==t?t:0)+parseInt(null!==(o=e.hr.outlook_total)&&void 0!==o?o:0)+parseInt(null!==(r=e.hr.yahoo_total)&&void 0!==r?r:0)+parseInt(null!==(n=e.hr.other_total)&&void 0!==n?n:0)}))}},render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("tr",de,[(0,r.createVNode)("td",ue,(0,r.toDisplayString)(o.hr.login),1),(0,r.createVNode)("td",fe,(0,r.toDisplayString)(o.hr.google_total??0),1),(0,r.createVNode)("td",pe,(0,r.toDisplayString)(o.hr.outlook_total??0),1),(0,r.createVNode)("td",me,(0,r.toDisplayString)(o.hr.yahoo_total??0),1),(0,r.createVNode)("td",he,(0,r.toDisplayString)(o.hr.other_total??0),1),(0,r.createVNode)("td",ge,(0,r.toDisplayString)(n.total),1)])}},be={class:"odd gradeX"},ye={class:"col-2"},ke={class:"col-2"},Ve={class:"col-2"},Ne={class:"col-2"},we={class:"col-2"},Be={class:"col-2"},xe={key:0,class:"col-3"},Le={key:1,class:"col-3"};const Ce={setup:function(){var e=(0,m.oR)(),t=(0,r.computed)((function(){return e.getters.getProfile}));return{profile:t,total:(0,r.computed)((function(){var e,o,r,n;return parseInt(null!==(e=t.value.google_total)&&void 0!==e?e:0)+parseInt(null!==(o=t.value.outlook_total)&&void 0!==o?o:0)+parseInt(null!==(r=t.value.yahoo_total)&&void 0!==r?r:0)+parseInt(null!==(n=t.value.other_total)&&void 0!==n?n:0)}))}},components:{DeleteButton:R,EditButton:U},render:function(e,t,o,n,l,c){return(0,r.openBlock)(),(0,r.createBlock)("tr",be,[(0,r.createVNode)("td",ye,(0,r.toDisplayString)(n.profile.google_total??0),1),(0,r.createVNode)("td",ke,(0,r.toDisplayString)(n.profile.outlook_total??0),1),(0,r.createVNode)("td",Ve,(0,r.toDisplayString)(n.profile.yahoo_total??0),1),(0,r.createVNode)("td",Ne,(0,r.toDisplayString)(n.profile.other_total??0),1),(0,r.createVNode)("td",we,(0,r.toDisplayString)(n.total),1),(0,r.createVNode)("td",Be,(0,r.toDisplayString)(n.profile.good_hr_employees_count),1),n.profile.good_hr_employees_count>0?((0,r.openBlock)(),(0,r.createBlock)("td",xe,(0,r.toDisplayString)((n.profile.good_hr_employees_count/n.total*100).toFixed(2))+"% ",1)):((0,r.openBlock)(),(0,r.createBlock)("td",Le," 0%"))])}},Oe={setup:function(){var e=(0,m.oR)();return{profile:(0,r.computed)((function(){return e.getters.getProfile})),hrs:(0,r.computed)((function(){return e.getters.getHrs})),profileIsAdmin:(0,r.computed)((function(){return"admin"===e.getters.getProfile.role})),profileIsTopHr:(0,r.computed)((function(){return"top hr"===e.getters.getProfile.role})),profileIsHr:(0,r.computed)((function(){return"hr"===e.getters.getProfile.role}))}},components:{AdminRow:ve,HrRow:Ce},render:function(e,t,o,n,l,c){const a=(0,r.resolveComponent)("HrRow"),s=(0,r.resolveComponent)("AdminRow");return(0,r.openBlock)(),(0,r.createBlock)(r.Fragment,null,[n.profileIsHr?((0,r.openBlock)(),(0,r.createBlock)(a,{key:0})):(0,r.createCommentVNode)("",!0),n.profileIsTopHr||n.profileIsAdmin?((0,r.openBlock)(!0),(0,r.createBlock)(r.Fragment,{key:1},(0,r.renderList)(n.hrs,(e=>((0,r.openBlock)(),(0,r.createBlock)(s,{hr:e},null,8,["hr"])))),256)):(0,r.createCommentVNode)("",!0)],64)}},je={setup:function(){var e=(0,m.oR)();return{profile:(0,r.computed)((function(){return e.getters.getProfile}))}},components:{TotalLettersTableHead:ie,TotalLettersTableRow:Oe},render:function(e,t,o,n,l,c){const a=(0,r.resolveComponent)("TotalLettersTableHead"),s=(0,r.resolveComponent)("TotalLettersTableRow");return(0,r.openBlock)(),(0,r.createBlock)("table",re,[(0,r.createVNode)(a),(0,r.createVNode)("tbody",null,[(0,r.createVNode)(s)])])}};const Pe={setup:function(){var e=(0,m.oR)();(0,r.inject)("emitter");return{letters:(0,r.computed)((function(){return e.getters.getLetters}))}},components:{LettersTable:oe,TotalLettersTable:je,LettersTableControl:x,NoRecords:o(1698).Z},render:function(e,t,o,a,s,i){const d=(0,r.resolveComponent)("LettersTableControl"),u=(0,r.resolveComponent)("LettersTable"),f=(0,r.resolveComponent)("TotalLettersTable"),p=(0,r.resolveComponent)("NoRecords");return(0,r.openBlock)(),(0,r.createBlock)("div",n,[l,(0,r.createVNode)(d),Object.keys(a.letters).length>0?((0,r.openBlock)(),(0,r.createBlock)("div",c,[(0,r.createVNode)(u,{class:"col-6"}),(0,r.createVNode)(f,{class:"col-5 ml-4"})])):((0,r.openBlock)(),(0,r.createBlock)(p,{key:1}))])}},_e={setup:function(){var e=(0,m.oR)(),t=0===Object.keys(e.getters.getUsers).length,o=0===Object.keys(e.getters.getRoles).length,r=0===Object.keys(e.getters.getLetters).length;t&&e.dispatch("user/setUsersToStore"),o&&e.dispatch("user/setRolesToStore"),r&&e.dispatch("letter/setLettersToStore")},components:{LettersBundleTable:Pe,StoreLetterForm:K.Z,EditLetterForm:ee.Z},render:function(e,t,o,n,l,c){const a=(0,r.resolveComponent)("LettersBundleTable"),s=(0,r.resolveComponent)("StoreLetterForm"),i=(0,r.resolveComponent)("EditLetterForm");return(0,r.openBlock)(),(0,r.createBlock)(r.Fragment,null,[(0,r.createVNode)(a),(0,r.createVNode)(s),(0,r.createVNode)(i)],64)}},De=_e}}]);