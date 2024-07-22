import{i as d,o as l,e as c,a as t,t as a,g as _}from"./app-BOXK8myb.js";import{_ as f}from"./_plugin-vue_export-helper-DlAUqK2U.js";const m={components:{},props:["visit"],data(){return{isModalVisible:!1}},mounted(){},methods:{toggleQRModal(){this.$emit("scan")},startVisit(){console.log(this.visit.id),navigator.geolocation?navigator.geolocation.getCurrentPosition(async e=>{const{latitude:o,longitude:i}=e.coords;try{const s=await d.post(route("merchant.startVisit"),{code:this.visit.point_of_sale.code,start_latitude:o,start_longitude:i});console.log("Visit started:",s.data),window.location.href=route("merchant.view.visit",{id:s.data.id}),this.closeModal()}catch(s){console.error("Error starting visit:",s),this.errorText=`Error Code 1: ${s.message}`}},e=>{e.code===e.PERMISSION_DENIED&&alert("Activa los permisos de ubicación para realizar una visita."),this.errorText=`Error Code 2: ${e.message}`}):(console.error("Geolocation is not supported by this browser."),this.errorText="Not supported by this browser")}}},p={class:"bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3 border border-red-500"},h={class:"flex items-center"},u={class:"flex items-center space-x-2"},g={class:"flex items-center"},x=t("i",{class:"fa-solid fa-user"},null,-1),v={class:"font-bold text-gray-900 ml-2"},b={class:"text-right border-l border-gray-200 pl-2"},w={class:"flex items-center space-x-2"},y={class:"flex items-center"},V=t("i",{class:"fa-solid fa-qrcode mr-2"},null,-1);function E(e,o,i,s,C,r){return l(),c("div",p,[t("div",h,[t("div",u,[t("div",null,[t("div",g,[x,t("div",v,a(i.visit.point_of_sale.code)+" - "+a(i.visit.point_of_sale.name),1)])])])]),t("div",b,[t("div",w,[t("div",null,[t("div",y,[t("button",{class:"bg-red-ac text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold",onClick:o[0]||(o[0]=(...n)=>r.startVisit&&r.startVisit(...n))},[V,_(" Visitar ")])])])])])])}const T=f(m,[["render",E]]);export{T as default};
