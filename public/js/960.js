(self.webpackChunk=self.webpackChunk||[]).push([[960],{1698:(e,t,o)=>{"use strict";o.d(t,{Z:()=>l});var n=o(5166);const r={class:"w-lg-100 d-flex justify-content-center mt-lg-5"},a=(0,n.createVNode)("h3",null,"No data found",-1);const c={render:function(e,t,o,c,l,i){return(0,n.openBlock)(),(0,n.createBlock)("div",r,[a])}},l=c},1960:(e,t,o)=>{"use strict";o.r(t),o.d(t,{default:()=>rt});var n=o(5166);const r={class:"container-fluid flex-grow-1 container-p-y"},a=(0,n.createVNode)("h4",{class:"font-weight-bold py-3 mb-4"}," Companies ",-1),c={key:0,class:" table-responsive"},l={class:"datatables-demo table table-striped table-bordered",style:{width:"65%"}};const i=(0,n.createVNode)("tr",null,[(0,n.createVNode)("th",{class:"text-left font-weight-bold "},"Created"),(0,n.createVNode)("th",{class:"text-left font-weight-bold "},"Personnel"),(0,n.createVNode)("th",{class:"text-left font-weight-bold"},"Name"),(0,n.createVNode)("th",{class:"text-left font-weight-bold"},"Domain/Email"),(0,n.createVNode)("th",{class:"text-left font-weight-bold"},"Manager"),(0,n.createVNode)("th",{class:"text-left font-weight-bold"},"Actions")],-1);const s={render:function(e,t,o,r,a,c){return(0,n.openBlock)(),(0,n.createBlock)("thead",null,[i])}},m=s,d=(0,n.createVNode)("tr",{class:""},[(0,n.createVNode)("td",{class:"text-left font-weight-bold"},"Created"),(0,n.createVNode)("td",{class:"text-left font-weight-bold"},"Name"),(0,n.createVNode)("td",{class:"text-left font-weight-bold"},"Domain/Email"),(0,n.createVNode)("td",{class:"text-left font-weight-bold"},"Manager"),(0,n.createVNode)("th",{class:"text-left font-weight-bold"},"Actions")],-1);const p={render:function(e,t,o,r,a,c){return(0,n.openBlock)(),(0,n.createBlock)("thead",null,[d])}},u=p;var f=o(6564);const y={setup:function(){var e=(0,f.oR)();return{profileIsAdmin:(0,n.computed)((function(){return"admin"===e.getters.getProfile.role})),profileIsPersonnel:(0,n.computed)((function(){return"personnel"===e.getters.getProfile.role})),profileIsHr:(0,n.computed)((function(){return"hr"===e.getters.getProfile.role||"top hr"===e.getters.getProfile.role}))}},components:{AdminHead:m,HrHead:u},render:function(e,t,o,r,a,c){const l=(0,n.resolveComponent)("HrHead"),i=(0,n.resolveComponent)("AdminHead");return(0,n.openBlock)(),(0,n.createBlock)(n.Fragment,null,[r.profileIsHr?((0,n.openBlock)(),(0,n.createBlock)(l,{key:0})):(0,n.createCommentVNode)("",!0),r.profileIsPersonnel||r.profileIsAdmin?((0,n.openBlock)(),(0,n.createBlock)(i,{key:1})):(0,n.createCommentVNode)("",!0)],64)}},g=y,v={class:"d-flex mb-3 mt-2"},h=(0,n.createVNode)("i",{class:"opacity-75 ion ion-md-refresh icon-refresh"},null,-1),b=(0,n.createVNode)("option",{value:"",selected:""},"Type",-1),k=(0,n.createVNode)("option",{value:"0"},"Delivery",-1),N=(0,n.createVNode)("option",{value:"1"},"Hiring",-1),V=(0,n.createVNode)("option",{value:"",selected:""},"Hr",-1);var C=o(7757),w=o.n(C);function B(e,t,o,n,r,a,c){try{var l=e[a](c),i=l.value}catch(e){return void o(e)}l.done?t(i):Promise.resolve(i).then(n,r)}function x(e){return function(){var t=this,o=arguments;return new Promise((function(n,r){var a=e.apply(t,o);function c(e){B(a,n,r,c,l,"next",e)}function l(e){B(a,n,r,c,l,"throw",e)}c(void 0)}))}}const j={setup:function(){var e=(0,f.oR)(),t=(0,n.inject)("emitter"),o=(0,n.computed)((function(){return e.getters.getCompanyQueryParams}));function r(){return(r=x(w().mark((function t(){return w().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e.commit("company/setQueryParam",{key:"take",value:o.value.take}),e.commit("company/setQueryParam",{key:"manager_id",value:o.value.manager_id}),e.commit("company/setQueryParam",{key:"type",value:o.value.type}),t.next=5,a();case 5:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function a(){return c.apply(this,arguments)}function c(){return(c=x(w().mark((function t(){var n;return w().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return n={},["page","manager_id","take","type"].map((function(e){o.value[e]&&(n[e]=o.value[e])})),console.log(n),t.next=5,e.dispatch("company/setCompaniesToStore",n);case 5:case"end":return t.stop()}}),t)})))).apply(this,arguments)}return(0,n.watch)((function(){return o}),(function(e,t){return function(){return r.apply(this,arguments)}()}),{deep:!0}),{activeFilters:o,profile:(0,n.computed)((function(){return e.getters.getProfile})),companies:(0,n.computed)((function(){return e.getters.getCompanies})),managers:(0,n.computed)((function(){return e.getters.getUsers})),initializeCompanyStoreForm:function(){return t.emit("create-company-form")},refresh:function(){return e.dispatch("company/setCompaniesToStore")}}},render:function(e,t,o,r,a,c){return(0,n.openBlock)(),(0,n.createBlock)("div",v,[(0,n.createVNode)("button",{onClick:t[1]||(t[1]=(...e)=>r.refresh(...e)),class:"btn btn-secondary",type:"button",title:"Refresh"},[h]),(0,n.createVNode)("button",{onClick:t[2]||(t[2]=(...e)=>r.initializeCompanyStoreForm(...e)),class:"btn btn-primary btn ml-2","data-toggle":"modal","data-target":"#addCompanyForm"},"Add company "),"admin"===r.profile.role||"top hr"===r.profile.role||"hr"===r.profile.role?(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createBlock)("select",{key:0,"onUpdate:modelValue":t[3]||(t[3]=e=>r.activeFilters.type=e),class:"custom-select form-control ml-2 col-sm-2"},[b,k,N],512)),[[n.vModelSelect,r.activeFilters.type]]):(0,n.createCommentVNode)("",!0),"admin"===r.profile.role||"top hr"===r.profile.role?(0,n.withDirectives)(((0,n.openBlock)(),(0,n.createBlock)("select",{key:1,"onUpdate:modelValue":t[4]||(t[4]=e=>r.activeFilters.manager_id=e),class:"custom-select form-control ml-2 col-sm-2"},[V,((0,n.openBlock)(!0),(0,n.createBlock)(n.Fragment,null,(0,n.renderList)(r.managers,(e=>((0,n.openBlock)(),(0,n.createBlock)("option",{value:e.id},(0,n.toDisplayString)(e.login),9,["value"])))),256))],512)),[[n.vModelSelect,r.activeFilters.manager_id]]):(0,n.createCommentVNode)("",!0)])}},F=j;const P={class:"odd gradeX"},O={class:" pr-0"},D={class:""},S={class:""},E={class:" d-flex flex-column"},_={class:"d-flex justify-content-between align-items-center"};function U(e,t,o,n,r,a,c){try{var l=e[a](c),i=l.value}catch(e){return void o(e)}l.done?t(i):Promise.resolve(i).then(n,r)}function I(e){return function(){var t=this,o=arguments;return new Promise((function(n,r){var a=e.apply(t,o);function c(e){U(a,n,r,c,l,"next",e)}function l(e){U(a,n,r,c,l,"throw",e)}c(void 0)}))}}const A={setup:function(e){var t=(0,f.oR)(),o=(0,n.inject)("emitter"),r=(0,n.inject)("container"),a=(0,n.computed)((function(){return t.getters.getProfile})),c="delete-company-"+e.company.id;function l(){return(l=I(w().mark((function e(){var t;return w().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:t={message:m(),event_id:c,action:"deleted"},o.emit("show-delete-modal",t);case 2:case"end":return e.stop()}}),e)})))).apply(this,arguments)}function i(){return s.apply(this,arguments)}function s(){return(s=I(w().mark((function n(){return w().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,r.CompanyService.deleteCompany(e.company);case 3:o.emit("notification-success"," company "+e.company.name+" was deleted"),t.dispatch("company/deleteCompany",e.company),n.next=10;break;case 7:n.prev=7,n.t0=n.catch(0),o.emit("notification-error",n.t0.response.data);case 10:case"end":return n.stop()}}),n,null,[[0,7]])})))).apply(this,arguments)}function m(){return"You want to delete company: <strong>"+e.company.name+"</strong>"}return o.on(c,i),(0,n.onBeforeUnmount)((function(){return o.off(c,i)})),{deleteWarning:function(){return l.apply(this,arguments)},deleteEventId:c,disabled:function(){return console.log("disable ? ",a.value.role,e.company.type),("hr"==a.value.role||"top hr"==a.value.role)&&0==e.company.type}}},props:{company:Object},render:function(e,t,o,r,a,c){return(0,n.openBlock)(),(0,n.createBlock)("button",{disabled:r.disabled(),"data-toggle":"modal","data-target":"#deleteForm",onClick:t[1]||(t[1]=(...e)=>r.deleteWarning(...e)),type:"button",class:"ion ion-md-trash danger border-0"},null,8,["disabled"])}},R={"data-toggle":"modal","data-target":"#editCompanyForm"};const T={setup:function(e){var t=(0,n.inject)("emitter"),o=(0,f.oR)(),r=(0,n.computed)((function(){return o.getters.getProfile}));return{showEditCompanyForm:function(){return t.emit("edit-company-form",e.company)},disabled:function(){return console.log(r.value),("hr"==r.value.role||"top hr"==r.value.role)&&0==e.company.type}}},props:{company:Object},render:function(e,t,o,r,a,c){return(0,n.openBlock)(),(0,n.createBlock)("a",R,[(0,n.createVNode)("button",{type:"button",class:"ion ion-md-cog p-0 bg-transparent border-0",disabled:r.disabled(),"data-toggle":"tooltip","data-target":"#editCompanyForm","data-placement":"right",title:"Edit",onClick:t[1]||(t[1]=(...e)=>r.showEditCompanyForm(...e))},null,8,["disabled"])])}},H={props:{company:Object},components:{DeleteButton:A,EditButton:T},render:function(e,t,o,r,a,c){const l=(0,n.resolveComponent)("EditButton"),i=(0,n.resolveComponent)("DeleteButton");return(0,n.openBlock)(),(0,n.createBlock)("tr",P,[(0,n.createVNode)("td",O,(0,n.toDisplayString)(o.company.created_at),1),(0,n.createVNode)("td",D,(0,n.toDisplayString)(o.company.manager.login),1),(0,n.createVNode)("td",S,(0,n.toDisplayString)(o.company.name),1),(0,n.createVNode)("td",E,[(0,n.createVNode)("a",{href:o.company.domain},(0,n.toDisplayString)(o.company.domain),9,["href"]),(0,n.createVNode)("div",null,(0,n.toDisplayString)(o.company.email),1)]),(0,n.createVNode)("td",null,(0,n.toDisplayString)(o.company.pseudonym),1),(0,n.createVNode)("td",null,[(0,n.createVNode)("div",_,[(0,n.createVNode)(l,{company:o.company},null,8,["company"]),(0,n.createVNode)(i,{company:o.company},null,8,["company"])])])])}},Z={class:"odd gradeX"},M={class:""},z={class:""},q={class:" d-flex flex-column"},$={class:""},L={class:"d-flex justify-content-between align-items-center"};const Q={props:{company:Object},components:{DeleteButton:A,EditButton:T},render:function(e,t,o,r,a,c){const l=(0,n.resolveComponent)("EditButton"),i=(0,n.resolveComponent)("DeleteButton");return(0,n.openBlock)(),(0,n.createBlock)("tr",Z,[(0,n.createVNode)("td",M,(0,n.toDisplayString)(o.company.created_at),1),(0,n.createVNode)("td",z,(0,n.toDisplayString)(o.company.name),1),(0,n.createVNode)("td",q,[(0,n.createVNode)("a",{href:o.company.domain},(0,n.toDisplayString)(o.company.domain),9,["href"]),(0,n.createVNode)("div",null,(0,n.toDisplayString)(o.company.email),1)]),(0,n.createVNode)("td",$,(0,n.toDisplayString)(o.company.pseudonym),1),(0,n.createVNode)("td",null,[(0,n.createVNode)("div",L,[(0,n.createVNode)(l,{company:o.company},null,8,["company"]),(0,n.createVNode)(i,{company:o.company},null,8,["company"])])])])}},W={setup:function(){var e=(0,f.oR)();return{profile:(0,n.computed)((function(){return e.getters.getProfile})),profileIsAdmin:(0,n.computed)((function(){return"admin"===e.getters.getProfile.role})),profileIsPersonnel:(0,n.computed)((function(){return"personnel"===e.getters.getProfile.role})),profileIsHr:(0,n.computed)((function(){return"hr"===e.getters.getProfile.role||"top hr"===e.getters.getProfile.role}))}},props:{company:Object},components:{AdminRow:H,HrRow:Q},render:function(e,t,o,r,a,c){const l=(0,n.resolveComponent)("HrRow"),i=(0,n.resolveComponent)("AdminRow");return(0,n.openBlock)(),(0,n.createBlock)(n.Fragment,null,[r.profileIsHr?((0,n.openBlock)(),(0,n.createBlock)(l,{key:0,company:o.company},null,8,["company"])):(0,n.createCommentVNode)("",!0),r.profileIsPersonnel||r.profileIsAdmin?((0,n.openBlock)(),(0,n.createBlock)(i,{key:1,company:o.company},null,8,["company"])):(0,n.createCommentVNode)("",!0)],64)}},X=W,Y={class:"modal fade",id:"addCompanyForm"},G={class:"modal-dialog"},J={class:"modal-content"},K=(0,n.createVNode)("div",{class:"modal-header"},[(0,n.createVNode)("h5",{class:"modal-title"}," Add company "),(0,n.createVNode)("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},"×")],-1),ee={class:"modal-body"},te={class:"modal-footer"},oe=(0,n.createVNode)("button",{id:"storeCompanyFormClose",type:"button",class:"btn btn-default","data-dismiss":"modal"}," Close ",-1);const ne={class:"form-row mb-2"},re={key:0,class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},ae=(0,n.createVNode)("label",{class:"form-label col-md-2"},"Type ",-1),ce=(0,n.createVNode)("option",{disabled:"",selected:"",value:null}," -- select type --",-1),le=(0,n.createVNode)("small",{class:"col-md-12 invalid-feedback text-right p-0"},"please select a company type",-1),ie={class:"form-row mb-2"},se={key:0,class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},me=(0,n.createVNode)("label",{class:"form-label col-md-2"},"Manager",-1),de=(0,n.createVNode)("option",{disabled:"",selected:"",value:null}," -- select manager --",-1),pe=(0,n.createVNode)("small",{class:"col-md-12 invalid-feedback text-right p-0"},"please select manager",-1),ue={class:"form-row mb-2"},fe={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},ye=(0,n.createVNode)("label",{class:"form-label col-md-2"},"Name",-1),ge={class:" col-md-12 invalid-feedback text-right p-0"},ve={class:"form-row mb-2"},he={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},be=(0,n.createVNode)("label",{class:"form-label col-md-2"},"Domain",-1),ke={class:"col-md-12 invalid-feedback text-right p-0"},Ne={class:"form-row mb-2"},Ve={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},Ce=(0,n.createVNode)("label",{class:"form-label col-md-2"},"Manager",-1),we={class:" col-md-12 invalid-feedback text-right p-0"},Be={class:"form-row mb-2"},xe={class:"form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap"},je=(0,n.createVNode)("label",{class:"form-label col-md-2"},"Email",-1),Fe={class:" col-md-12 invalid-feedback text-right p-0"};var Pe=o(2954),Oe=o(7561);function De(e,t,o,n,r,a,c){try{var l=e[a](c),i=l.value}catch(e){return void o(e)}l.done?t(i):Promise.resolve(i).then(n,r)}function Se(e){return function(){var t=this,o=arguments;return new Promise((function(n,r){var a=e.apply(t,o);function c(e){De(a,n,r,c,l,"next",e)}function l(e){De(a,n,r,c,l,"throw",e)}c(void 0)}))}}const Ee={setup:function(e){var t=(0,f.oR)(),o=(0,n.inject)("emitter"),r=Oe.Ry({type:Oe.Rx().required(),manager:Oe.Z_().nullable().required(),email:Oe.Z_().nullable().required().email(),name:Oe.Z_().nullable().required().trim().matches("^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$","company name can contain only letters numbers and spaces"),pseudonym:Oe.Z_().nullable().required().trim().matches("^[a-zA-Z ]*$","pseudonym can contain only letters"),domain:Oe.Z_().nullable().required().trim().matches("^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\\.[a-zA-Z]{2,}$","please enter valid domain")}),a=(0,Pe.cI)({validationSchema:r.nullable()}),c=a.errors,l=a.validate,i=(0,Pe.U$)("type",{value:(0,n.computed)((function(){return e.company.type}))}),s=(0,Pe.U$)("name",{value:(0,n.computed)((function(){return e.company.name}))}),m=(0,Pe.U$)("pseudonym",{value:(0,n.computed)((function(){return e.company.pseudonym}))}),d=(0,Pe.U$)("email",{value:(0,n.computed)((function(){return e.company.email}))}),p=(0,Pe.U$)("domain",{value:(0,n.computed)((function(){return e.company.domain}))}),u=(0,Pe.U$)("manager",{value:(0,n.computed)((function(){return e.company.manager_id}))}),y=[{field:i,name:"type"},{field:u,name:"manager_id"},{field:s,name:"name"},{field:p,name:"domain"},{field:d,name:"email"},{field:m,name:"pseudonym"}],g=(0,Pe.W6)();function v(){return(v=Se(w().mark((function t(){var o;return w().wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return y.forEach((function(t){t.field.meta.dirty=!0,t.field.meta.touched=!0,t.field.value.value=e.company[t.name]})),t.next=3,l();case 3:if((o=t.sent).valid){t.next=6;break}throw{message:"Please fix form errors:",errors:Object.keys(o.errors).map((function(e){return[o.errors[e]]}))};case 6:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function h(){y.forEach((function(t){return t.field.value.value=e.company[t.name]}))}return o.on("edit-company-form",h),o.on("create-company-form",g),(0,n.onBeforeUnmount)((function(){o.off("edit-company-form",h),o.off("create-company-form",g)})),{name:s,email:d,domain:p,manager:u,type:i,pseudonym:m,errors:c,validate:function(){return v.apply(this,arguments)},managers:(0,n.computed)((function(){return 1==e.company.type?t.getters.getHrs:t.getters.getPersonnels})),profile:(0,n.computed)((function(){return t.getters.getProfile})),types:[{name:"Hiring",id:1},{name:"Delivery",id:0}],companyTypeChanged:function(){i.handleChange,e.company.manager={login:""},e.company.manager_id=null,console.log("set null")}}},props:{company:Object,showTypeField:Boolean},components:{Form:Pe.l0,Field:Pe.gN},render:function(e,t,o,r,a,c){return(0,n.openBlock)(),(0,n.createBlock)(n.Fragment,null,[(0,n.createVNode)("div",ne,["admin"===r.profile.role?((0,n.openBlock)(),(0,n.createBlock)("div",re,[ae,(0,n.withDirectives)((0,n.createVNode)("select",{class:["custom-select form-control form-control-sm col-md-10",{"is-invalid":!r.type.meta.valid&&r.type.meta.touched}],name:"type","onUpdate:modelValue":t[1]||(t[1]=e=>o.company.type=e),onFocus:t[2]||(t[2]=e=>r.type.meta.touched=!1),onChange:t[3]||(t[3]=(...e)=>r.companyTypeChanged(...e)),onBlur:t[4]||(t[4]=(...e)=>r.type.handleBlur(...e))},[ce,((0,n.openBlock)(!0),(0,n.createBlock)(n.Fragment,null,(0,n.renderList)(r.types,(e=>((0,n.openBlock)(),(0,n.createBlock)("option",{selected:o.company.type===e.id,value:e.id},(0,n.toDisplayString)(e.name),9,["selected","value"])))),256))],34),[[n.vModelSelect,o.company.type]]),le])):(0,n.createCommentVNode)("",!0)]),(0,n.createVNode)("div",ie,["admin"===r.profile.role?((0,n.openBlock)(),(0,n.createBlock)("div",se,[me,(0,n.withDirectives)((0,n.createVNode)("select",{class:["custom-select form-control form-control-sm col-md-10",{"is-invalid":!r.manager.meta.valid&&r.manager.meta.touched}],disabled:null==o.company.type,name:"manager","onUpdate:modelValue":t[5]||(t[5]=e=>o.company.manager_id=e),onFocus:t[6]||(t[6]=e=>r.manager.meta.touched=!1),onChange:t[7]||(t[7]=(...e)=>r.manager.handleChange(...e)),onBlur:t[8]||(t[8]=(...e)=>r.manager.handleBlur(...e))},[de,((0,n.openBlock)(!0),(0,n.createBlock)(n.Fragment,null,(0,n.renderList)(r.managers,(e=>((0,n.openBlock)(),(0,n.createBlock)("option",{selected:o.company.manager_id===e.id,value:e.id},(0,n.toDisplayString)(e.login),9,["selected","value"])))),256))],42,["disabled"]),[[n.vModelSelect,o.company.manager_id]]),pe])):(0,n.createCommentVNode)("",!0)]),(0,n.createVNode)("div",ue,[(0,n.createVNode)("div",fe,[ye,(0,n.withDirectives)((0,n.createVNode)("input",{type:"text",class:["form-control col-md-10",{"is-invalid":!r.name.meta.valid&&r.name.meta.touched}],placeholder:"Name",name:"name","onUpdate:modelValue":t[9]||(t[9]=e=>o.company.name=e),onFocus:t[10]||(t[10]=e=>r.name.meta.touched=!1),onInput:t[11]||(t[11]=(...e)=>r.name.handleChange(...e)),onBlur:t[12]||(t[12]=(...e)=>r.name.handleBlur(...e))},null,34),[[n.vModelText,o.company.name]]),(0,n.createVNode)("small",ge,(0,n.toDisplayString)(r.errors.name||"name is required"),1)])]),(0,n.createVNode)("div",ve,[(0,n.createVNode)("div",he,[be,(0,n.withDirectives)((0,n.createVNode)("input",{type:"text",class:["form-control col-md-10",{"is-invalid":!r.domain.meta.valid&&r.domain.meta.touched}],placeholder:"Domain",name:"domain","onUpdate:modelValue":t[13]||(t[13]=e=>o.company.domain=e),onFocus:t[14]||(t[14]=e=>r.domain.meta.touched=!1),onInput:t[15]||(t[15]=(...e)=>r.domain.handleChange(...e)),onBlur:t[16]||(t[16]=(...e)=>r.domain.handleBlur(...e))},null,34),[[n.vModelText,o.company.domain]]),(0,n.createVNode)("small",ke,(0,n.toDisplayString)(r.errors.domain||"domain is required"),1)])]),(0,n.createVNode)("div",Ne,[(0,n.createVNode)("div",Ve,[Ce,(0,n.withDirectives)((0,n.createVNode)("input",{type:"text",class:["form-control col-md-10",{"is-invalid":!r.pseudonym.meta.valid&&r.pseudonym.meta.touched}],placeholder:"Manager name",name:"pseudonym","onUpdate:modelValue":t[17]||(t[17]=e=>o.company.pseudonym=e),onFocus:t[18]||(t[18]=e=>r.pseudonym.meta.touched=!1),onInput:t[19]||(t[19]=(...e)=>r.pseudonym.handleChange(...e)),onBlur:t[20]||(t[20]=(...e)=>r.pseudonym.handleBlur(...e))},null,34),[[n.vModelText,o.company.pseudonym]]),(0,n.createVNode)("small",we,(0,n.toDisplayString)(r.errors.pseudonym||"pseudonym is required"),1)])]),(0,n.createVNode)("div",Be,[(0,n.createVNode)("div",xe,[je,(0,n.withDirectives)((0,n.createVNode)("input",{type:"text",class:["form-control col-md-10",{"is-invalid":!r.email.meta.valid&&r.email.meta.touched}],placeholder:"Email",name:"email","onUpdate:modelValue":t[21]||(t[21]=e=>o.company.email=e),onFocus:t[22]||(t[22]=e=>r.email.meta.touched=!1),onInput:t[23]||(t[23]=(...e)=>r.email.handleChange(...e)),onBlur:t[24]||(t[24]=(...e)=>r.email.handleBlur(...e))},null,34),[[n.vModelText,o.company.email]]),(0,n.createVNode)("small",Fe,(0,n.toDisplayString)(r.errors.email||"email is required"),1)])])],64)}},_e=Ee;function Ue(e,t,o,n,r,a,c){try{var l=e[a](c),i=l.value}catch(e){return void o(e)}l.done?t(i):Promise.resolve(i).then(n,r)}function Ie(e){return function(){var t=this,o=arguments;return new Promise((function(n,r){var a=e.apply(t,o);function c(e){Ue(a,n,r,c,l,"next",e)}function l(e){Ue(a,n,r,c,l,"throw",e)}c(void 0)}))}}function Ae(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,n)}return o}function Re(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?Ae(Object(o),!0).forEach((function(t){Te(e,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):Ae(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}function Te(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}const He={setup:function(){var e=(0,f.oR)(),t=(0,n.inject)("container"),o=(0,n.inject)("emitter"),r=(0,n.ref)(null),a=(0,n.computed)((function(){return e.getters.getProfile})),c=(0,n.computed)((function(){return e.getters.getUsers})),l=Re({},e.getters.getEmptyCompany);"personnel"!==a.value.role&&"hr"!==a.value.role||(l.manager_id=a.id),"personnel"===a.value.role&&(l.type=0),"hr"===a.value.role&&(l.type=1);var i=(0,n.reactive)(Re({},l));function s(){return(s=Ie(w().mark((function n(a){var l,i;return w().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,r.value.validate();case 3:return n.next=5,t.CompanyService.storeCompany(a);case 5:l=n.sent,(i=l.data.model).manager_id&&(i.manager=c.value[i.manager_id]),e.commit("company/setCompanyById",i),document.getElementById("storeCompanyFormClose").click(),o.emit("notification-success","company was created"),m(),n.next=18;break;case 14:n.prev=14,n.t0=n.catch(0),console.log(n.t0),n.t0.response.data&&o.emit("notification-error",n.t0.response.data);case 18:case"end":return n.stop()}}),n,null,[[0,14]])})))).apply(this,arguments)}function m(){Object.keys(l).forEach((function(e){return i[e]=l[e]})),"personnel"!==a.value.role&&"hr"!==a.value.role||(i.manager_id=a.value.id,i.manager=a.value,console.log(i.manager.login))}return o.on("create-company-form",m),(0,n.onBeforeUnmount)((function(){return o.off("create-company-form",m)})),{storeCompany:function(e){return s.apply(this,arguments)},company:i,companyFields:r}},components:{CompanyFormFields:_e},render:function(e,t,o,r,a,c){const l=(0,n.resolveComponent)("CompanyFormFields");return(0,n.openBlock)(),(0,n.createBlock)("div",Y,[(0,n.createVNode)("div",G,[(0,n.createVNode)("form",J,[K,(0,n.createVNode)("div",ee,[(0,n.createVNode)(l,{ref:"companyFields",company:r.company},null,8,["company"])]),(0,n.createVNode)("div",te,[oe,(0,n.createVNode)("button",{type:"button",class:"btn btn-primary",onClick:t[1]||(t[1]=e=>r.storeCompany(r.company))},"Add ")])])])])}},Ze=He,Me={class:"modal fade",id:"editCompanyForm"},ze={class:"modal-dialog"},qe={class:"modal-content"},$e=(0,n.createVNode)("div",{class:"modal-header"},[(0,n.createVNode)("h5",{class:"modal-title"},"Edit company"),(0,n.createVNode)("button",{type:"button",class:"close","data-dismiss":"modal","aria-label":"Close"},"×")],-1),Le={class:"modal-body"},Qe={class:"modal-footer"},We=(0,n.createVNode)("button",{id:"editCompanyFormClose",type:"button",class:"btn btn-default","data-dismiss":"modal"},"Close ",-1);function Xe(e,t,o,n,r,a,c){try{var l=e[a](c),i=l.value}catch(e){return void o(e)}l.done?t(i):Promise.resolve(i).then(n,r)}function Ye(e){return function(){var t=this,o=arguments;return new Promise((function(n,r){var a=e.apply(t,o);function c(e){Xe(a,n,r,c,l,"next",e)}function l(e){Xe(a,n,r,c,l,"throw",e)}c(void 0)}))}}function Ge(e,t){var o=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),o.push.apply(o,n)}return o}function Je(e){for(var t=1;t<arguments.length;t++){var o=null!=arguments[t]?arguments[t]:{};t%2?Ge(Object(o),!0).forEach((function(t){Ke(e,t,o[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(o)):Ge(Object(o)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(o,t))}))}return e}function Ke(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e}const et={setup:function(){var e=(0,f.oR)(),t=(0,n.inject)("emitter"),o=(0,n.inject)("container"),r=(0,n.ref)(null),a=(0,n.computed)((function(){return e.getters.getUsers})),c=(0,n.computed)((function(){return e.getters.getProfile})),l=Je({},e.getters.getEmptyCompany),i=(0,n.reactive)(Je({},l));function s(){return(s=Ye(w().mark((function n(){return w().wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,r.value.validate();case 3:return n.next=5,o.CompanyService.updateCompany(i);case 5:"personnel"!==c.value.role&&"hr"!==c.value.role&&(i.manager=a.value[i.manager_id]),e.commit("company/setCompanyById",i),t.emit("notification-success","company was updated"),document.getElementById("editCompanyFormClose").click(),n.next=14;break;case 11:n.prev=11,n.t0=n.catch(0),n.t0.response.data&&t.emit("notification-error",n.t0.response.data);case 14:case"end":return n.stop()}}),n,null,[[0,11]])})))).apply(this,arguments)}function m(e){Object.keys(e).forEach((function(t){return i[t]=e[t]}))}return t.on("edit-company-form",m),(0,n.onBeforeUnmount)((function(){return t.off("edit-company-form",m)})),{company:i,companyFields:r,updateCompany:function(){return s.apply(this,arguments)}}},components:{CompanyFormFields:_e},render:function(e,t,o,r,a,c){const l=(0,n.resolveComponent)("CompanyFormFields");return(0,n.openBlock)(),(0,n.createBlock)("div",Me,[(0,n.createVNode)("div",ze,[(0,n.createVNode)("form",qe,[$e,(0,n.createVNode)("div",Le,[(0,n.createVNode)(l,{ref:"companyFields",company:r.company},null,8,["company"])]),(0,n.createVNode)("div",Qe,[We,(0,n.createVNode)("button",{onClick:t[1]||(t[1]=(0,n.withModifiers)(((...e)=>r.updateCompany(...e)),["prevent"])),type:"button",class:"btn btn-primary"},"Update")])])])])}},tt=et;const ot={setup:function(){var e=(0,f.oR)(),t=(0,n.inject)("emitter");return{profile:(0,n.computed)((function(){return e.getters.getProfile})),companies:(0,n.computed)((function(){return e.getters.getCompanies})),initializeCompanyStoreForm:function(){return t.emit("create-company-form")},refresh:function(){return e.dispatch("company/setCompaniesToStore")}}},components:{CompaniesTableHead:g,CompaniesTableRow:X,CreateCompanyForm:Ze,EditCompanyForm:tt,NoRecords:o(1698).Z,Control:F},render:function(e,t,o,i,s,m){const d=(0,n.resolveComponent)("Control"),p=(0,n.resolveComponent)("CompaniesTableHead"),u=(0,n.resolveComponent)("CompaniesTableRow"),f=(0,n.resolveComponent)("NoRecords");return(0,n.openBlock)(),(0,n.createBlock)("div",r,[a,(0,n.createVNode)(d),Object.keys(i.companies).length>0?((0,n.openBlock)(),(0,n.createBlock)("div",c,[(0,n.createVNode)("table",l,[(0,n.createVNode)(p),(0,n.createVNode)("tbody",null,[((0,n.openBlock)(!0),(0,n.createBlock)(n.Fragment,null,(0,n.renderList)(i.companies,(e=>((0,n.openBlock)(),(0,n.createBlock)(u,{company:e,key:e.id+e.name},null,8,["company"])))),128))])])])):((0,n.openBlock)(),(0,n.createBlock)(f,{key:1}))])}},nt={setup:function(){var e=(0,f.oR)(),t=0===Object.keys(e.getters.getCompanies).length,o=0===Object.keys(e.getters.getUsers).length,n=0===Object.keys(e.getters.getEmployees).length;t&&e.dispatch("company/setCompaniesToStore"),n&&e.dispatch("employee/setEmployeesToStore"),o&&e.dispatch("user/setUsersToStore")},components:{CompaniesTable:ot,CreateCompanyForm:Ze,EditCompanyForm:tt},render:function(e,t,o,r,a,c){const l=(0,n.resolveComponent)("CompaniesTable"),i=(0,n.resolveComponent)("CreateCompanyForm"),s=(0,n.resolveComponent)("EditCompanyForm");return(0,n.openBlock)(),(0,n.createBlock)(n.Fragment,null,[(0,n.createVNode)(l),(0,n.createVNode)(i),(0,n.createVNode)(s)],64)}},rt=nt}}]);