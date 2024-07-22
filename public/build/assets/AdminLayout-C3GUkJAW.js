import{d as b,o as i,e as n,b as t,u as h,Z as v,a as e,w as o,A as x,g as a,t as l,m,n as y,f,r as _,D as w}from"./app-BOXK8myb.js";import{_ as $,a as k,b as p,c as S,d}from"./ResponsiveNavLink-C3verbGM.js";const C={class:"min-h-screen bg-gray-100"},D={class:"bg-red-ac sticky top-0 z-50"},N={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},P={class:"flex justify-between h-16"},j={class:"flex items-center"},A={class:"shrink-0 flex items-center"},B=e("img",{src:"https://companieslogo.com/img/orig/AC.MX_BIG.D-d3508e09.png?t=1640335174",alt:"",class:"h-8 w-auto"},null,-1),V={class:"sm:flex items-center mx-4 text-white absolute left-1/2 transform -translate-x-1/2 font-bold"},M=e("i",{class:"fa-solid fa-face-laugh-wink"},null,-1),z={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},T={class:"hidden sm:flex sm:items-center sm:ms-6"},E={class:"ms-3 relative"},F={class:"inline-flex rounded-md"},G={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"},H=e("i",{class:"fa-solid fa-bars text-white"},null,-1),I=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Account ",-1),L=e("div",{class:"border-t border-gray-200"},null,-1),O={class:"-me-2 flex items-center sm:hidden"},X=e("i",{class:"fa-solid fa-bars text-white"},null,-1),Z=[X],q={class:"pt-2 pb-3 space-y-1"},J=e("span",{class:"font-bold"},"Dashboard",-1),K={class:"pt-4 pb-1 border-t border-gray-200"},Q={class:"flex items-center px-4"},R={key:0,class:"shrink-0 me-3"},U=["src","alt"],W={class:"font-medium text-sm text-gray-500"},Y={class:"mt-3 space-y-1"},ee={key:0,class:"bg-red-ac shadow rounded-b-3xl"},se={class:"max-w-7xl mx-auto pb-3 px-4 sm:px-6 lg:px-8 pt-2"},re={__name:"AdminLayout",props:{title:String},setup(g){const r=b(!1),c=()=>{w.post(route("logout"))};return(s,u)=>(i(),n("div",null,[t(h(v),{title:g.title},null,8,["title"]),t($),e("div",C,[e("nav",D,[e("div",N,[e("div",P,[e("div",j,[e("div",A,[t(h(x),{href:s.route("dashboard")},{default:o(()=>[B]),_:1},8,["href"])]),e("div",V,[M,a(" ¡Hola "+l(s.$page.props.auth.user.name.substring(0,10))+"...! ",1)]),e("div",z,[t(k,{href:s.route("dashboard"),active:s.route().current("dashboard")},{default:o(()=>[a(" Dashboard ")]),_:1},8,["href","active"])])]),e("div",T,[e("div",E,[t(S,{align:"right",width:"48"},{trigger:o(()=>[e("span",F,[e("button",G,[a(l(s.$page.props.auth.user.name)+" ",1),H])])]),content:o(()=>[I,t(p,{href:s.route("profile.show")},{default:o(()=>[a(" Perfil ")]),_:1},8,["href"]),L,e("form",{onSubmit:m(c,["prevent"])},[t(p,{as:"button"},{default:o(()=>[a(" Cerrar Sesión ")]),_:1})],32)]),_:1})])]),e("div",O,[e("button",{class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out",onClick:u[0]||(u[0]=te=>r.value=!r.value)},Z)])])]),e("div",{class:y([{block:r.value,hidden:!r.value},"sm:hidden bg-white-ac"])},[e("div",q,[t(d,{href:s.route("dashboard"),active:s.route().current("dashboard")},{default:o(()=>[J]),_:1},8,["href","active"])]),e("div",K,[e("div",Q,[s.$page.props.jetstream.managesProfilePhotos?(i(),n("div",R,[e("img",{class:"h-10 w-10 rounded-full object-cover",src:s.$page.props.auth.user.profile_photo_url,alt:s.$page.props.auth.user.name},null,8,U)])):f("",!0),e("div",null,[e("div",W,l(s.$page.props.auth.user.username),1)])]),e("div",Y,[t(d,{href:s.route("profile.show"),active:s.route().current("profile.show")},{default:o(()=>[a(" Perfil ")]),_:1},8,["href","active"]),e("form",{method:"POST",onSubmit:m(c,["prevent"])},[t(d,{as:"button"},{default:o(()=>[a(" Cerrar Sesión ")]),_:1})],32)])])],2)]),s.$slots.header?(i(),n("header",ee,[e("div",se,[_(s.$slots,"header")])])):f("",!0),e("main",null,[_(s.$slots,"default")])])]))}};export{re as _};
