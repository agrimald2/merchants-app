import{_ as f}from"./AdminLayout-PtFUZn3f.js";import{i as r,j as n,o,c as a,w as c,a as e,t as _,e as d,h as g,F as m,b as x,f as v}from"./app-BHIhVOyI.js";import"./ResponsiveNavLink-Dp1mmoJj.js";const V={class:"font-semibold text-lg text-white leading-tight text-center"},b={class:"max-w-2xl mx-auto"},w=e("div",{class:"bg-white p-4"},[e("div",{class:"filters"},[e("div",{class:"grid grid-cols-3 gap-4 mb-4"},[e("div",{class:"bg-red-500 text-white rounded-lg p-4 flex flex-col items-center"},[e("div",{class:"text-2xl font-bold"},"10"),e("div",{class:"text-sm"},"Objetivo")]),e("div",{class:"bg-green-500 text-white rounded-lg p-4 flex flex-col items-center"},[e("div",{class:"text-2xl font-bold"},"5"),e("div",{class:"text-sm"},"Realizadas")]),e("div",{class:"bg-yellow-500 text-white rounded-lg p-4 flex flex-col items-center"},[e("div",{class:"text-2xl font-bold"},"5"),e("div",{class:"text-sm"},"Pendientes")])])])],-1),C={class:"px-3 pt-6"},P=e("p",null,"Visitas Pendientes",-1),y={class:"px-3 pt-6"},Q=e("p",null,"Visitas Realizadas",-1),S=e("i",{class:"fa-solid fa-qrcode"},null,-1),D=[S],R={components:{DoneVisitsComponent,PendingVisitsComponent,ScanQR},data(){return{}},created(){this.fetchPendingVisits(),this.fetchIsOnVisit()},methods:{toggleQrModal(){console.log("Hola 2"),this.isQRModalVisible=!this.isQRModalVisible},async fetchPendingVisits(){try{const t=await r.get(route("merchant.pendingVisits"));this.pendingVisits=t.data}catch(t){console.error("Error fetching pending visits:",t)}},async fetchIsOnVisit(){try{const t=await r.post(route("merchant.isOnVisit"));console.log(t.data)}catch(t){console.error("Error fetching is on visit:",t)}},requestLocationPermission(){navigator.geolocation?navigator.geolocation.getCurrentPosition(()=>{this.toggleQrModal()},t=>{t.code===t.PERMISSION_DENIED&&alert("Location permission is required to start a visit. Please enable location services.")}):alert("Geolocation is not supported by this browser.")}}},k=Object.assign(R,{__name:"OnVisit",setup(t){return(s,l)=>{const p=n("PendingVisitsComponent"),h=n("DoneVisitsComponent"),u=n("ScanQR");return o(),a(f,{title:"Dashboard"},{header:c(()=>[e("h2",V,_(new Date().toLocaleDateString("es-ES",{weekday:"long",month:"long",day:"numeric"})),1)]),default:c(()=>[e("div",b,[w,e("div",C,[P,(o(!0),d(m,null,g(s.pendingVisits,i=>(o(),a(p,{visit:i,onScan:s.toggleQrModal},null,8,["visit","onScan"]))),256))]),e("div",y,[Q,(o(),d(m,null,g(3,i=>x(h)),64))]),e("button",{onClick:l[0]||(l[0]=(...i)=>s.requestLocationPermission&&s.requestLocationPermission(...i)),class:"fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-full shadow-lg flex items-center justify-center"},D)]),s.isQRModalVisible?(o(),a(u,{key:0,onClose:s.toggleQrModal},null,8,["onClose"])):v("",!0)]),_:1})}}});export{k as default};
