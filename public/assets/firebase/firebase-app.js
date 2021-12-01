!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.firebase=e()}(this,function(){"use strict";!function(t){if(!t.fetch){var e={searchParams:"URLSearchParams"in t,iterable:"Symbol"in t&&"iterator"in Symbol,blob:"FileReader"in t&&"Blob"in t&&function(){try{return new Blob,!0}catch(t){return!1}}(),formData:"FormData"in t,arrayBuffer:"ArrayBuffer"in t};if(e.arrayBuffer)var r=["[object Int8Array]","[object Uint8Array]","[object Uint8ClampedArray]","[object Int16Array]","[object Uint16Array]","[object Int32Array]","[object Uint32Array]","[object Float32Array]","[object Float64Array]"],n=function(t){return t&&DataView.prototype.isPrototypeOf(t)},o=ArrayBuffer.isView||function(t){return t&&r.indexOf(Object.prototype.toString.call(t))>-1};f.prototype.append=function(t,e){t=a(t),e=u(e);var r=this.map[t];this.map[t]=r?r+","+e:e},f.prototype.delete=function(t){delete this.map[a(t)]},f.prototype.get=function(t){return t=a(t),this.has(t)?this.map[t]:null},f.prototype.has=function(t){return this.map.hasOwnProperty(a(t))},f.prototype.set=function(t,e){this.map[a(t)]=u(e)},f.prototype.forEach=function(t,e){for(var r in this.map)this.map.hasOwnProperty(r)&&t.call(e,this.map[r],r,this)},f.prototype.keys=function(){var t=[];return this.forEach(function(e,r){t.push(r)}),c(t)},f.prototype.values=function(){var t=[];return this.forEach(function(e){t.push(e)}),c(t)},f.prototype.entries=function(){var t=[];return this.forEach(function(e,r){t.push([r,e])}),c(t)},e.iterable&&(f.prototype[Symbol.iterator]=f.prototype.entries);var i=["DELETE","GET","HEAD","OPTIONS","POST","PUT"];v.prototype.clone=function(){return new v(this,{body:this._bodyInit})},y.call(v.prototype),y.call(m.prototype),m.prototype.clone=function(){return new m(this._bodyInit,{status:this.status,statusText:this.statusText,headers:new f(this.headers),url:this.url})},m.error=function(){var t=new m(null,{status:0,statusText:""});return t.type="error",t};var s=[301,302,303,307,308];m.redirect=function(t,e){if(-1===s.indexOf(e))throw new RangeError("Invalid status code");return new m(null,{status:e,headers:{location:t}})},t.Headers=f,t.Request=v,t.Response=m,t.fetch=function(t,r){return new Promise(function(n,o){var i=new v(t,r),s=new XMLHttpRequest;s.onload=function(){var t,e,r={status:s.status,statusText:s.statusText,headers:(t=s.getAllResponseHeaders()||"",e=new f,t.replace(/\r?\n[\t ]+/g," ").split(/\r?\n/).forEach(function(t){var r=t.split(":"),n=r.shift().trim();if(n){var o=r.join(":").trim();e.append(n,o)}}),e)};r.url="responseURL"in s?s.responseURL:r.headers.get("X-Request-URL");var o="response"in s?s.response:s.responseText;n(new m(o,r))},s.onerror=function(){o(new TypeError("Network request failed"))},s.ontimeout=function(){o(new TypeError("Network request failed"))},s.open(i.method,i.url,!0),"include"===i.credentials?s.withCredentials=!0:"omit"===i.credentials&&(s.withCredentials=!1),"responseType"in s&&e.blob&&(s.responseType="blob"),i.headers.forEach(function(t,e){s.setRequestHeader(e,t)}),s.send(void 0===i._bodyInit?null:i._bodyInit)})},t.fetch.polyfill=!0}function a(t){if("string"!=typeof t&&(t=String(t)),/[^a-z0-9\-#$%&'*+.\^_`|~]/i.test(t))throw new TypeError("Invalid character in header field name");return t.toLowerCase()}function u(t){return"string"!=typeof t&&(t=String(t)),t}function c(t){var r={next:function(){var e=t.shift();return{done:void 0===e,value:e}}};return e.iterable&&(r[Symbol.iterator]=function(){return r}),r}function f(t){this.map={},t instanceof f?t.forEach(function(t,e){this.append(e,t)},this):Array.isArray(t)?t.forEach(function(t){this.append(t[0],t[1])},this):t&&Object.getOwnPropertyNames(t).forEach(function(e){this.append(e,t[e])},this)}function h(t){if(t.bodyUsed)return Promise.reject(new TypeError("Already read"));t.bodyUsed=!0}function l(t){return new Promise(function(e,r){t.onload=function(){e(t.result)},t.onerror=function(){r(t.error)}})}function p(t){var e=new FileReader,r=l(e);return e.readAsArrayBuffer(t),r}function d(t){if(t.slice)return t.slice(0);var e=new Uint8Array(t.byteLength);return e.set(new Uint8Array(t)),e.buffer}function y(){return this.bodyUsed=!1,this._initBody=function(t){if(this._bodyInit=t,t)if("string"==typeof t)this._bodyText=t;else if(e.blob&&Blob.prototype.isPrototypeOf(t))this._bodyBlob=t;else if(e.formData&&FormData.prototype.isPrototypeOf(t))this._bodyFormData=t;else if(e.searchParams&&URLSearchParams.prototype.isPrototypeOf(t))this._bodyText=t.toString();else if(e.arrayBuffer&&e.blob&&n(t))this._bodyArrayBuffer=d(t.buffer),this._bodyInit=new Blob([this._bodyArrayBuffer]);else{if(!e.arrayBuffer||!ArrayBuffer.prototype.isPrototypeOf(t)&&!o(t))throw new Error("unsupported BodyInit type");this._bodyArrayBuffer=d(t)}else this._bodyText="";this.headers.get("content-type")||("string"==typeof t?this.headers.set("content-type","text/plain;charset=UTF-8"):this._bodyBlob&&this._bodyBlob.type?this.headers.set("content-type",this._bodyBlob.type):e.searchParams&&URLSearchParams.prototype.isPrototypeOf(t)&&this.headers.set("content-type","application/x-www-form-urlencoded;charset=UTF-8"))},e.blob&&(this.blob=function(){var t=h(this);if(t)return t;if(this._bodyBlob)return Promise.resolve(this._bodyBlob);if(this._bodyArrayBuffer)return Promise.resolve(new Blob([this._bodyArrayBuffer]));if(this._bodyFormData)throw new Error("could not read FormData body as blob");return Promise.resolve(new Blob([this._bodyText]))},this.arrayBuffer=function(){return this._bodyArrayBuffer?h(this)||Promise.resolve(this._bodyArrayBuffer):this.blob().then(p)}),this.text=function(){var t,e,r,n=h(this);if(n)return n;if(this._bodyBlob)return t=this._bodyBlob,e=new FileReader,r=l(e),e.readAsText(t),r;if(this._bodyArrayBuffer)return Promise.resolve(function(t){for(var e=new Uint8Array(t),r=new Array(e.length),n=0;n<e.length;n++)r[n]=String.fromCharCode(e[n]);return r.join("")}(this._bodyArrayBuffer));if(this._bodyFormData)throw new Error("could not read FormData body as text");return Promise.resolve(this._bodyText)},e.formData&&(this.formData=function(){return this.text().then(b)}),this.json=function(){return this.text().then(JSON.parse)},this}function v(t,e){var r,n,o=(e=e||{}).body;if(t instanceof v){if(t.bodyUsed)throw new TypeError("Already read");this.url=t.url,this.credentials=t.credentials,e.headers||(this.headers=new f(t.headers)),this.method=t.method,this.mode=t.mode,o||null==t._bodyInit||(o=t._bodyInit,t.bodyUsed=!0)}else this.url=String(t);if(this.credentials=e.credentials||this.credentials||"omit",!e.headers&&this.headers||(this.headers=new f(e.headers)),this.method=(r=e.method||this.method||"GET",n=r.toUpperCase(),i.indexOf(n)>-1?n:r),this.mode=e.mode||this.mode||null,this.referrer=null,("GET"===this.method||"HEAD"===this.method)&&o)throw new TypeError("Body not allowed for GET or HEAD requests");this._initBody(o)}function b(t){var e=new FormData;return t.trim().split("&").forEach(function(t){if(t){var r=t.split("="),n=r.shift().replace(/\+/g," "),o=r.join("=").replace(/\+/g," ");e.append(decodeURIComponent(n),decodeURIComponent(o))}}),e}function m(t,e){e||(e={}),this.type="default",this.status=void 0===e.status?200:e.status,this.ok=this.status>=200&&this.status<300,this.statusText="statusText"in e?e.statusText:"OK",this.headers=new f(e.headers),this.url=e.url||"",this._initBody(t)}}("undefined"!=typeof self?self:void 0);var t=setTimeout;function e(){}function r(t){if(!(this instanceof r))throw new TypeError("Promises must be constructed via new");if("function"!=typeof t)throw new TypeError("not a function");this._state=0,this._handled=!1,this._value=void 0,this._deferreds=[],a(t,this)}function n(t,e){for(;3===t._state;)t=t._value;0!==t._state?(t._handled=!0,r._immediateFn(function(){var r=1===t._state?e.onFulfilled:e.onRejected;if(null!==r){var n;try{n=r(t._value)}catch(t){return void i(e.promise,t)}o(e.promise,n)}else(1===t._state?o:i)(e.promise,t._value)})):t._deferreds.push(e)}function o(t,e){try{if(e===t)throw new TypeError("A promise cannot be resolved with itself.");if(e&&("object"==typeof e||"function"==typeof e)){var n=e.then;if(e instanceof r)return t._state=3,t._value=e,void s(t);if("function"==typeof n)return void a((o=n,u=e,function(){o.apply(u,arguments)}),t)}t._state=1,t._value=e,s(t)}catch(e){i(t,e)}var o,u}function i(t,e){t._state=2,t._value=e,s(t)}function s(t){2===t._state&&0===t._deferreds.length&&r._immediateFn(function(){t._handled||r._unhandledRejectionFn(t._value)});for(var e=0,o=t._deferreds.length;e<o;e++)n(t,t._deferreds[e]);t._deferreds=null}function a(t,e){var r=!1;try{t(function(t){r||(r=!0,o(e,t))},function(t){r||(r=!0,i(e,t))})}catch(t){if(r)return;r=!0,i(e,t)}}r.prototype.catch=function(t){return this.then(null,t)},r.prototype.then=function(t,r){var o=new this.constructor(e);return n(this,new function(t,e,r){this.onFulfilled="function"==typeof t?t:null,this.onRejected="function"==typeof e?e:null,this.promise=r}(t,r,o)),o},r.prototype.finally=function(t){var e=this.constructor;return this.then(function(r){return e.resolve(t()).then(function(){return r})},function(r){return e.resolve(t()).then(function(){return e.reject(r)})})},r.all=function(t){return new r(function(e,r){if(!t||void 0===t.length)throw new TypeError("Promise.all accepts an array");var n=Array.prototype.slice.call(t);if(0===n.length)return e([]);var o=n.length;function i(t,s){try{if(s&&("object"==typeof s||"function"==typeof s)){var a=s.then;if("function"==typeof a)return void a.call(s,function(e){i(t,e)},r)}n[t]=s,0==--o&&e(n)}catch(t){r(t)}}for(var s=0;s<n.length;s++)i(s,n[s])})},r.resolve=function(t){return t&&"object"==typeof t&&t.constructor===r?t:new r(function(e){e(t)})},r.reject=function(t){return new r(function(e,r){r(t)})},r.race=function(t){return new r(function(e,r){for(var n=0,o=t.length;n<o;n++)t[n].then(e,r)})},r._immediateFn="function"==typeof setImmediate&&function(t){setImmediate(t)}||function(e){t(e,0)},r._unhandledRejectionFn=function(t){"undefined"!=typeof console&&console&&console.warn("Possible Unhandled Promise Rejection:",t)};var u=function(){if("undefined"!=typeof self)return self;if("undefined"!=typeof window)return window;if("undefined"!=typeof global)return global;throw new Error("unable to locate global object")}();function c(t,e){return t(e={exports:{}},e.exports),e.exports}u.Promise||(u.Promise=r);var f=c(function(t){var e=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=e)}),h=c(function(t){var e=t.exports={version:"2.5.5"};"number"==typeof __e&&(__e=e)}),l=(h.version,function(t){return"object"==typeof t?null!==t:"function"==typeof t}),p=function(t){if(!l(t))throw TypeError(t+" is not an object!");return t},d=function(t){try{return!!t()}catch(t){return!0}},y=!d(function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a}),v=f.document,b=l(v)&&l(v.createElement),m=function(t){return b?v.createElement(t):{}},_=!y&&!d(function(){return 7!=Object.defineProperty(m("div"),"a",{get:function(){return 7}}).a}),g=function(t,e){if(!l(t))return t;var r,n;if(e&&"function"==typeof(r=t.toString)&&!l(n=r.call(t)))return n;if("function"==typeof(r=t.valueOf)&&!l(n=r.call(t)))return n;if(!e&&"function"==typeof(r=t.toString)&&!l(n=r.call(t)))return n;throw TypeError("Can't convert object to primitive value")},w=Object.defineProperty,O={f:y?Object.defineProperty:function(t,e,r){if(p(t),e=g(e,!0),p(r),_)try{return w(t,e,r)}catch(t){}if("get"in r||"set"in r)throw TypeError("Accessors not supported!");return"value"in r&&(t[e]=r.value),t}},S=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}},E=y?function(t,e,r){return O.f(t,e,S(1,r))}:function(t,e,r){return t[e]=r,t},A={}.hasOwnProperty,j=function(t,e){return A.call(t,e)},P=0,T=Math.random(),k=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++P+T).toString(36))},x=c(function(t){var e=k("src"),r=Function.toString,n=(""+r).split("toString");h.inspectSource=function(t){return r.call(t)},(t.exports=function(t,r,o,i){var s="function"==typeof o;s&&(j(o,"name")||E(o,"name",r)),t[r]!==o&&(s&&(j(o,e)||E(o,e,t[r]?""+t[r]:n.join(String(r)))),t===f?t[r]=o:i?t[r]?t[r]=o:E(t,r,o):(delete t[r],E(t,r,o)))})(Function.prototype,"toString",function(){return"function"==typeof this&&this[e]||r.call(this)})}),F=function(t,e,r){if(function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!")}(t),void 0===e)return t;switch(r){case 1:return function(r){return t.call(e,r)};case 2:return function(r,n){return t.call(e,r,n)};case 3:return function(r,n,o){return t.call(e,r,n,o)}}return function(){return t.apply(e,arguments)}},L=function(t,e,r){var n,o,i,s,a=t&L.F,u=t&L.G,c=t&L.S,l=t&L.P,p=t&L.B,d=u?f:c?f[e]||(f[e]={}):(f[e]||{}).prototype,y=u?h:h[e]||(h[e]={}),v=y.prototype||(y.prototype={});for(n in u&&(r=e),r)i=((o=!a&&d&&void 0!==d[n])?d:r)[n],s=p&&o?F(i,f):l&&"function"==typeof i?F(Function.call,i):i,d&&x(d,n,i,t&L.U),y[n]!=i&&E(y,n,s),l&&v[n]!=i&&(v[n]=i)};f.core=h,L.F=1,L.G=2,L.S=4,L.P=8,L.B=16,L.W=32,L.U=64,L.R=128;var N=L,D={}.toString,I=function(t){return D.call(t).slice(8,-1)},R=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==I(t)?t.split(""):Object(t)},B=function(t){if(void 0==t)throw TypeError("Can't call method on  "+t);return t},C=function(t){return Object(B(t))},U=Math.ceil,M=Math.floor,z=function(t){return isNaN(t=+t)?0:(t>0?M:U)(t)},G=Math.min,W=function(t){return t>0?G(z(t),9007199254740991):0},H=Array.isArray||function(t){return"Array"==I(t)},V=f["__core-js_shared__"]||(f["__core-js_shared__"]={}),q=function(t){return V[t]||(V[t]={})},K=c(function(t){var e=q("wks"),r=f.Symbol,n="function"==typeof r;(t.exports=function(t){return e[t]||(e[t]=n&&r[t]||(n?r:k)("Symbol."+t))}).store=e}),$=K("species"),J=function(t,e){return new(function(t){var e;return H(t)&&("function"!=typeof(e=t.constructor)||e!==Array&&!H(e.prototype)||(e=void 0),l(e)&&null===(e=e[$])&&(e=void 0)),void 0===e?Array:e}(t))(e)},Y=function(t,e){var r=1==t,n=2==t,o=3==t,i=4==t,s=6==t,a=5==t||s,u=e||J;return function(e,c,f){for(var h,l,p=C(e),d=R(p),y=F(c,f,3),v=W(d.length),b=0,m=r?u(e,v):n?u(e,0):void 0;v>b;b++)if((a||b in d)&&(l=y(h=d[b],b,p),t))if(r)m[b]=l;else if(l)switch(t){case 3:return!0;case 5:return h;case 6:return b;case 2:m.push(h)}else if(i)return!1;return s?-1:o||i?i:m}},X=K("unscopables"),Q=Array.prototype;void 0==Q[X]&&E(Q,X,{});var Z=function(t){Q[X][t]=!0},tt=Y(5),et=!0;"find"in[]&&Array(1).find(function(){et=!1}),N(N.P+N.F*et,"Array",{find:function(t){return tt(this,t,arguments.length>1?arguments[1]:void 0)}}),Z("find");h.Array.find;var rt=Y(6),nt=!0;"findIndex"in[]&&Array(1).findIndex(function(){nt=!1}),N(N.P+N.F*nt,"Array",{findIndex:function(t){return rt(this,t,arguments.length>1?arguments[1]:void 0)}}),Z("findIndex");h.Array.findIndex;var ot,it=function(t){return R(B(t))},st=Math.max,at=Math.min,ut=q("keys"),ct=function(t){return ut[t]||(ut[t]=k(t))},ft=(ot=!1,function(t,e,r){var n,o=it(t),i=W(o.length),s=function(t,e){return(t=z(t))<0?st(t+e,0):at(t,e)}(r,i);if(ot&&e!=e){for(;i>s;)if((n=o[s++])!=n)return!0}else for(;i>s;s++)if((ot||s in o)&&o[s]===e)return ot||s||0;return!ot&&-1}),ht=ct("IE_PROTO"),lt=function(t,e){var r,n=it(t),o=0,i=[];for(r in n)r!=ht&&j(n,r)&&i.push(r);for(;e.length>o;)j(n,r=e[o++])&&(~ft(i,r)||i.push(r));return i},pt="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(","),dt=Object.keys||function(t){return lt(t,pt)},yt={f:Object.getOwnPropertySymbols},vt={f:{}.propertyIsEnumerable},bt=Object.assign,mt=!bt||d(function(){var t={},e={},r=Symbol(),n="abcdefghijklmnopqrst";return t[r]=7,n.split("").forEach(function(t){e[t]=t}),7!=bt({},t)[r]||Object.keys(bt({},e)).join("")!=n})?function(t,e){for(var r=C(t),n=arguments.length,o=1,i=yt.f,s=vt.f;n>o;)for(var a,u=R(arguments[o++]),c=i?dt(u).concat(i(u)):dt(u),f=c.length,h=0;f>h;)s.call(u,a=c[h++])&&(r[a]=u[a]);return r}:bt;N(N.S+N.F,"Object",{assign:mt});h.Object.assign;var _t=K("match"),gt=function(t,e,r){if(l(n=e)&&(void 0!==(o=n[_t])?o:"RegExp"==I(n)))throw TypeError("String#"+r+" doesn't accept regex!");var n,o;return String(B(t))},wt=K("match"),Ot="".startsWith;N(N.P+N.F*function(t){var e=/./;try{"/./"[t](e)}catch(r){try{return e[wt]=!1,!"/./"[t](e)}catch(t){}}return!0}("startsWith"),"String",{startsWith:function(t){var e=gt(this,t,"startsWith"),r=W(Math.min(arguments.length>1?arguments[1]:void 0,e.length)),n=String(t);return Ot?Ot.call(e,n,r):e.slice(r,r+n.length)===n}});h.String.startsWith;N(N.P,"String",{repeat:function(t){var e=String(B(this)),r="",n=z(t);if(n<0||n==1/0)throw RangeError("Count can't be negative");for(;n>0;(n>>>=1)&&(e+=e))1&n&&(r+=e);return r}});h.String.repeat;var St=c(function(t){var e=k("meta"),r=O.f,n=0,o=Object.isExtensible||function(){return!0},i=!d(function(){return o(Object.preventExtensions({}))}),s=function(t){r(t,e,{value:{i:"O"+ ++n,w:{}}})},a=t.exports={KEY:e,NEED:!1,fastKey:function(t,r){if(!l(t))return"symbol"==typeof t?t:("string"==typeof t?"S":"P")+t;if(!j(t,e)){if(!o(t))return"F";if(!r)return"E";s(t)}return t[e].i},getWeak:function(t,r){if(!j(t,e)){if(!o(t))return!0;if(!r)return!1;s(t)}return t[e].w},onFreeze:function(t){return i&&a.NEED&&o(t)&&!j(t,e)&&s(t),t}}}),Et=(St.KEY,St.NEED,St.fastKey,St.getWeak,St.onFreeze,O.f),At=K("toStringTag"),jt=function(t,e,r){t&&!j(t=r?t:t.prototype,At)&&Et(t,At,{configurable:!0,value:e})},Pt={f:K},Tt=O.f,kt=function(t){var e=h.Symbol||(h.Symbol=f.Symbol||{});"_"==t.charAt(0)||t in e||Tt(e,t,{value:Pt.f(t)})},xt=y?Object.defineProperties:function(t,e){p(t);for(var r,n=dt(e),o=n.length,i=0;o>i;)O.f(t,r=n[i++],e[r]);return t},Ft=f.document,Lt=Ft&&Ft.documentElement,Nt=ct("IE_PROTO"),Dt=function(){},It=function(){var t,e=m("iframe"),r=pt.length;for(e.style.display="none",Lt.appendChild(e),e.src="javascript:",(t=e.contentWindow.document).open(),t.write("<script>document.F=Object<\/script>"),t.close(),It=t.F;r--;)delete It.prototype[pt[r]];return It()},Rt=Object.create||function(t,e){var r;return null!==t?(Dt.prototype=p(t),r=new Dt,Dt.prototype=null,r[Nt]=t):r=It(),void 0===e?r:xt(r,e)},Bt=pt.concat("length","prototype"),Ct={f:Object.getOwnPropertyNames||function(t){return lt(t,Bt)}},Ut=Ct.f,Mt={}.toString,zt="object"==typeof window&&window&&Object.getOwnPropertyNames?Object.getOwnPropertyNames(window):[],Gt={f:function(t){return zt&&"[object Window]"==Mt.call(t)?function(t){try{return Ut(t)}catch(t){return zt.slice()}}(t):Ut(it(t))}},Wt=Object.getOwnPropertyDescriptor,Ht={f:y?Wt:function(t,e){if(t=it(t),e=g(e,!0),_)try{return Wt(t,e)}catch(t){}if(j(t,e))return S(!vt.f.call(t,e),t[e])}},Vt=St.KEY,qt=Ht.f,Kt=O.f,$t=Gt.f,Jt=f.Symbol,Yt=f.JSON,Xt=Yt&&Yt.stringify,Qt=K("_hidden"),Zt=K("toPrimitive"),te={}.propertyIsEnumerable,ee=q("symbol-registry"),re=q("symbols"),ne=q("op-symbols"),oe=Object.prototype,ie="function"==typeof Jt,se=f.QObject,ae=!se||!se.prototype||!se.prototype.findChild,ue=y&&d(function(){return 7!=Rt(Kt({},"a",{get:function(){return Kt(this,"a",{value:7}).a}})).a})?function(t,e,r){var n=qt(oe,e);n&&delete oe[e],Kt(t,e,r),n&&t!==oe&&Kt(oe,e,n)}:Kt,ce=function(t){var e=re[t]=Rt(Jt.prototype);return e._k=t,e},fe=ie&&"symbol"==typeof Jt.iterator?function(t){return"symbol"==typeof t}:function(t){return t instanceof Jt},he=function(t,e,r){return t===oe&&he(ne,e,r),p(t),e=g(e,!0),p(r),j(re,e)?(r.enumerable?(j(t,Qt)&&t[Qt][e]&&(t[Qt][e]=!1),r=Rt(r,{enumerable:S(0,!1)})):(j(t,Qt)||Kt(t,Qt,S(1,{})),t[Qt][e]=!0),ue(t,e,r)):Kt(t,e,r)},le=function(t,e){p(t);for(var r,n=function(t){var e=dt(t),r=yt.f;if(r)for(var n,o=r(t),i=vt.f,s=0;o.length>s;)i.call(t,n=o[s++])&&e.push(n);return e}(e=it(e)),o=0,i=n.length;i>o;)he(t,r=n[o++],e[r]);return t},pe=function(t){var e=te.call(this,t=g(t,!0));return!(this===oe&&j(re,t)&&!j(ne,t))&&(!(e||!j(this,t)||!j(re,t)||j(this,Qt)&&this[Qt][t])||e)},de=function(t,e){if(t=it(t),e=g(e,!0),t!==oe||!j(re,e)||j(ne,e)){var r=qt(t,e);return!r||!j(re,e)||j(t,Qt)&&t[Qt][e]||(r.enumerable=!0),r}},ye=function(t){for(var e,r=$t(it(t)),n=[],o=0;r.length>o;)j(re,e=r[o++])||e==Qt||e==Vt||n.push(e);return n},ve=function(t){for(var e,r=t===oe,n=$t(r?ne:it(t)),o=[],i=0;n.length>i;)!j(re,e=n[i++])||r&&!j(oe,e)||o.push(re[e]);return o};ie||(x((Jt=function(){if(this instanceof Jt)throw TypeError("Symbol is not a constructor!");var t=k(arguments.length>0?arguments[0]:void 0),e=function(r){this===oe&&e.call(ne,r),j(this,Qt)&&j(this[Qt],t)&&(this[Qt][t]=!1),ue(this,t,S(1,r))};return y&&ae&&ue(oe,t,{configurable:!0,set:e}),ce(t)}).prototype,"toString",function(){return this._k}),Ht.f=de,O.f=he,Ct.f=Gt.f=ye,vt.f=pe,yt.f=ve,y&&x(oe,"propertyIsEnumerable",pe,!0),Pt.f=function(t){return ce(K(t))}),N(N.G+N.W+N.F*!ie,{Symbol:Jt});for(var be="hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables".split(","),me=0;be.length>me;)K(be[me++]);for(var _e=dt(K.store),ge=0;_e.length>ge;)kt(_e[ge++]);N(N.S+N.F*!ie,"Symbol",{for:function(t){return j(ee,t+="")?ee[t]:ee[t]=Jt(t)},keyFor:function(t){if(!fe(t))throw TypeError(t+" is not a symbol!");for(var e in ee)if(ee[e]===t)return e},useSetter:function(){ae=!0},useSimple:function(){ae=!1}}),N(N.S+N.F*!ie,"Object",{create:function(t,e){return void 0===e?Rt(t):le(Rt(t),e)},defineProperty:he,defineProperties:le,getOwnPropertyDescriptor:de,getOwnPropertyNames:ye,getOwnPropertySymbols:ve}),Yt&&N(N.S+N.F*(!ie||d(function(){var t=Jt();return"[null]"!=Xt([t])||"{}"!=Xt({a:t})||"{}"!=Xt(Object(t))})),"JSON",{stringify:function(t){for(var e,r,n=[t],o=1;arguments.length>o;)n.push(arguments[o++]);if(r=e=n[1],(l(e)||void 0!==t)&&!fe(t))return H(e)||(e=function(t,e){if("function"==typeof r&&(e=r.call(this,t,e)),!fe(e))return e}),n[1]=e,Xt.apply(Yt,n)}}),Jt.prototype[Zt]||E(Jt.prototype,Zt,Jt.prototype.valueOf),jt(Jt,"Symbol"),jt(Math,"Math",!0),jt(f.JSON,"JSON",!0);var we=K("toStringTag"),Oe="Arguments"==I(function(){return arguments}()),Se={};Se[K("toStringTag")]="z",Se+""!="[object z]"&&x(Object.prototype,"toString",function(){return"[object "+(void 0===(t=this)?"Undefined":null===t?"Null":"string"==typeof(r=function(t,e){try{return t[e]}catch(t){}}(e=Object(t),we))?r:Oe?I(e):"Object"==(n=I(e))&&"function"==typeof e.callee?"Arguments":n)+"]";var t,e,r,n},!0),kt("asyncIterator"),kt("observable");h.Symbol;var Ee={},Ae={};E(Ae,K("iterator"),function(){return this});var je,Pe=function(t,e,r){t.prototype=Rt(Ae,{next:S(1,r)}),jt(t,e+" Iterator")},Te=ct("IE_PROTO"),ke=Object.prototype,xe=Object.getPrototypeOf||function(t){return t=C(t),j(t,Te)?t[Te]:"function"==typeof t.constructor&&t instanceof t.constructor?t.constructor.prototype:t instanceof Object?ke:null},Fe=K("iterator"),Le=!([].keys&&"next"in[].keys()),Ne=function(){return this},De=function(t,e,r,n,o,i,s){Pe(r,e,n);var a,u,c,f=function(t){if(!Le&&t in d)return d[t];switch(t){case"keys":case"values":return function(){return new r(this,t)}}return function(){return new r(this,t)}},h=e+" Iterator",l="values"==o,p=!1,d=t.prototype,y=d[Fe]||d["@@iterator"]||o&&d[o],v=y||f(o),b=o?l?f("entries"):v:void 0,m="Array"==e&&d.entries||y;if(m&&(c=xe(m.call(new t)))!==Object.prototype&&c.next&&(jt(c,h,!0),"function"!=typeof c[Fe]&&E(c,Fe,Ne)),l&&y&&"values"!==y.name&&(p=!0,v=function(){return y.call(this)}),(Le||p||!d[Fe])&&E(d,Fe,v),Ee[e]=v,Ee[h]=Ne,o)if(a={values:l?v:f("values"),keys:i?v:f("keys"),entries:b},s)for(u in a)u in d||x(d,u,a[u]);else N(N.P+N.F*(Le||p),e,a);return a},Ie=(je=!0,function(t,e){var r,n,o=String(B(t)),i=z(e),s=o.length;return i<0||i>=s?je?"":void 0:(r=o.charCodeAt(i))<55296||r>56319||i+1===s||(n=o.charCodeAt(i+1))<56320||n>57343?je?o.charAt(i):r:je?o.slice(i,i+2):n-56320+(r-55296<<10)+65536});De(String,"String",function(t){this._t=String(t),this._i=0},function(){var t,e=this._t,r=this._i;return r>=e.length?{value:void 0,done:!0}:(t=Ie(e,r),this._i+=t.length,{value:t,done:!1})});var Re=function(t,e){return{value:e,done:!!t}},Be=De(Array,"Array",function(t,e){this._t=it(t),this._i=0,this._k=e},function(){var t=this._t,e=this._k,r=this._i++;return!t||r>=t.length?(this._t=void 0,Re(1)):Re(0,"keys"==e?r:"values"==e?t[r]:[r,t[r]])},"values");Ee.Arguments=Ee.Array,Z("keys"),Z("values"),Z("entries");for(var Ce=K("iterator"),Ue=K("toStringTag"),Me=Ee.Array,ze={CSSRuleList:!0,CSSStyleDeclaration:!1,CSSValueList:!1,ClientRectList:!1,DOMRectList:!1,DOMStringList:!1,DOMTokenList:!0,DataTransferItemList:!1,FileList:!1,HTMLAllCollection:!1,HTMLCollection:!1,HTMLFormElement:!1,HTMLSelectElement:!1,MediaList:!0,MimeTypeArray:!1,NamedNodeMap:!1,NodeList:!0,PaintRequestList:!1,Plugin:!1,PluginArray:!1,SVGLengthList:!1,SVGNumberList:!1,SVGPathSegList:!1,SVGPointList:!1,SVGStringList:!1,SVGTransformList:!1,SourceBufferList:!1,StyleSheetList:!0,TextTrackCueList:!1,TextTrackList:!1,TouchList:!1},Ge=dt(ze),We=0;We<Ge.length;We++){var He,Ve=Ge[We],qe=ze[Ve],Ke=f[Ve],$e=Ke&&Ke.prototype;if($e&&($e[Ce]||E($e,Ce,Me),$e[Ue]||E($e,Ue,Ve),Ee[Ve]=Me,qe))for(He in Be)$e[He]||x($e,He,Be[He],!0)}Pt.f("iterator");var Je=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(t,e){t.__proto__=e}||function(t,e){for(var r in e)e.hasOwnProperty(r)&&(t[r]=e[r])};function Ye(t,e){if(!(e instanceof Object))return e;switch(e.constructor){case Date:return new Date(e.getTime());case Object:void 0===t&&(t={});break;case Array:t=[];break;default:return e}for(var r in e)e.hasOwnProperty(r)&&(t[r]=Ye(t[r],e[r]));return t}function Xe(t,e,r){t[e]=r}var Qe="FirebaseError",Ze=Error.captureStackTrace,tr=function(){return function(t,e){if(this.code=t,this.message=e,Ze)Ze(this,er.prototype.create);else try{throw Error.apply(this,arguments)}catch(t){this.name=Qe,Object.defineProperty(this,"stack",{get:function(){return t.stack}})}}}();tr.prototype=Object.create(Error.prototype),tr.prototype.constructor=tr,tr.prototype.name=Qe;var er=function(){function t(t,e,r){this.service=t,this.serviceName=e,this.errors=r,this.pattern=/\{\$([^}]+)}/g}return t.prototype.create=function(t,e){void 0===e&&(e={});var r,n=this.errors[t],o=this.service+"/"+t;r=void 0===n?"Error":n.replace(this.pattern,function(t,r){var n=e[r];return void 0!==n?n.toString():"<"+r+"?>"}),r=this.serviceName+": "+r+" ("+o+").";var i=new tr(o,r);for(var s in e)e.hasOwnProperty(s)&&"_"!==s.slice(-1)&&(i[s]=e[s]);return i},t}();!function(t){function e(){var e=t.call(this)||this;e.chain_=[],e.buf_=[],e.W_=[],e.pad_=[],e.inbuf_=0,e.total_=0,e.blockSize=64,e.pad_[0]=128;for(var r=1;r<e.blockSize;++r)e.pad_[r]=0;return e.reset(),e}(function(t,e){function r(){this.constructor=t}Je(t,e),t.prototype=null===e?Object.create(e):(r.prototype=e.prototype,new r)})(e,t),e.prototype.reset=function(){this.chain_[0]=1732584193,this.chain_[1]=4023233417,this.chain_[2]=2562383102,this.chain_[3]=271733878,this.chain_[4]=3285377520,this.inbuf_=0,this.total_=0},e.prototype.compress_=function(t,e){e||(e=0);var r=this.W_;if("string"==typeof t)for(var n=0;n<16;n++)r[n]=t.charCodeAt(e)<<24|t.charCodeAt(e+1)<<16|t.charCodeAt(e+2)<<8|t.charCodeAt(e+3),e+=4;else for(n=0;n<16;n++)r[n]=t[e]<<24|t[e+1]<<16|t[e+2]<<8|t[e+3],e+=4;for(n=16;n<80;n++){var o=r[n-3]^r[n-8]^r[n-14]^r[n-16];r[n]=4294967295&(o<<1|o>>>31)}var i,s,a=this.chain_[0],u=this.chain_[1],c=this.chain_[2],f=this.chain_[3],h=this.chain_[4];for(n=0;n<80;n++){n<40?n<20?(i=f^u&(c^f),s=1518500249):(i=u^c^f,s=1859775393):n<60?(i=u&c|f&(u|c),s=2400959708):(i=u^c^f,s=3395469782);o=(a<<5|a>>>27)+i+h+s+r[n]&4294967295;h=f,f=c,c=4294967295&(u<<30|u>>>2),u=a,a=o}this.chain_[0]=this.chain_[0]+a&4294967295,this.chain_[1]=this.chain_[1]+u&4294967295,this.chain_[2]=this.chain_[2]+c&4294967295,this.chain_[3]=this.chain_[3]+f&4294967295,this.chain_[4]=this.chain_[4]+h&4294967295},e.prototype.update=function(t,e){if(null!=t){void 0===e&&(e=t.length);for(var r=e-this.blockSize,n=0,o=this.buf_,i=this.inbuf_;n<e;){if(0==i)for(;n<=r;)this.compress_(t,n),n+=this.blockSize;if("string"==typeof t){for(;n<e;)if(o[i]=t.charCodeAt(n),++n,++i==this.blockSize){this.compress_(o),i=0;break}}else for(;n<e;)if(o[i]=t[n],++n,++i==this.blockSize){this.compress_(o),i=0;break}}this.inbuf_=i,this.total_+=e}},e.prototype.digest=function(){var t=[],e=8*this.total_;this.inbuf_<56?this.update(this.pad_,56-this.inbuf_):this.update(this.pad_,this.blockSize-(this.inbuf_-56));for(var r=this.blockSize-1;r>=56;r--)this.buf_[r]=255&e,e/=256;this.compress_(this.buf_);var n=0;for(r=0;r<5;r++)for(var o=24;o>=0;o-=8)t[n]=this.chain_[r]>>o&255,++n;return t}}(function(){return function(){this.blockSize=-1}}());function rr(t,e){var r=new nr(t,e);return r.subscribe.bind(r)}var nr=function(){function t(t,e){var r=this;this.observers=[],this.unsubscribes=[],this.observerCount=0,this.task=Promise.resolve(),this.finalized=!1,this.onNoObservers=e,this.task.then(function(){t(r)}).catch(function(t){r.error(t)})}return t.prototype.next=function(t){this.forEachObserver(function(e){e.next(t)})},t.prototype.error=function(t){this.forEachObserver(function(e){e.error(t)}),this.close(t)},t.prototype.complete=function(){this.forEachObserver(function(t){t.complete()}),this.close()},t.prototype.subscribe=function(t,e,r){var n,o=this;if(void 0===t&&void 0===e&&void 0===r)throw new Error("Missing Observer.");void 0===(n=function(t,e){if("object"!=typeof t||null===t)return!1;for(var r=0,n=e;r<n.length;r++){var o=n[r];if(o in t&&"function"==typeof t[o])return!0}return!1}(t,["next","error","complete"])?t:{next:t,error:e,complete:r}).next&&(n.next=or),void 0===n.error&&(n.error=or),void 0===n.complete&&(n.complete=or);var i=this.unsubscribeOne.bind(this,this.observers.length);return this.finalized&&this.task.then(function(){try{o.finalError?n.error(o.finalError):n.complete()}catch(t){}}),this.observers.push(n),i},t.prototype.unsubscribeOne=function(t){void 0!==this.observers&&void 0!==this.observers[t]&&(delete this.observers[t],this.observerCount-=1,0===this.observerCount&&void 0!==this.onNoObservers&&this.onNoObservers(this))},t.prototype.forEachObserver=function(t){if(!this.finalized)for(var e=0;e<this.observers.length;e++)this.sendOne(e,t)},t.prototype.sendOne=function(t,e){var r=this;this.task.then(function(){if(void 0!==r.observers&&void 0!==r.observers[t])try{e(r.observers[t])}catch(t){"undefined"!=typeof console&&console.error&&console.error(t)}})},t.prototype.close=function(t){var e=this;this.finalized||(this.finalized=!0,void 0!==t&&(this.finalError=t),this.task.then(function(){e.observers=void 0,e.onNoObservers=void 0}))},t}();function or(){}var ir=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},sr="[DEFAULT]",ar=[],ur=function(){function t(t,e,r){this.firebase_=r,this.isDeleted_=!1,this.services_={},this.name_=e.name,this._automaticDataCollectionEnabled=e.automaticDataCollectionEnabled||!1,this.options_=Ye(void 0,t),this.INTERNAL={getUid:function(){return null},getToken:function(){return Promise.resolve(null)},addAuthTokenListener:function(t){ar.push(t),setTimeout(function(){return t(null)},0)},removeAuthTokenListener:function(t){ar=ar.filter(function(e){return e!==t})}}}return Object.defineProperty(t.prototype,"automaticDataCollectionEnabled",{get:function(){return this.checkDestroyed_(),this._automaticDataCollectionEnabled},set:function(t){this.checkDestroyed_(),this._automaticDataCollectionEnabled=t},enumerable:!0,configurable:!0}),Object.defineProperty(t.prototype,"name",{get:function(){return this.checkDestroyed_(),this.name_},enumerable:!0,configurable:!0}),Object.defineProperty(t.prototype,"options",{get:function(){return this.checkDestroyed_(),this.options_},enumerable:!0,configurable:!0}),t.prototype.delete=function(){var t=this;return new Promise(function(e){t.checkDestroyed_(),e()}).then(function(){t.firebase_.INTERNAL.removeApp(t.name_);var e=[];return Object.keys(t.services_).forEach(function(r){Object.keys(t.services_[r]).forEach(function(n){e.push(t.services_[r][n])})}),Promise.all(e.map(function(t){return t.INTERNAL.delete()}))}).then(function(){t.isDeleted_=!0,t.services_={}})},t.prototype._getService=function(t,e){if(void 0===e&&(e=sr),this.checkDestroyed_(),this.services_[t]||(this.services_[t]={}),!this.services_[t][e]){var r=e!==sr?e:void 0,n=this.firebase_.INTERNAL.factories[t](this,this.extendApp.bind(this),r);this.services_[t][e]=n}return this.services_[t][e]},t.prototype.extendApp=function(t){var e=this;Ye(this,t),t.INTERNAL&&t.INTERNAL.addAuthTokenListener&&(ar.forEach(function(t){e.INTERNAL.addAuthTokenListener(t)}),ar=[])},t.prototype.checkDestroyed_=function(){this.isDeleted_&&cr("app-deleted",{name:this.name_})},t}();function cr(t,e){throw fr.create(t,e)}ur.prototype.name&&ur.prototype.options||ur.prototype.delete||console.log("dc");var fr=new er("app","Firebase",{"no-app":"No Firebase App '{$name}' has been created - call Firebase App.initializeApp()","bad-app-name":"Illegal App name: '{$name}","duplicate-app":"Firebase App named '{$name}' already exists","app-deleted":"Firebase App named '{$name}' already deleted","duplicate-service":"Firebase service named '{$name}' already registered","sa-not-supported":"Initializing the Firebase SDK with a service account is only allowed in a Node.js environment. On client devices, you should instead initialize the SDK with an api key and auth domain","invalid-app-argument":"firebase.{$name}() takes either no argument or a Firebase App instance."});return function t(){var e={},r={},n={},o={__esModule:!0,initializeApp:function(t,r){if(void 0===r&&(r={}),"object"!=typeof r||null===r){var n=r;r={name:n}}var i=r;void 0===i.name&&(i.name=sr);var s=i.name;"string"==typeof s&&s||cr("bad-app-name",{name:s+""}),ir(e,s)&&cr("duplicate-app",{name:s});var u=new ur(t,i,o);return e[s]=u,a(u,"create"),u},app:i,apps:null,Promise:Promise,SDK_VERSION:"5.5.9",INTERNAL:{registerService:function(t,e,a,u,c){r[t]&&cr("duplicate-service",{name:t}),r[t]=e,u&&(n[t]=u,s().forEach(function(t){u("create",t)}));var f=function(e){return void 0===e&&(e=i()),"function"!=typeof e[t]&&cr("invalid-app-argument",{name:t}),e[t]()};return void 0!==a&&Ye(f,a),o[t]=f,ur.prototype[t]=function(){for(var e=[],r=0;r<arguments.length;r++)e[r]=arguments[r];return this._getService.bind(this,t).apply(this,c?e:[])},f},createFirebaseNamespace:t,extendNamespace:function(t){Ye(o,t)},createSubscribe:rr,ErrorFactory:er,removeApp:function(t){a(e[t],"delete"),delete e[t]},factories:r,useAsService:u,Promise:Promise,deepExtend:Ye}};function i(t){return ir(e,t=t||sr)||cr("no-app",{name:t}),e[t]}function s(){return Object.keys(e).map(function(t){return e[t]})}function a(t,e){Object.keys(r).forEach(function(r){var o=u(t,r);null!==o&&n[o]&&n[o](e,t)})}function u(t,e){if("serverAuth"===e)return null;var r=e;return t.options,r}return Xe(o,"default",o),Object.defineProperty(o,"apps",{get:s}),Xe(i,"App",ur),o}()});
//# sourceMappingURL=firebase-app.js.map
