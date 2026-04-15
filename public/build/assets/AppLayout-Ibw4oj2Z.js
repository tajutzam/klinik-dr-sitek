import{r as l,u as j,j as e,L as i}from"./app-5Kcj5oXa.js";/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const h=(...s)=>s.filter((a,r,n)=>!!a&&a.trim()!==""&&n.indexOf(a)===r).join(" ").trim();/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const g=s=>s.replace(/([a-z0-9])([A-Z])/g,"$1-$2").toLowerCase();/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const k=s=>s.replace(/^([A-Z])|[\s-_]+(\w)/g,(a,r,n)=>n?n.toUpperCase():r.toLowerCase());/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const m=s=>{const a=k(s);return a.charAt(0).toUpperCase()+a.slice(1)};/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */var y={xmlns:"http://www.w3.org/2000/svg",width:24,height:24,viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:2,strokeLinecap:"round",strokeLinejoin:"round"};/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const N=s=>{for(const a in s)if(a.startsWith("aria-")||a==="role"||a==="title")return!0;return!1};/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const v=l.forwardRef(({color:s="currentColor",size:a=24,strokeWidth:r=2,absoluteStrokeWidth:n,className:t="",children:o,iconNode:p,...d},u)=>l.createElement("svg",{ref:u,...y,width:a,height:a,stroke:s,strokeWidth:n?Number(r)*24/Number(a):r,className:h("lucide",t),...!o&&!N(d)&&{"aria-hidden":"true"},...d},[...p.map(([f,b])=>l.createElement(f,b)),...Array.isArray(o)?o:[o]]));/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const c=(s,a)=>{const r=l.forwardRef(({className:n,...t},o)=>l.createElement(v,{ref:o,iconNode:a,className:h(`lucide-${g(m(s))}`,`lucide-${s}`,n),...t}));return r.displayName=m(s),r};/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const w=[["path",{d:"m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7",key:"132q7q"}],["rect",{x:"2",y:"4",width:"20",height:"16",rx:"2",key:"izxlao"}]],C=c("mail",w);/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const M=[["path",{d:"M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0",key:"1r0f0z"}],["circle",{cx:"12",cy:"10",r:"3",key:"ilqhr7"}]],A=c("map-pin",M);/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const _=[["path",{d:"M4 5h16",key:"1tepv9"}],["path",{d:"M4 12h16",key:"1lakjw"}],["path",{d:"M4 19h16",key:"1djgab"}]],L=c("menu",_);/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const P=[["path",{d:"M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384",key:"9njp5v"}]],x=c("phone",P);/**
 * @license lucide-react v0.563.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */const $=[["path",{d:"M18 6 6 18",key:"1bl5f8"}],["path",{d:"m6 6 12 12",key:"d8bk6v"}]],S=c("x",$),K=()=>{const[s,a]=l.useState(!1),{url:r}=j(),n=[{label:"Home",href:"/"},{label:"About Us",href:"/about"},{label:"Services",href:"/services"},{label:"Contact",href:"/contact"}];return e.jsxs("nav",{className:"sticky top-0 z-50 bg-background/95 backdrop-blur border-b border-border",children:[e.jsxs("div",{className:"container mx-auto flex items-center justify-between py-4 px-4",children:[e.jsxs("div",{children:[e.jsx("span",{className:"text-lg font-bold text-foreground",children:"Dr. Sitek Ferryanto"}),e.jsx("p",{className:"text-xs text-muted-foreground",children:"General Practitioner"})]}),e.jsx("ul",{className:"hidden md:flex items-center gap-8",children:n.map(t=>{const o=r===t.href;return e.jsx("li",{children:e.jsx(i,{href:t.href,className:`text-sm font-medium transition-colors ${o?"text-slate-950 font-bold":"text-muted-foreground hover:text-slate-900"}`,children:t.label})},t.href)})}),e.jsxs("div",{className:"hidden md:flex items-center gap-4",children:[e.jsxs("a",{href:"tel:+62123456789",className:"flex items-center gap-2 text-sm text-foreground font-medium",children:[e.jsx(x,{className:"w-4 h-4"}),"+62 896-1394-3395"]}),e.jsx(i,{href:"/contact",className:"bg-primary text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-600 transition-colors",children:"Mari Konsultasi"})]}),e.jsx("button",{className:"md:hidden",onClick:()=>a(!s),children:s?e.jsx(S,{className:"w-6 h-6"}):e.jsx(L,{className:"w-6 h-6"})})]}),s&&e.jsxs("div",{className:"md:hidden bg-background border-t border-border px-4 pb-4",children:[n.map(t=>e.jsx(i,{href:t.href,onClick:()=>a(!1),className:`block py-3 text-sm font-medium ${r===t.href?"text-slate-950 font-bold":"text-muted-foreground"}`,children:t.label},t.href)),e.jsx(i,{href:"/contact",onClick:()=>a(!1),className:"mt-2 block text-center bg-primary text-white px-5 py-2.5 rounded-lg text-sm font-semibold",children:"Mari Konsultasi"})]})]})},H=()=>e.jsxs("footer",{id:"contact",className:"bg-[#eff4f8] text-foreground",children:[e.jsx("div",{className:"container mx-auto px-4 py-14",children:e.jsxs("div",{className:"grid sm:grid-cols-2 lg:grid-cols-4 gap-8",children:[e.jsxs("div",{children:[e.jsx("h3",{className:"font-bold text-lg mb-3",children:"Dr. Sitek Ferryanto"}),e.jsx("p",{className:"text-sm opacity-70 leading-relaxed mb-4",children:"Dokter umum dengan pengalaman lebih dari 22 tahun memberikan pelayanan kesehatan yang ramah, terjangkau, dan profesional."}),e.jsx("p",{className:"text-sm font-semibold",children:"Follow Us"})]}),e.jsxs("div",{children:[e.jsx("h4",{className:"font-bold mb-3",children:"Quick Links"}),e.jsx("ul",{className:"space-y-2 text-sm opacity-70",children:["Home","About Us","Services","Contact"].map(s=>e.jsx("li",{children:e.jsx("a",{href:`#${s.toLowerCase().replace(" ","")}`,className:"hover:opacity-100 transition-opacity",children:s})},s))})]}),e.jsxs("div",{children:[e.jsx("h4",{className:"font-bold mb-3",children:"Our Services"}),e.jsx("ul",{className:"space-y-2 text-sm opacity-70",children:["General Consultation","Medical Check-up","Child Healthcare","Senior Care","Prescription Medicine"].map(s=>e.jsx("li",{children:s},s))})]}),e.jsxs("div",{children:[e.jsx("h4",{className:"font-bold mb-3",children:"Contact Us"}),e.jsxs("ul",{className:"space-y-3 text-sm opacity-70",children:[e.jsxs("li",{className:"flex items-start gap-2",children:[e.jsx(A,{className:"w-4 h-4 flex-shrink-0 mt-0.5"}),"3FJH+5WR, Jl. Kapitan Juhoi, Kapuas Kanan Hulu, Kec. Sintang, Kabupaten Sintang, Kalimantan Barat 78613"]}),e.jsxs("li",{className:"flex items-center gap-2",children:[e.jsx(x,{className:"w-4 h-4 flex-shrink-0"}),"+62 896-1394-3395"]}),e.jsxs("li",{className:"flex items-center gap-2",children:[e.jsx(C,{className:"w-4 h-4 flex-shrink-0"}),"praktekdrsitekferryanto@gmail.com"]})]})]})]})}),e.jsx("div",{className:"border-t border-background/10",children:e.jsxs("div",{className:"container mx-auto px-4 py-4 flex flex-wrap justify-between text-xs opacity-50",children:[e.jsx("span",{children:"© 2026 HealthCare Plus. All rights reserved."}),e.jsx("span",{children:"Privacy Policy · Terms of Service"})]})})]});function E({children:s}){return e.jsxs("div",{className:"min-h-screen bg-background",children:[e.jsx(K,{}),e.jsx("main",{children:s}),e.jsx(H,{})]})}export{E as M,x as P,A as a,C as b,c};
