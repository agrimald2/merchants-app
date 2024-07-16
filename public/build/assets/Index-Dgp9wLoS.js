import{_ as b}from"./AdminLayout-Bdfyu58J.js";import{i as u,j as v,o as a,c as V,w as _,a as e,k as g,v as p,e as d,h,t as r,F as m,l as w,g as x}from"./app-B04sb2MP.js";import{_ as k}from"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ResponsiveNavLink-BuWZS_x3.js";const A={components:{AdminLayout:b},data(){return{asignedVisits:[],regions:[],locations:[],selectedRegion:"",selectedLocation:"",selectedFrequency:"",searchQuery:""}},computed:{filteredAsignedVisits(){return this.asignedVisits.filter(i=>(this.selectedRegion===""||i.region_id===this.selectedRegion)&&(this.selectedLocation===""||i.location_id===this.selectedLocation)&&(this.selectedFrequency===""||i.frequency===parseInt(this.selectedFrequency))&&(this.searchQuery===""||i.merchant.toLowerCase().includes(this.searchQuery.toLowerCase())))}},mounted(){this.getRegions(),this.getLocations(),this.getAsignedVisits()},methods:{goBack(){this.$inertia.get(route("admin.uploadData"))},async getRegions(){try{const i=await u.get("/api/regions");this.regions=i.data}catch(i){console.error("Error fetching regions:",i)}},async getLocations(){try{const i=await u.get("/api/locations");this.locations=i.data}catch(i){console.error("Error fetching locations:",i)}},async getAsignedVisits(){try{const i=await u.get("/admin/getAsignedVisits");this.asignedVisits=i.data}catch(i){console.error("Error fetching asigned visits:",i)}},triggerFileInput(){this.$refs.fileInput.click()},handleFileUpload(i){const s=i.target.files[0];if(s){const c=new FormData;c.append("file",s),u.post("/admin/merchants-pointOfSales/upload",c,{headers:{"Content-Type":"multipart/form-data"}}).then(l=>{this.getAsignedVisits(),alert("Archivo subido exitosamente")}).catch(l=>{console.error("Error uploading file:",l),alert("Error al subir el archivo")})}},getDayName(i){return["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"][i-1]},filterAsignedVisits(){},exportToExcel(){const i=this.filteredAsignedVisits.map(o=>({Mercaderista:o.merchant,Mercaderista_DNI:o.merchant_dni,PDV:o.pos,PDV_Código:o.pos_code,Locación:o.location,Región:o.region,Frecuencia:o.frequency}));let s="\uFEFF";s+=`Mercaderista,Mercaderista_DNI,PDV,PDV_Código,Locación,Región,Frecuencia
`,i.forEach(o=>{const f=Object.values(o).join(",");s+=f+`
`});const c=new Blob([s],{type:"text/csv;charset=utf-8;"}),l=document.createElement("a"),n=URL.createObjectURL(c);l.setAttribute("href",n),l.setAttribute("download","asignación_visitas.csv"),document.body.appendChild(l),l.click(),document.body.removeChild(l)}}},F={class:"flex items-center justify-between w-full"},L=e("i",{class:"fa-solid fa-circle-chevron-left"},null,-1),D=[L],C=e("h2",{class:"font-semibold text-lg text-white leading-tight mx-auto"}," Asignación de Visitas ",-1),E=e("div",{class:"w-8"},null,-1),R={class:"max-w-3xl mx-auto p-4"},M={class:"bg-white p-4 mb-2"},I={class:"filters"},q={class:"grid grid-cols-3 gap-4 mb-4"},B=e("label",{for:"region",class:"block text-sm font-medium text-gray-700"},"Región",-1),T=e("option",{value:""},"Todos",-1),U=["value"],S=e("label",{for:"location",class:"block text-sm font-medium text-gray-700"},"Locación",-1),N=e("option",{value:""},"Todos",-1),P=["value"],j=e("label",{for:"frequency",class:"block text-sm font-medium text-gray-700"},"Frecuencia",-1),Q=e("option",{value:""},"Todos",-1),O=e("option",{value:"1"},"Lunes",-1),J=e("option",{value:"2"},"Martes",-1),z=e("option",{value:"3"},"Miércoles",-1),G=e("option",{value:"4"},"Jueves",-1),H=e("option",{value:"5"},"Viernes",-1),K=e("option",{value:"6"},"Sábado",-1),W=e("option",{value:"7"},"Domingo",-1),X=[Q,O,J,z,G,H,K,W],Y={class:"mb-4"},Z=e("label",{for:"merchantSearch",class:"block text-sm font-medium text-gray-700"},"Buscar Mercaderista",-1),$={class:"grid grid-cols-2 sm:grid-cols-2 gap-4"},ee=e("i",{class:"fa-solid fa-file-excel mr-2"},null,-1),te=e("i",{class:"fa-solid fa-file-excel mr-2"},null,-1),se={class:"overflow-x-auto lg:block"},oe={class:"min-w-full bg-white shadow-md rounded-lg overflow-hidden"},ie=e("thead",{class:"bg-gray-200"},[e("tr",null,[e("th",{class:"py-3 px-4 text-left"},"#"),e("th",{class:"py-3 px-4 text-left"},"Mercaderista"),e("th",{class:"py-3 px-4 text-left"},"PDV"),e("th",{class:"py-3 px-4 text-left"},"Locación"),e("th",{class:"py-3 px-4 text-left"},"Región"),e("th",{class:"py-3 px-4 text-left"},"Frecuencia")])],-1),ne={class:"py-3 px-4"},le={class:"py-3 px-4"},re={class:"py-3 px-4"},ae={class:"py-3 px-4"},de={class:"py-3 px-4"},ce={class:"py-3 px-4"};function ue(i,s,c,l,n,o){const f=v("AdminLayout");return a(),V(f,{title:"POS"},{header:_(()=>[e("div",F,[e("button",{onClick:s[0]||(s[0]=(...t)=>o.goBack&&o.goBack(...t)),class:"text-white"},D),C,E])]),default:_(()=>[e("div",R,[e("div",M,[e("div",I,[e("div",q,[e("div",null,[B,g(e("select",{id:"region","onUpdate:modelValue":s[1]||(s[1]=t=>n.selectedRegion=t),class:"mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md",onChange:s[2]||(s[2]=(...t)=>o.filterAsignedVisits&&o.filterAsignedVisits(...t))},[T,(a(!0),d(m,null,h(n.regions,t=>(a(),d("option",{key:t.id,value:t.id},r(t.name),9,U))),128))],544),[[p,n.selectedRegion]])]),e("div",null,[S,g(e("select",{id:"location","onUpdate:modelValue":s[3]||(s[3]=t=>n.selectedLocation=t),class:"mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md",onChange:s[4]||(s[4]=(...t)=>o.filterAsignedVisits&&o.filterAsignedVisits(...t))},[N,(a(!0),d(m,null,h(n.locations,t=>(a(),d("option",{key:t.id,value:t.id},r(t.name),9,P))),128))],544),[[p,n.selectedLocation]])]),e("div",null,[j,g(e("select",{id:"frequency","onUpdate:modelValue":s[5]||(s[5]=t=>n.selectedFrequency=t),class:"mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md",onChange:s[6]||(s[6]=(...t)=>o.filterAsignedVisits&&o.filterAsignedVisits(...t))},X,544),[[p,n.selectedFrequency]])])]),e("div",Y,[Z,g(e("input",{type:"text",id:"merchantSearch","onUpdate:modelValue":s[7]||(s[7]=t=>n.searchQuery=t),class:"mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md",placeholder:"Buscar por Nombre",onInput:s[8]||(s[8]=(...t)=>o.filterAsignedVisits&&o.filterAsignedVisits(...t))},null,544),[[w,n.searchQuery]])]),e("div",$,[e("div",null,[e("button",{class:"bg-blue-500 text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold",onClick:s[9]||(s[9]=(...t)=>o.exportToExcel&&o.exportToExcel(...t))},[ee,x(" Exportar Excel ")])]),e("div",null,[e("input",{type:"file",ref:"fileInput",onChange:s[10]||(s[10]=(...t)=>o.handleFileUpload&&o.handleFileUpload(...t)),class:"hidden"},null,544),e("button",{class:"bg-green-700 text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold",onClick:s[11]||(s[11]=(...t)=>o.triggerFileInput&&o.triggerFileInput(...t))},[te,x(" Importar Excel ")])])])])]),e("div",se,[e("table",oe,[ie,e("tbody",null,[(a(!0),d(m,null,h(o.filteredAsignedVisits,(t,y)=>(a(),d("tr",{key:t.id,class:"border-b hover:bg-gray-100"},[e("td",ne,r(y+1),1),e("td",le,r(t.merchant),1),e("td",re,r(t.pos),1),e("td",ae,r(t.location),1),e("td",de,r(t.region),1),e("td",ce,r(o.getDayName(t.frequency)),1)]))),128))])])])])]),_:1})}const me=k(A,[["render",ue]]);export{me as default};
