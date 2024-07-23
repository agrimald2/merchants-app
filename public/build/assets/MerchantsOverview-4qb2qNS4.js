import{_ as b}from"./AdminLayout-CN6NgqNZ.js";import y from"./MerchantProgressComponent-DVubSeHa.js";import M from"./AddManualVisit-DWk13Qq4.js";import{i,j as c,o as n,c as u,w as f,a as e,k as d,v as p,e as l,h,t as v,F as g,l as P,b as V}from"./app-CxrSCD6l.js";import{_ as k}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ResponsiveNavLink-BlnKUect.js";import"./LoaderModal-25VVEvSX.js";const D={components:{AdminLayout:b,MerchantProgressComponent:y,AddManualVisit:M},props:["visits"],data(){return{regions:[],locations:[],filteredLocations:[],merchants:[],merchantProgresses:[],selectedRegion:"",selectedLocation:"",selectedMerchant:"",selectedDate:new Date().toISOString().substr(0,10),averageProgress:0,showModal:!1}},mounted(){this.getRegions(),this.getLocations(),this.getMerchants(),this.getMerchantProgresses()},methods:{async getRegions(){try{const t=await i.get("/api/regions");this.regions=t.data}catch(t){console.error("Error fetching regions:",t)}},async getLocations(){try{const t=await i.get("/api/locations");this.locations=t.data,this.filteredLocations=this.locations}catch(t){console.error("Error fetching locations:",t)}},async getMerchants(){try{const t=await i.get("/admin/merchants/all");this.merchants=t.data}catch(t){console.error("Error fetching merchants:",t)}},async getMerchantProgresses(){try{const t=await i.get(`/admin/generalVisitProgress/${this.selectedDate}`);this.merchantProgresses=t.data,this.calculateAverageProgress()}catch(t){console.error("Error fetching merchant progresses:",t)}},async filterData(){try{const t=await i.get(`/admin/generalVisitProgress/${this.selectedDate}`,{params:{region_id:this.selectedRegion,location_id:this.selectedLocation,merchant_id:this.selectedMerchant}});this.merchantProgresses=t.data,this.calculateAverageProgress()}catch(t){console.error("Error filtering data:",t)}},filterLocations(){this.selectedRegion?this.filteredLocations=this.locations.filter(t=>t.region_id===this.selectedRegion):this.filteredLocations=this.locations},calculateAverageProgress(){if(this.merchantProgresses.length>0){const t=this.merchantProgresses.reduce((o,m)=>o+m.progress,0);this.averageProgress=(t/this.merchantProgresses.length).toFixed(2)}else this.averageProgress=0},addNewItem(){this.showModal=!0},async handleSaveVisit(t){try{await i.post("/admin/assignMerchantVisitManual",t),this.showModal=!1,this.getMerchantProgresses()}catch(o){console.error("Error saving visit:",o)}}}},L=e("h2",{class:"font-semibold text-lg text-white leading-tight text-center"}," Visitas ",-1),C={class:"bg-white p-4 max-w-3xl mx-auto"},A={class:"filters"},E={class:"grid grid-cols-1 gap-4 mb-4"},S=e("label",{for:"location",class:"block text-sm font-medium text-gray-700"},"Locación",-1),R=e("option",{value:""},"Todos",-1),j=["value"],B={class:"mb-4"},N=e("label",{for:"merchant",class:"block text-sm font-medium text-gray-700"},"Seleccionar Mercaderista",-1),I=e("option",{value:""},"Todos",-1),F=["value"],O=e("label",{for:"date",class:"block text-sm font-medium text-gray-700"},"Elige una fecha",-1),T={class:"mt-1 relative rounded-md shadow-sm"},U=e("div",{class:"absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"},[e("svg",{class:"h-5 w-5 text-gray-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M8 7V3m8 4V3m-4 14h.01M12 21v-5m0 0H9m3 0h3m-3 0V3m0 16h.01M8 7V3m8 4V3m-4 14h.01"})])],-1),H={class:"mt-4 flex justify-end"},q=e("i",{class:"fa-solid fa-plus"},null,-1),z=[q],G={class:"px-3 pt-2 max-w-3xl mx-auto"},J=e("div",{class:"bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3 w-full"},[e("div",{class:"grid grid-cols-8 w-full py-1"},[e("div",{class:"col-span-4 text-left font-bold text-red-800 text-lg"}," Mercaderista "),e("div",{class:"col-span-2 text-left font-bold text-red-800 text-lg"}," Objetivo "),e("div",{class:"col-span-2 text-left font-bold text-red-800 text-lg"}," Avance ")])],-1);function K(t,o,m,Q,r,a){const x=c("AddManualVisit"),_=c("MerchantProgressComponent"),w=c("AdminLayout");return n(),u(w,{title:"Dashboard"},{header:f(()=>[L]),default:f(()=>[e("div",C,[e("div",A,[e("div",E,[e("div",null,[S,d(e("select",{id:"location","onUpdate:modelValue":o[0]||(o[0]=s=>r.selectedLocation=s),onChange:o[1]||(o[1]=(...s)=>a.filterData&&a.filterData(...s)),class:"mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"},[R,(n(!0),l(g,null,h(r.filteredLocations,s=>(n(),l("option",{key:s.id,value:s.id},v(s.name),9,j))),128))],544),[[p,r.selectedLocation]])])]),e("div",B,[N,d(e("select",{id:"merchant","onUpdate:modelValue":o[2]||(o[2]=s=>r.selectedMerchant=s),onChange:o[3]||(o[3]=(...s)=>a.filterData&&a.filterData(...s)),class:"mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"},[I,(n(!0),l(g,null,h(r.merchants,s=>(n(),l("option",{key:s.id,value:s.id},v(s.name),9,F))),128))],544),[[p,r.selectedMerchant]])]),e("div",null,[O,e("div",T,[U,d(e("input",{type:"date",id:"date","onUpdate:modelValue":o[4]||(o[4]=s=>r.selectedDate=s),onChange:o[5]||(o[5]=(...s)=>a.filterData&&a.filterData(...s)),class:"block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm",placeholder:"Elige una fecha"},null,544),[[P,r.selectedDate]])])]),e("div",H,[e("button",{onClick:o[6]||(o[6]=(...s)=>a.addNewItem&&a.addNewItem(...s)),class:"bg-green-500 text-white px-2 py-1 rounded-full"},z)])])]),e("div",G,[V(x,{showModal:r.showModal,onClose:o[7]||(o[7]=s=>r.showModal=!1),onSave:a.handleSaveVisit},null,8,["showModal","onSave"]),J,(n(!0),l(g,null,h(r.merchantProgresses,s=>(n(),u(_,{key:s.merchant_id,merchantProgress:s,date:r.selectedDate},null,8,["merchantProgress","date"]))),128))])]),_:1})}const se=k(D,[["render",K]]);export{se as default};
