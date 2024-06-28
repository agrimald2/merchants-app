import{T as c,o as f,e as w,b as e,u as a,w as l,F as _,Z as g,a as t,n as V,g as b,p as k}from"./app-DuZ7Hec_.js";import{A as v,_ as x}from"./AuthenticationCardLogo-CZ_WbEo1.js";import{_ as m,a as i}from"./TextInput-BPWt79j0.js";import{_ as n}from"./InputLabel-QDSagxhY.js";import{_ as y}from"./PrimaryButton-DpTmOzxi.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const P={class:"mt-4"},$={class:"mt-4"},C={class:"flex items-center justify-end mt-4"},h={__name:"ResetPassword",props:{email:String,token:String},setup(p){const d=p,s=c({token:d.token,email:d.email,password:"",password_confirmation:""}),u=()=>{s.post(route("password.update"),{onFinish:()=>s.reset("password","password_confirmation")})};return(q,o)=>(f(),w(_,null,[e(a(g),{title:"Reset Password"}),e(v,null,{logo:l(()=>[e(x)]),default:l(()=>[t("form",{onSubmit:k(u,["prevent"])},[t("div",null,[e(n,{for:"email",value:"Email"}),e(m,{id:"email",modelValue:a(s).email,"onUpdate:modelValue":o[0]||(o[0]=r=>a(s).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(i,{class:"mt-2",message:a(s).errors.email},null,8,["message"])]),t("div",P,[e(n,{for:"password",value:"Password"}),e(m,{id:"password",modelValue:a(s).password,"onUpdate:modelValue":o[1]||(o[1]=r=>a(s).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"]),e(i,{class:"mt-2",message:a(s).errors.password},null,8,["message"])]),t("div",$,[e(n,{for:"password_confirmation",value:"Confirm Password"}),e(m,{id:"password_confirmation",modelValue:a(s).password_confirmation,"onUpdate:modelValue":o[2]||(o[2]=r=>a(s).password_confirmation=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"]),e(i,{class:"mt-2",message:a(s).errors.password_confirmation},null,8,["message"])]),t("div",C,[e(y,{class:V({"opacity-25":a(s).processing}),disabled:a(s).processing},{default:l(()=>[b(" Reset Password ")]),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{h as default};
