import{_ as a}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{o as i,e as c,a as e,t as n,f as h,p as u,q as p}from"./app-_BQdblzI.js";const _={props:{latitude:{type:Number,required:!0},longitude:{type:Number,required:!0},address:{type:String,required:!0}},data(){return{showModal:!1,url:`https://www.google.com/maps/embed/v1/place?key=AIzaSyD838-bKnRCBtmc2HgdkxH-GvykXOhUKWI&q=${this.latitude},${this.longitude}`}},mounted(){},methods:{openModal(){this.showModal=!0},closeModal(){this.showModal=!1,this.$emit("close")}}},w=t=>(u("data-v-f451add9"),t=t(),p(),t),f={key:0,class:"fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-10"},m={class:"bg-white rounded-lg shadow-lg overflow-hidden w-11/12 max-w-2xl"},g={class:"p-4 border-b"},b={class:"flex justify-between items-center"},y={class:"text-lg font-semibold"},k=w(()=>e("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-6 w-6",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1)),v=[k],x={class:"p-4"},M=["src"];function I(t,o,r,S,s,d){return s.showModal?(i(),c("div",f,[e("div",m,[e("div",g,[e("div",b,[e("h2",y,n(r.address),1),e("button",{class:"text-black",onClick:o[0]||(o[0]=(...l)=>d.closeModal&&d.closeModal(...l))},v)])]),e("div",x,[e("iframe",{src:s.url,width:"800",height:"600",style:{border:"0"},allowfullscreen:"true",loading:"lazy",referrerpolicy:"no-referrer-when-downgrade",allow:"geolocation"},null,8,M)])])])):h("",!0)}const C=a(_,[["render",I],["__scopeId","data-v-f451add9"]]);export{C as default};
