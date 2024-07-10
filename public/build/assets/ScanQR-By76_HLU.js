import{_ as R,i as M,o as O,e as $,a as m,f as D,k,l as x,s as b,x as P}from"./app-BHIhVOyI.js";import{_ as L}from"./_plugin-vue_export-helper-DlAUqK2U.js";class n{constructor(e,t,i,a,s){this._legacyCanvasSize=n.DEFAULT_CANVAS_SIZE,this._preferredCamera="environment",this._maxScansPerSecond=25,this._lastScanTimestamp=-1,this._destroyed=this._flashOn=this._paused=this._active=!1,this.$video=e,this.$canvas=document.createElement("canvas"),i&&typeof i=="object"?this._onDecode=t:(console.warn(i||a||s?"You're using a deprecated version of the QrScanner constructor which will be removed in the future":"Note that the type of the scan result passed to onDecode will change in the future. To already switch to the new api today, you can pass returnDetailedScanResult: true."),this._legacyOnDecode=t),t=typeof i=="object"?i:{},this._onDecodeError=t.onDecodeError||(typeof i=="function"?i:this._onDecodeError),this._calculateScanRegion=t.calculateScanRegion||(typeof a=="function"?a:this._calculateScanRegion),this._preferredCamera=t.preferredCamera||s||this._preferredCamera,this._legacyCanvasSize=typeof i=="number"?i:typeof a=="number"?a:this._legacyCanvasSize,this._maxScansPerSecond=t.maxScansPerSecond||this._maxScansPerSecond,this._onPlay=this._onPlay.bind(this),this._onLoadedMetaData=this._onLoadedMetaData.bind(this),this._onVisibilityChange=this._onVisibilityChange.bind(this),this._updateOverlay=this._updateOverlay.bind(this),e.disablePictureInPicture=!0,e.playsInline=!0,e.muted=!0;let o=!1;if(e.hidden&&(e.hidden=!1,o=!0),document.body.contains(e)||(document.body.appendChild(e),o=!0),i=e.parentElement,t.highlightScanRegion||t.highlightCodeOutline){if(a=!!t.overlay,this.$overlay=t.overlay||document.createElement("div"),s=this.$overlay.style,s.position="absolute",s.display="none",s.pointerEvents="none",this.$overlay.classList.add("scan-region-highlight"),!a&&t.highlightScanRegion){this.$overlay.innerHTML='<svg class="scan-region-highlight-svg" viewBox="0 0 238 238" preserveAspectRatio="none" style="position:absolute;width:100%;height:100%;left:0;top:0;fill:none;stroke:#e9b213;stroke-width:4;stroke-linecap:round;stroke-linejoin:round"><path d="M31 2H10a8 8 0 0 0-8 8v21M207 2h21a8 8 0 0 1 8 8v21m0 176v21a8 8 0 0 1-8 8h-21m-176 0H10a8 8 0 0 1-8-8v-21"/></svg>';try{this.$overlay.firstElementChild.animate({transform:["scale(.98)","scale(1.01)"]},{duration:400,iterations:1/0,direction:"alternate",easing:"ease-in-out"})}catch{}i.insertBefore(this.$overlay,this.$video.nextSibling)}t.highlightCodeOutline&&(this.$overlay.insertAdjacentHTML("beforeend",'<svg class="code-outline-highlight" preserveAspectRatio="none" style="display:none;width:100%;height:100%;fill:none;stroke:#e9b213;stroke-width:5;stroke-dasharray:25;stroke-linecap:round;stroke-linejoin:round"><polygon/></svg>'),this.$codeOutlineHighlight=this.$overlay.lastElementChild)}this._scanRegion=this._calculateScanRegion(e),requestAnimationFrame(()=>{let l=window.getComputedStyle(e);l.display==="none"&&(e.style.setProperty("display","block","important"),o=!0),l.visibility!=="visible"&&(e.style.setProperty("visibility","visible","important"),o=!0),o&&(console.warn("QrScanner has overwritten the video hiding style to avoid Safari stopping the playback."),e.style.opacity="0",e.style.width="0",e.style.height="0",this.$overlay&&this.$overlay.parentElement&&this.$overlay.parentElement.removeChild(this.$overlay),delete this.$overlay,delete this.$codeOutlineHighlight),this.$overlay&&this._updateOverlay()}),e.addEventListener("play",this._onPlay),e.addEventListener("loadedmetadata",this._onLoadedMetaData),document.addEventListener("visibilitychange",this._onVisibilityChange),window.addEventListener("resize",this._updateOverlay),this._qrEnginePromise=n.createQrEngine()}static set WORKER_PATH(e){console.warn("Setting QrScanner.WORKER_PATH is not required and not supported anymore. Have a look at the README for new setup instructions.")}static async hasCamera(){try{return!!(await n.listCameras(!1)).length}catch{return!1}}static async listCameras(e=!1){if(!navigator.mediaDevices)return[];let t=async()=>(await navigator.mediaDevices.enumerateDevices()).filter(a=>a.kind==="videoinput"),i;try{e&&(await t()).every(a=>!a.label)&&(i=await navigator.mediaDevices.getUserMedia({audio:!1,video:!0}))}catch{}try{return(await t()).map((a,s)=>({id:a.deviceId,label:a.label||(s===0?"Default Camera":`Camera ${s+1}`)}))}finally{i&&(console.warn("Call listCameras after successfully starting a QR scanner to avoid creating a temporary video stream"),n._stopVideoStream(i))}}async hasFlash(){let e;try{if(this.$video.srcObject){if(!(this.$video.srcObject instanceof MediaStream))return!1;e=this.$video.srcObject}else e=(await this._getCameraStream()).stream;return"torch"in e.getVideoTracks()[0].getSettings()}catch{return!1}finally{e&&e!==this.$video.srcObject&&(console.warn("Call hasFlash after successfully starting the scanner to avoid creating a temporary video stream"),n._stopVideoStream(e))}}isFlashOn(){return this._flashOn}async toggleFlash(){this._flashOn?await this.turnFlashOff():await this.turnFlashOn()}async turnFlashOn(){if(!this._flashOn&&!this._destroyed&&(this._flashOn=!0,this._active&&!this._paused))try{if(!await this.hasFlash())throw"No flash available";await this.$video.srcObject.getVideoTracks()[0].applyConstraints({advanced:[{torch:!0}]})}catch(e){throw this._flashOn=!1,e}}async turnFlashOff(){this._flashOn&&(this._flashOn=!1,await this._restartVideoStream())}destroy(){this.$video.removeEventListener("loadedmetadata",this._onLoadedMetaData),this.$video.removeEventListener("play",this._onPlay),document.removeEventListener("visibilitychange",this._onVisibilityChange),window.removeEventListener("resize",this._updateOverlay),this._destroyed=!0,this._flashOn=!1,this.stop(),n._postWorkerMessage(this._qrEnginePromise,"close")}async start(){if(this._destroyed)throw Error("The QR scanner can not be started as it had been destroyed.");if((!this._active||this._paused)&&(window.location.protocol!=="https:"&&console.warn("The camera stream is only accessible if the page is transferred via https."),this._active=!0,!document.hidden))if(this._paused=!1,this.$video.srcObject)await this.$video.play();else try{let{stream:e,facingMode:t}=await this._getCameraStream();!this._active||this._paused?n._stopVideoStream(e):(this._setVideoMirror(t),this.$video.srcObject=e,await this.$video.play(),this._flashOn&&(this._flashOn=!1,this.turnFlashOn().catch(()=>{})))}catch(e){if(!this._paused)throw this._active=!1,e}}stop(){this.pause(),this._active=!1}async pause(e=!1){if(this._paused=!0,!this._active)return!0;this.$video.pause(),this.$overlay&&(this.$overlay.style.display="none");let t=()=>{this.$video.srcObject instanceof MediaStream&&(n._stopVideoStream(this.$video.srcObject),this.$video.srcObject=null)};return e?(t(),!0):(await new Promise(i=>setTimeout(i,300)),this._paused?(t(),!0):!1)}async setCamera(e){e!==this._preferredCamera&&(this._preferredCamera=e,await this._restartVideoStream())}static async scanImage(e,t,i,a,s=!1,o=!1){let l,u=!1;t&&("scanRegion"in t||"qrEngine"in t||"canvas"in t||"disallowCanvasResizing"in t||"alsoTryWithoutScanRegion"in t||"returnDetailedScanResult"in t)?(l=t.scanRegion,i=t.qrEngine,a=t.canvas,s=t.disallowCanvasResizing||!1,o=t.alsoTryWithoutScanRegion||!1,u=!0):console.warn(t||i||a||s||o?"You're using a deprecated api for scanImage which will be removed in the future.":"Note that the return type of scanImage will change in the future. To already switch to the new api today, you can pass returnDetailedScanResult: true."),t=!!i;try{let g,d;[i,g]=await Promise.all([i||n.createQrEngine(),n._loadImage(e)]),[a,d]=n._drawToCanvas(g,l,a,s);let v;if(i instanceof Worker){let r=i;t||n._postWorkerMessageSync(r,"inversionMode","both"),v=await new Promise((h,f)=>{let w,p,y,C=-1;p=_=>{_.data.id===C&&(r.removeEventListener("message",p),r.removeEventListener("error",y),clearTimeout(w),_.data.data!==null?h({data:_.data.data,cornerPoints:n._convertPoints(_.data.cornerPoints,l)}):f(n.NO_QR_CODE_FOUND))},y=_=>{r.removeEventListener("message",p),r.removeEventListener("error",y),clearTimeout(w),f("Scanner error: "+(_?_.message||_:"Unknown Error"))},r.addEventListener("message",p),r.addEventListener("error",y),w=setTimeout(()=>y("timeout"),1e4);let S=d.getImageData(0,0,a.width,a.height);C=n._postWorkerMessageSync(r,"decode",S,[S.data.buffer])})}else v=await Promise.race([new Promise((r,h)=>window.setTimeout(()=>h("Scanner error: timeout"),1e4)),(async()=>{try{var[r]=await i.detect(a);if(!r)throw n.NO_QR_CODE_FOUND;return{data:r.rawValue,cornerPoints:n._convertPoints(r.cornerPoints,l)}}catch(h){if(r=h.message||h,/not implemented|service unavailable/.test(r))return n._disableBarcodeDetector=!0,n.scanImage(e,{scanRegion:l,canvas:a,disallowCanvasResizing:s,alsoTryWithoutScanRegion:o});throw`Scanner error: ${r}`}})()]);return u?v:v.data}catch(g){if(!l||!o)throw g;let d=await n.scanImage(e,{qrEngine:i,canvas:a,disallowCanvasResizing:s});return u?d:d.data}finally{t||n._postWorkerMessage(i,"close")}}setGrayscaleWeights(e,t,i,a=!0){n._postWorkerMessage(this._qrEnginePromise,"grayscaleWeights",{red:e,green:t,blue:i,useIntegerApproximation:a})}setInversionMode(e){n._postWorkerMessage(this._qrEnginePromise,"inversionMode",e)}static async createQrEngine(e){if(e&&console.warn("Specifying a worker path is not required and not supported anymore."),e=()=>R(()=>import("./qr-scanner-worker.min-D85Z9gVD.js"),[]).then(i=>i.createWorker()),!(!n._disableBarcodeDetector&&"BarcodeDetector"in window&&BarcodeDetector.getSupportedFormats&&(await BarcodeDetector.getSupportedFormats()).includes("qr_code")))return e();let t=navigator.userAgentData;return t&&t.brands.some(({brand:i})=>/Chromium/i.test(i))&&/mac ?OS/i.test(t.platform)&&await t.getHighEntropyValues(["architecture","platformVersion"]).then(({architecture:i,platformVersion:a})=>/arm/i.test(i||"arm")&&13<=parseInt(a||"13")).catch(()=>!0)?e():new BarcodeDetector({formats:["qr_code"]})}_onPlay(){this._scanRegion=this._calculateScanRegion(this.$video),this._updateOverlay(),this.$overlay&&(this.$overlay.style.display=""),this._scanFrame()}_onLoadedMetaData(){this._scanRegion=this._calculateScanRegion(this.$video),this._updateOverlay()}_onVisibilityChange(){document.hidden?this.pause():this._active&&this.start()}_calculateScanRegion(e){let t=Math.round(.6666666666666666*Math.min(e.videoWidth,e.videoHeight));return{x:Math.round((e.videoWidth-t)/2),y:Math.round((e.videoHeight-t)/2),width:t,height:t,downScaledWidth:this._legacyCanvasSize,downScaledHeight:this._legacyCanvasSize}}_updateOverlay(){requestAnimationFrame(()=>{if(this.$overlay){var e=this.$video,t=e.videoWidth,i=e.videoHeight,a=e.offsetWidth,s=e.offsetHeight,o=e.offsetLeft,l=e.offsetTop,u=window.getComputedStyle(e),g=u.objectFit,d=t/i,v=a/s;switch(g){case"none":var r=t,h=i;break;case"fill":r=a,h=s;break;default:(g==="cover"?d>v:d<v)?(h=s,r=h*d):(r=a,h=r/d),g==="scale-down"&&(r=Math.min(r,t),h=Math.min(h,i))}var[f,w]=u.objectPosition.split(" ").map((y,C)=>{const S=parseFloat(y);return y.endsWith("%")?(C?s-h:a-r)*S/100:S});u=this._scanRegion.width||t,v=this._scanRegion.height||i,g=this._scanRegion.x||0;var p=this._scanRegion.y||0;d=this.$overlay.style,d.width=`${u/t*r}px`,d.height=`${v/i*h}px`,d.top=`${l+w+p/i*h}px`,i=/scaleX\(-1\)/.test(e.style.transform),d.left=`${o+(i?a-f-r:f)+(i?t-g-u:g)/t*r}px`,d.transform=e.style.transform}})}static _convertPoints(e,t){if(!t)return e;let i=t.x||0,a=t.y||0,s=t.width&&t.downScaledWidth?t.width/t.downScaledWidth:1;t=t.height&&t.downScaledHeight?t.height/t.downScaledHeight:1;for(let o of e)o.x=o.x*s+i,o.y=o.y*t+a;return e}_scanFrame(){!this._active||this.$video.paused||this.$video.ended||("requestVideoFrameCallback"in this.$video?this.$video.requestVideoFrameCallback.bind(this.$video):requestAnimationFrame)(async()=>{if(!(1>=this.$video.readyState)){var e=Date.now()-this._lastScanTimestamp,t=1e3/this._maxScansPerSecond;e<t&&await new Promise(a=>setTimeout(a,t-e)),this._lastScanTimestamp=Date.now();try{var i=await n.scanImage(this.$video,{scanRegion:this._scanRegion,qrEngine:this._qrEnginePromise,canvas:this.$canvas})}catch(a){if(!this._active)return;this._onDecodeError(a)}!n._disableBarcodeDetector||await this._qrEnginePromise instanceof Worker||(this._qrEnginePromise=n.createQrEngine()),i?(this._onDecode?this._onDecode(i):this._legacyOnDecode&&this._legacyOnDecode(i.data),this.$codeOutlineHighlight&&(clearTimeout(this._codeOutlineHighlightRemovalTimeout),this._codeOutlineHighlightRemovalTimeout=void 0,this.$codeOutlineHighlight.setAttribute("viewBox",`${this._scanRegion.x||0} ${this._scanRegion.y||0} ${this._scanRegion.width||this.$video.videoWidth} ${this._scanRegion.height||this.$video.videoHeight}`),this.$codeOutlineHighlight.firstElementChild.setAttribute("points",i.cornerPoints.map(({x:a,y:s})=>`${a},${s}`).join(" ")),this.$codeOutlineHighlight.style.display="")):this.$codeOutlineHighlight&&!this._codeOutlineHighlightRemovalTimeout&&(this._codeOutlineHighlightRemovalTimeout=setTimeout(()=>this.$codeOutlineHighlight.style.display="none",100))}this._scanFrame()})}_onDecodeError(e){e!==n.NO_QR_CODE_FOUND&&console.log(e)}async _getCameraStream(){if(!navigator.mediaDevices)throw"Camera not found.";let e=/^(environment|user)$/.test(this._preferredCamera)?"facingMode":"deviceId",t=[{width:{min:1024}},{width:{min:768}},{}],i=t.map(a=>Object.assign({},a,{[e]:{exact:this._preferredCamera}}));for(let a of[...i,...t])try{let s=await navigator.mediaDevices.getUserMedia({video:a,audio:!1}),o=this._getFacingMode(s)||(a.facingMode?this._preferredCamera:this._preferredCamera==="environment"?"user":"environment");return{stream:s,facingMode:o}}catch{}throw"Camera not found."}async _restartVideoStream(){let e=this._paused;await this.pause(!0)&&!e&&this._active&&await this.start()}static _stopVideoStream(e){for(let t of e.getTracks())t.stop(),e.removeTrack(t)}_setVideoMirror(e){this.$video.style.transform="scaleX("+(e==="user"?-1:1)+")"}_getFacingMode(e){return(e=e.getVideoTracks()[0])?/rear|back|environment/i.test(e.label)?"environment":/front|user|face/i.test(e.label)?"user":null:null}static _drawToCanvas(e,t,i,a=!1){i=i||document.createElement("canvas");let s=t&&t.x?t.x:0,o=t&&t.y?t.y:0,l=t&&t.width?t.width:e.videoWidth||e.width,u=t&&t.height?t.height:e.videoHeight||e.height;return a||(a=t&&t.downScaledWidth?t.downScaledWidth:l,t=t&&t.downScaledHeight?t.downScaledHeight:u,i.width!==a&&(i.width=a),i.height!==t&&(i.height=t)),t=i.getContext("2d",{alpha:!1}),t.imageSmoothingEnabled=!1,t.drawImage(e,s,o,l,u,0,0,i.width,i.height),[i,t]}static async _loadImage(e){if(e instanceof Image)return await n._awaitImageLoad(e),e;if(e instanceof HTMLVideoElement||e instanceof HTMLCanvasElement||e instanceof SVGImageElement||"OffscreenCanvas"in window&&e instanceof OffscreenCanvas||"ImageBitmap"in window&&e instanceof ImageBitmap)return e;if(e instanceof File||e instanceof Blob||e instanceof URL||typeof e=="string"){let t=new Image;t.src=e instanceof File||e instanceof Blob?URL.createObjectURL(e):e.toString();try{return await n._awaitImageLoad(t),t}finally{(e instanceof File||e instanceof Blob)&&URL.revokeObjectURL(t.src)}}else throw"Unsupported image type."}static async _awaitImageLoad(e){e.complete&&e.naturalWidth!==0||await new Promise((t,i)=>{let a=s=>{e.removeEventListener("load",a),e.removeEventListener("error",a),s instanceof ErrorEvent?i("Image load error"):t()};e.addEventListener("load",a),e.addEventListener("error",a)})}static async _postWorkerMessage(e,t,i,a){return n._postWorkerMessageSync(await e,t,i,a)}static _postWorkerMessageSync(e,t,i,a){if(!(e instanceof Worker))return-1;let s=n._workerMessageId++;return e.postMessage({id:s,type:t,data:i},a),s}}n.DEFAULT_CANVAS_SIZE=400;n.NO_QR_CODE_FOUND="No QR code found";n._disableBarcodeDetector=!1;n._workerMessageId=0;const T={data(){return{manualCode:"",qrScanned:!1}},mounted(){this.initQrScanner()},methods:{closeModal(){this.$emit("close")},initQrScanner(){const c=document.getElementById("preview");new n(c,t=>this.onQrScanned(t)).start()},onQrScanned(c){this.qrScanned=!0,this.manualCode=c,this.$emit("qrScanned",c),this.submitCode()},async submitCode(){navigator.geolocation?navigator.geolocation.getCurrentPosition(async c=>{const{latitude:e,longitude:t}=c.coords;try{const i=await M.post(route("merchant.startVisit"),{code:this.manualCode,start_latitude:e,start_longitude:t});console.log("Visit started:",i.data),this.closeModal()}catch(i){console.error("Error starting visit:",i)}},c=>{console.error("Error getting location:",c)}):console.error("Geolocation is not supported by this browser.")}}},E=c=>(b("data-v-56de1619"),c=c(),P(),c),I={class:"fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-10"},V={class:"bg-white rounded-lg shadow-lg overflow-hidden w-11/12 max-w-2xl"},F={class:"p-4 border-b"},H={class:"flex justify-between items-center"},W=E(()=>m("h2",{class:"text-lg font-semibold"},"Escanear Código QR",-1)),j=E(()=>m("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-6 w-6",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},[m("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1)),q=[j],B={class:"p-4"},A={key:0},Q=E(()=>m("video",{id:"preview",class:"w-full"},null,-1)),N=[Q],U={class:"mt-4"},z=E(()=>m("label",{for:"manualCode",class:"block text-gray-700"},"Ingresar Código Manualmente",-1));function G(c,e,t,i,a,s){return O(),$("div",I,[m("div",V,[m("div",F,[m("div",H,[W,m("button",{class:"text-black",onClick:e[0]||(e[0]=(...o)=>s.closeModal&&s.closeModal(...o))},q)])]),m("div",B,[a.qrScanned?D("",!0):(O(),$("div",A,N)),m("div",U,[z,k(m("input",{id:"manualCode",type:"text","onUpdate:modelValue":e[1]||(e[1]=o=>a.manualCode=o),class:"mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm",placeholder:"Ingresa el código manualmente"},null,512),[[x,a.manualCode]]),m("button",{type:"submit",onClick:e[2]||(e[2]=(...o)=>s.submitCode&&s.submitCode(...o)),class:"mt-2 bg-red-ac text-white w-full px-4 py-2 rounded-md hover:bg-red-600 transition font-bold"},"Enviar")])])])])}const Y=L(T,[["render",G],["__scopeId","data-v-56de1619"]]);export{Y as default};
