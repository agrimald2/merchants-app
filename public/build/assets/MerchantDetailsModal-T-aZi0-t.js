import{i as n,o,e as l,a as e,t}from"./app-DuZ7Hec_.js";import{_ as c}from"./_plugin-vue_export-helper-DlAUqK2U.js";const d={data(){return{name:"",username:"",dni:"",phone:""}},methods:{addMerchant(){n.post("/admin/merchants",this.newMerchant).then(s=>{this.merchants.push(s.data),this.showAddModal=!1,this.newMerchant={name:"",username:"",dni:"",phone:""}}).catch(s=>{console.error("Error adding merchant:",s)})}}},i={class:"fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"},r={class:"bg-white p-6 rounded-lg shadow-lg w-1/2"},h=e("h2",{class:"text-lg font-semibold mb-4"},"Merchant Details",-1),m={class:"mb-4"},_=e("label",{class:"block text-gray-700"},"Name",-1),p={class:"mb-4"},b=e("label",{class:"block text-gray-700"},"Username",-1),u={class:"mb-4"},f=e("label",{class:"block text-gray-700"},"DNI",-1),g={class:"mb-4"},M=e("label",{class:"block text-gray-700"},"Phone",-1),y={class:"flex justify-end"};function x(s,a,k,v,w,D){return o(),l("div",i,[e("div",r,[h,e("div",m,[_,e("p",null,t(s.selectedMerchant.name),1)]),e("div",p,[b,e("p",null,t(s.selectedMerchant.username),1)]),e("div",u,[f,e("p",null,t(s.selectedMerchant.dni),1)]),e("div",g,[M,e("p",null,t(s.selectedMerchant.phone),1)]),e("div",y,[e("button",{onClick:a[0]||(a[0]=$=>s.showDetailsModal=!1),class:"bg-gray-500 text-white px-4 py-2 rounded-md"},"Close")])])])}const j=c(d,[["render",x]]);export{j as default};
