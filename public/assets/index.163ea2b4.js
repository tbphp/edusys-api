import{h as x,u as Wt,B as _e,z as fe,ad as zt,v as Je,d as ce,j as Z,b as f,I as ye,k as W,D as R,R as _,n as De,P as Ke,$ as $t,Z as Ft,ah as jt,aR as Ht,Y as dt,aS as we,A as qt,l as Gt,J as Vt,aT as Ut,G as Xe,i as Yt,E as Xt,al as Zt}from"./index.d2a08d1f.js";import{w as Ee,n as ft,t as Jt,c as Qt,i as kt}from"./collapseMotion.95cb8159.js";import{K as ie,E as ea,M as ta,_ as aa,R as bt}from"./index.c27a060a.js";import{D as na}from"./Dropdown.eec030bd.js";import{h as Pt,j as ia,k as ra,l as oa,m as la,n as ua}from"./api.fab3ea2c.js";import{o as ca}from"./button.db5874f5.js";const sa=function(){if(typeof navigator>"u"||typeof window>"u")return!1;var a=navigator.userAgent||navigator.vendor||window.opera;return!!(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw-(n|u)|c55\/|capi|ccwa|cdm-|cell|chtm|cldc|cmd-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc-s|devi|dica|dmob|do(c|p)o|ds(12|-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(-|_)|g1 u|g560|gene|gf-5|g-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd-(m|p|t)|hei-|hi(pt|ta)|hp( i|ip)|hs-c|ht(c(-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i-(20|go|ma)|i230|iac( |-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|-[a-w])|libw|lynx|m1-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|-([1-8]|c))|phil|pire|pl(ay|uc)|pn-2|po(ck|rt|se)|prox|psio|pt-g|qa-a|qc(07|12|21|32|60|-[2-7]|i-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h-|oo|p-)|sdk\/|se(c(-|0|1)|47|mc|nd|ri)|sgh-|shar|sie(-|m)|sk-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h-|v-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl-|tdg-|tel(i|m)|tim-|t-mo|to(pl|sh)|ts(70|m-|m3|m5)|tx-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas-|your|zeto|zte-/i.test(a==null?void 0:a.substr(0,4)))};function mt(a,e){var t=e||{},r=t.defaultValue,n=t.value,i=n===void 0?x():n,l=typeof a=="function"?a():a;i.value!==void 0&&(l=Wt(i)),r!==void 0&&(l=typeof r=="function"?r():r);var u=x(l),o=x(l);_e(function(){var c=i.value!==void 0?i.value:u.value;e.postState&&(c=e.postState(c)),o.value=c});function v(c){var b=o.value;u.value=c,zt(o.value)!==c&&e.onChange&&e.onChange(c,b)}return fe(i,function(){u.value=i.value}),[o,v]}function G(a){var e=typeof a=="function"?a():a,t=x(e);function r(n){t.value=n}return[t,r]}function va(a){var e=x(),t=x(!1);function r(){for(var n=arguments.length,i=new Array(n),l=0;l<n;l++)i[l]=arguments[l];t.value||(Ee.cancel(e.value),e.value=Ee(function(){a.apply(void 0,i)}))}return Je(function(){t.value=!0,Ee.cancel(e.value)}),r}function da(a){var e=x([]),t=x(typeof a=="function"?a():a),r=va(function(){var i=t.value;e.value.forEach(function(l){i=l(i)}),e.value=[],t.value=i});function n(i){e.value.push(i),r()}return[t,n]}const fa=ce({compatConfig:{MODE:3},name:"TabNode",props:{id:{type:String},prefixCls:{type:String},tab:{type:Object},active:{type:Boolean},closable:{type:Boolean},editable:{type:Object},onClick:{type:Function},onResize:{type:Function},renderWrapper:{type:Function},removeAriaLabel:{type:String},onFocus:{type:Function}},emits:["click","resize","remove","focus"],setup:function(e,t){var r=t.expose,n=t.attrs,i=x();function l(v){var c;(c=e.tab)!==null&&c!==void 0&&c.disabled||e.onClick(v)}r({domRef:i});function u(v){var c;v.preventDefault(),v.stopPropagation(),e.editable.onEdit("remove",{key:(c=e.tab)===null||c===void 0?void 0:c.key,event:v})}var o=Z(function(){var v;return e.editable&&e.closable!==!1&&!((v=e.tab)!==null&&v!==void 0&&v.disabled)});return function(){var v,c,b=e.prefixCls,g=e.id,O=e.active,I=e.tab,z=I.key,w=I.tab,j=I.disabled,T=I.closeIcon,d=e.renderWrapper,B=e.removeAriaLabel,H=e.editable,N=e.onFocus,E="".concat(b,"-tab"),L=f("div",{key:z,ref:i,class:ye(E,(v={},W(v,"".concat(E,"-with-remove"),o.value),W(v,"".concat(E,"-active"),O),W(v,"".concat(E,"-disabled"),j),v)),style:n.style,onClick:l},[f("div",{role:"tab","aria-selected":O,id:g&&"".concat(g,"-tab-").concat(z),class:"".concat(E,"-btn"),"aria-controls":g&&"".concat(g,"-panel-").concat(z),"aria-disabled":j,tabindex:j?null:0,onClick:function(D){D.stopPropagation(),l(D)},onKeydown:function(D){[ie.SPACE,ie.ENTER].includes(D.which)&&(D.preventDefault(),l(D))},onFocus:N},[typeof w=="function"?w():w]),o.value&&f("button",{type:"button","aria-label":B||"remove",tabindex:0,class:"".concat(E,"-remove"),onClick:function(D){D.stopPropagation(),u(D)}},[(T==null?void 0:T())||((c=H.removeIcon)===null||c===void 0?void 0:c.call(H))||"\xD7"])]);return d?d(L):L}}});var yt={width:0,height:0,left:0,top:0};function ba(a,e){var t=x(new Map);return _e(function(){for(var r,n=new Map,i=a.value,l=e.value.get((r=i[0])===null||r===void 0?void 0:r.key)||yt,u=l.left+l.width,o=0;o<i.length;o+=1){var v=i[o].key,c=e.value.get(v);if(!c){var b;c=e.value.get((b=i[o-1])===null||b===void 0?void 0:b.key)||yt}var g=n.get(v)||R({},c);g.right=u-g.left-g.width,n.set(v,g)}t.value=new Map(n)}),t}const It=ce({compatConfig:{MODE:3},name:"AddButton",inheritAttrs:!1,props:{prefixCls:String,editable:{type:Object},locale:{type:Object,default:void 0}},setup:function(e,t){var r=t.expose,n=t.attrs,i=x();return r({domRef:i}),function(){var l=e.prefixCls,u=e.editable,o=e.locale;return!u||u.showAdd===!1?null:f("button",{ref:i,type:"button",class:"".concat(l,"-nav-add"),style:n.style,"aria-label":(o==null?void 0:o.addAriaLabel)||"Add tab",onClick:function(c){u.onEdit("add",{event:c})}},[u.addIcon?u.addIcon():"+"])}}});var ma={prefixCls:{type:String},id:{type:String},tabs:{type:Object},rtl:{type:Boolean},tabBarGutter:{type:Number},activeKey:{type:[String,Number]},mobile:{type:Boolean},moreIcon:Ke.any,moreTransitionName:{type:String},editable:{type:Object},locale:{type:Object,default:void 0},removeAriaLabel:String,onTabClick:{type:Function}};const ya=ce({compatConfig:{MODE:3},name:"OperationNode",inheritAttrs:!1,props:ma,emits:["tabClick"],slots:["moreIcon"],setup:function(e,t){var r=t.attrs,n=t.slots,i=G(!1),l=_(i,2),u=l[0],o=l[1],v=G(null),c=_(v,2),b=c[0],g=c[1],O=function(d){for(var B=e.tabs.filter(function(V){return!V.disabled}),H=B.findIndex(function(V){return V.key===b.value})||0,N=B.length,E=0;E<N;E+=1){H=(H+d+N)%N;var L=B[H];if(!L.disabled){g(L.key);return}}},I=function(d){var B=d.which;if(!u.value){[ie.DOWN,ie.SPACE,ie.ENTER].includes(B)&&(o(!0),d.preventDefault());return}switch(B){case ie.UP:O(-1),d.preventDefault();break;case ie.DOWN:O(1),d.preventDefault();break;case ie.ESC:o(!1);break;case ie.SPACE:case ie.ENTER:b.value!==null&&e.onTabClick(b.value,d);break}},z=Z(function(){return"".concat(e.id,"-more-popup")}),w=Z(function(){return b.value!==null?"".concat(z.value,"-").concat(b.value):null}),j=function(d,B){d.preventDefault(),d.stopPropagation(),e.editable.onEdit("remove",{key:B,event:d})};return De(function(){fe(b,function(){var T=document.getElementById(w.value);T&&T.scrollIntoView&&T.scrollIntoView(!1)},{flush:"post",immediate:!0})}),fe(u,function(){u.value||g(null)}),function(){var T,d=e.prefixCls,B=e.id,H=e.tabs,N=e.locale,E=e.mobile,L=e.moreIcon,V=L===void 0?((T=n.moreIcon)===null||T===void 0?void 0:T.call(n))||f(ea,null,null):L,D=e.moreTransitionName,F=e.editable,se=e.tabBarGutter,p=e.rtl,s=e.onTabClick,y="".concat(d,"-dropdown"),C=N==null?void 0:N.dropdownAriaLabel,K=W({},p?"marginRight":"marginLeft",se);H.length||(K.visibility="hidden",K.order=1);var $=ye(W({},"".concat(y,"-rtl"),p)),k=E?null:f(na,{prefixCls:y,trigger:["hover"],visible:u.value,transitionName:D,onVisibleChange:o,overlayClassName:$,mouseEnterDelay:.1,mouseLeaveDelay:.1},{overlay:function(){return f(ta,{onClick:function(A){var U=A.key,re=A.domEvent;s(U,re),o(!1)},id:z.value,tabindex:-1,role:"listbox","aria-activedescendant":w.value,selectedKeys:[b.value],"aria-label":C!==void 0?C:"expanded dropdown"},{default:function(){return[H.map(function(A){var U,re,Se=F&&A.closable!==!1&&!A.disabled;return f(aa,{key:A.key,id:"".concat(z.value,"-").concat(A.key),role:"option","aria-controls":B&&"".concat(B,"-panel-").concat(A.key),disabled:A.disabled},{default:function(){return[f("span",null,[typeof A.tab=="function"?A.tab():A.tab]),Se&&f("button",{type:"button","aria-label":e.removeAriaLabel||"remove",tabindex:0,class:"".concat(y,"-menu-item-remove"),onClick:function(ve){ve.stopPropagation(),j(ve,A.key)}},[((U=A.closeIcon)===null||U===void 0?void 0:U.call(A))||((re=F.removeIcon)===null||re===void 0?void 0:re.call(F))||"\xD7"])]}})})]}})},default:function(){return f("button",{type:"button",class:"".concat(d,"-nav-more"),style:K,tabindex:-1,"aria-hidden":"true","aria-haspopup":"listbox","aria-controls":z.value,id:"".concat(B,"-more"),"aria-expanded":u.value,onKeydown:I},[V])}});return f("div",{class:ye("".concat(d,"-nav-operations"),r.class),style:r.style},[k,f(It,{prefixCls:d,locale:N,editable:F},null)])}}});var wt=Symbol("tabsContextKey"),Et=function(e){$t(wt,e)},_t=function(){return Ft(wt,{tabs:x([]),prefixCls:x()})};ce({compatConfig:{MODE:3},name:"TabsContextProvider",inheritAttrs:!1,props:{tabs:{type:Object,default:void 0},prefixCls:{type:String,default:void 0}},setup:function(e,t){var r=t.slots;return Et(jt(e)),function(){var n;return(n=r.default)===null||n===void 0?void 0:n.call(r)}}});var ha=.1,ht=.01,Ne=20,gt=Math.pow(.995,Ne);function ga(a,e){var t=G(),r=_(t,2),n=r[0],i=r[1],l=G(0),u=_(l,2),o=u[0],v=u[1],c=G(0),b=_(c,2),g=b[0],O=b[1],I=G(),z=_(I,2),w=z[0],j=z[1],T=x();function d(p){var s=p.touches[0],y=s.screenX,C=s.screenY;i({x:y,y:C}),clearInterval(T.value)}function B(p){if(!!n.value){p.preventDefault();var s=p.touches[0],y=s.screenX,C=s.screenY,K=y-n.value.x,$=C-n.value.y;e(K,$),i({x:y,y:C});var k=Date.now();O(k-o.value),v(k),j({x:K,y:$})}}function H(){if(!!n.value){var p=w.value;if(i(null),j(null),p){var s=p.x/g.value,y=p.y/g.value,C=Math.abs(s),K=Math.abs(y);if(Math.max(C,K)<ha)return;var $=s,k=y;T.value=setInterval(function(){if(Math.abs($)<ht&&Math.abs(k)<ht){clearInterval(T.value);return}$*=gt,k*=gt,e($*Ne,k*Ne)},Ne)}}}var N=x();function E(p){var s=p.deltaX,y=p.deltaY,C=0,K=Math.abs(s),$=Math.abs(y);K===$?C=N.value==="x"?s:y:K>$?(C=s,N.value="x"):(C=y,N.value="y"),e(-C,-C)&&p.preventDefault()}var L=x({onTouchStart:d,onTouchMove:B,onTouchEnd:H,onWheel:E});function V(p){L.value.onTouchStart(p)}function D(p){L.value.onTouchMove(p)}function F(p){L.value.onTouchEnd(p)}function se(p){L.value.onWheel(p)}De(function(){var p,s;document.addEventListener("touchmove",D,{passive:!1}),document.addEventListener("touchend",F,{passive:!1}),(p=a.value)===null||p===void 0||p.addEventListener("touchstart",V,{passive:!1}),(s=a.value)===null||s===void 0||s.addEventListener("wheel",se,{passive:!1})}),Je(function(){document.removeEventListener("touchmove",D),document.removeEventListener("touchend",F)})}function pt(a,e){var t=x(a);function r(n){var i=typeof n=="function"?n(t.value):n;i!==t.value&&e(i,t.value),t.value=i}return[t,r]}var pa=function(){var e=x(new Map),t=function(n){return function(i){e.value.set(n,i)}};return Ht(function(){e.value=new Map}),[t,e]};const xa=pa;function Sa(a,e,t,r){if(!ft(a))return a;e=Pt(e,a);for(var n=-1,i=e.length,l=i-1,u=a;u!=null&&++n<i;){var o=ia(e[n]),v=t;if(o==="__proto__"||o==="constructor"||o==="prototype")return a;if(n!=l){var c=u[o];v=r?r(c,o,u):void 0,v===void 0&&(v=ft(c)?c:Jt(e[n+1])?[]:{})}ra(u,o,v),u=u[o]}return a}function Ta(a,e,t){for(var r=-1,n=e.length,i={};++r<n;){var l=e[r],u=oa(a,l);t(u,l)&&Sa(i,Pt(l,a),u)}return i}function Ca(a,e){return Ta(a,e,function(t,r){return la(a,r)})}var ka=ua(function(a,e){return a==null?{}:Ca(a,e)});const Bt=ka;var xt={width:0,height:0,left:0,top:0,right:0},Pa=function(){return{id:{type:String},tabPosition:{type:String},activeKey:{type:[String,Number]},rtl:{type:Boolean},animated:{type:Object,default:void 0},editable:{type:Object},moreIcon:Ke.any,moreTransitionName:{type:String},mobile:{type:Boolean},tabBarGutter:{type:Number},renderTabBar:{type:Function},locale:{type:Object,default:void 0},onTabClick:{type:Function},onTabScroll:{type:Function}}};const St=ce({compatConfig:{MODE:3},name:"TabNavList",inheritAttrs:!1,props:Pa(),slots:["moreIcon","leftExtra","rightExtra","tabBarExtraContent"],emits:["tabClick","tabScroll"],setup:function(e,t){var r=t.attrs,n=t.slots,i=_t(),l=i.tabs,u=i.prefixCls,o=x(),v=x(),c=x(),b=x(),g=xa(),O=_(g,2),I=O[0],z=O[1],w=Z(function(){return e.tabPosition==="top"||e.tabPosition==="bottom"}),j=pt(0,function(h,S){w.value&&e.onTabScroll&&e.onTabScroll({direction:h>S?"left":"right"})}),T=_(j,2),d=T[0],B=T[1],H=pt(0,function(h,S){!w.value&&e.onTabScroll&&e.onTabScroll({direction:h>S?"top":"bottom"})}),N=_(H,2),E=N[0],L=N[1],V=G(0),D=_(V,2),F=D[0],se=D[1],p=G(0),s=_(p,2),y=s[0],C=s[1],K=G(null),$=_(K,2),k=$[0],xe=$[1],he=G(null),A=_(he,2),U=A[0],re=A[1],Se=G(0),ge=_(Se,2),Te=ge[0],ve=ge[1],Be=G(0),Q=_(Be,2),We=Q[0],Re=Q[1],Ae=da(new Map),pe=_(Ae,2),ze=pe[0],$e=pe[1],Me=ba(l,ze),At=Z(function(){return"".concat(u.value,"-nav-operations-hidden")}),Ce=x(0),ke=x(0);_e(function(){w.value?e.rtl?(Ce.value=0,ke.value=Math.max(0,F.value-k.value)):(Ce.value=Math.min(0,k.value-F.value),ke.value=0):(Ce.value=Math.min(0,U.value-y.value),ke.value=0)});var Fe=function(S){return S<Ce.value?Ce.value:S>ke.value?ke.value:S},et=x(),Mt=G(),tt=_(Mt,2),je=tt[0],at=tt[1],He=function(){at(Date.now())},qe=function(){clearTimeout(et.value)},nt=function(S,m){S(function(M){var P=Fe(M+m);return P})};ga(o,function(h,S){if(w.value){if(k.value>=F.value)return!1;nt(B,h)}else{if(U.value>=y.value)return!1;nt(L,S)}return qe(),He(),!0}),fe(je,function(){qe(),je.value&&(et.value=setTimeout(function(){at(0)},100))});var it=function(){var S=arguments.length>0&&arguments[0]!==void 0?arguments[0]:e.activeKey,m=Me.value.get(S)||{width:0,height:0,left:0,right:0,top:0};if(w.value){var M=d.value;e.rtl?m.right<d.value?M=m.right:m.right+m.width>d.value+k.value&&(M=m.right+m.width-k.value):m.left<-d.value?M=-m.left:m.left+m.width>-d.value+k.value&&(M=-(m.left+m.width-k.value)),L(0),B(Fe(M))}else{var P=E.value;m.top<-E.value?P=-m.top:m.top+m.height>-E.value+U.value&&(P=-(m.top+m.height-U.value)),B(0),L(Fe(P))}},Ge=x(0),Ve=x(0);_e(function(){var h,S,m,M,P,Y,X,be=Me.value;["top","bottom"].includes(e.tabPosition)?(S="width",P=k.value,Y=F.value,X=Te.value,m=e.rtl?"right":"left",M=Math.abs(d.value)):(S="height",P=U.value,Y=F.value,X=We.value,m="top",M=-E.value);var ee=P;Y+X>P&&Y<P&&(ee=P-X);var oe=l.value;if(!oe.length){var le;return le=[0,0],Ge.value=le[0],Ve.value=le[1],le}for(var me=oe.length,q=me,te=0;te<me;te+=1){var ae=be.get(oe[te].key)||xt;if(ae[m]+ae[S]>M+ee){q=te-1;break}}for(var ue=0,J=me-1;J>=0;J-=1){var ne=be.get(oe[J].key)||xt;if(ne[m]<M){ue=J+1;break}}return h=[ue,q],Ge.value=h[0],Ve.value=h[1],h});var Ue=function(){var S,m,M,P,Y,X=((S=o.value)===null||S===void 0?void 0:S.offsetWidth)||0,be=((m=o.value)===null||m===void 0?void 0:m.offsetHeight)||0,ee=((M=b.value)===null||M===void 0?void 0:M.$el)||{},oe=ee.offsetWidth||0,le=ee.offsetHeight||0;xe(X),re(be),ve(oe),Re(le);var me=(((P=v.value)===null||P===void 0?void 0:P.offsetWidth)||0)-oe,q=(((Y=v.value)===null||Y===void 0?void 0:Y.offsetHeight)||0)-le;se(me),C(q),$e(function(){var te=new Map;return l.value.forEach(function(ae){var ue=ae.key,J=z.value.get(ue),ne=(J==null?void 0:J.$el)||J;ne&&te.set(ue,{width:ne.offsetWidth,height:ne.offsetHeight,left:ne.offsetLeft,top:ne.offsetTop})}),te})},rt=Z(function(){return[].concat(dt(l.value.slice(0,Ge.value)),dt(l.value.slice(Ve.value+1)))}),Ot=G(),ot=_(Ot,2),Nt=ot[0],Lt=ot[1],de=Z(function(){return Me.value.get(e.activeKey)}),lt=x(),ut=function(){Ee.cancel(lt.value)};fe([de,w,function(){return e.rtl}],function(){var h={};de.value&&(w.value?(e.rtl?h.right=we(de.value.right):h.left=we(de.value.left),h.width=we(de.value.width)):(h.top=we(de.value.top),h.height=we(de.value.height))),ut(),lt.value=Ee(function(){Lt(h)})}),fe([function(){return e.activeKey},de,Me,w],function(){it()},{flush:"post"}),fe([function(){return e.rtl},function(){return e.tabBarGutter},function(){return e.activeKey},function(){return l.value}],function(){Ue()},{flush:"post"});var Ye=function(S){var m=S.position,M=S.prefixCls,P=S.extra;if(!P)return null;var Y=P==null?void 0:P({position:m});return Y?f("div",{class:"".concat(M,"-extra-content")},[Y]):null};return Je(function(){qe(),ut()}),function(){var h,S=e.id,m=e.animated,M=e.activeKey,P=e.rtl,Y=e.editable,X=e.locale,be=e.tabPosition,ee=e.tabBarGutter,oe=e.onTabClick,le=r.class,me=r.style,q=u.value,te=!!rt.value.length,ae="".concat(q,"-nav-wrap"),ue,J,ne,ct;w.value?P?(J=d.value>0,ue=d.value+k.value<F.value):(ue=d.value<0,J=-d.value+k.value<F.value):(ne=E.value<0,ct=-E.value+U.value<y.value);var Oe={};be==="top"||be==="bottom"?Oe[P?"marginRight":"marginLeft"]=typeof ee=="number"?"".concat(ee,"px"):ee:Oe.marginTop=typeof ee=="number"?"".concat(ee,"px"):ee;var st=l.value.map(function(Pe,vt){var Ie=Pe.key;return f(fa,{id:S,prefixCls:q,key:Ie,tab:Pe,style:vt===0?void 0:Oe,closable:Pe.closable,editable:Y,active:Ie===M,removeAriaLabel:X==null?void 0:X.removeAriaLabel,ref:I(Ie),onClick:function(Kt){oe(Ie,Kt)},onFocus:function(){it(Ie),He(),o.value&&(P||(o.value.scrollLeft=0),o.value.scrollTop=0)}},n)});return f("div",{role:"tablist",class:ye("".concat(q,"-nav"),le),style:me,onKeydown:function(){He()}},[f(Ye,{position:"left",prefixCls:q,extra:n.leftExtra},null),f(bt,{onResize:Ue},{default:function(){return[f("div",{class:ye(ae,(h={},W(h,"".concat(ae,"-ping-left"),ue),W(h,"".concat(ae,"-ping-right"),J),W(h,"".concat(ae,"-ping-top"),ne),W(h,"".concat(ae,"-ping-bottom"),ct),h)),ref:o},[f(bt,{onResize:Ue},{default:function(){return[f("div",{ref:v,class:"".concat(q,"-nav-list"),style:{transform:"translate(".concat(d.value,"px, ").concat(E.value,"px)"),transition:je.value?"none":void 0}},[st,f(It,{ref:b,prefixCls:q,locale:X,editable:Y,style:R(R({},st.length===0?void 0:Oe),{},{visibility:te?"hidden":null})},null),f("div",{class:ye("".concat(q,"-ink-bar"),W({},"".concat(q,"-ink-bar-animated"),m.inkBar)),style:Nt.value},null)])]}})])]}}),f(ya,R(R({},e),{},{removeAriaLabel:X==null?void 0:X.removeAriaLabel,ref:c,prefixCls:q,tabs:rt.value,class:!te&&At.value}),Bt(n,["moreIcon"])),f(Ye,{position:"right",prefixCls:q,extra:n.rightExtra},null),f(Ye,{position:"right",prefixCls:q,extra:n.tabBarExtraContent},null)])}}}),Ia=ce({compatConfig:{MODE:3},name:"TabPanelList",inheritAttrs:!1,props:{activeKey:{type:[String,Number]},id:{type:String},rtl:{type:Boolean},animated:{type:Object,default:void 0},tabPosition:{type:String},destroyInactiveTabPane:{type:Boolean}},setup:function(e){var t=_t(),r=t.tabs,n=t.prefixCls;return function(){var i=e.id,l=e.activeKey,u=e.animated,o=e.tabPosition,v=e.rtl,c=e.destroyInactiveTabPane,b=u.tabPane,g=n.value,O=r.value.findIndex(function(I){return I.key===l});return f("div",{class:"".concat(g,"-content-holder")},[f("div",{class:["".concat(g,"-content"),"".concat(g,"-content-").concat(o),W({},"".concat(g,"-content-animated"),b)],style:O&&b?W({},v?"marginRight":"marginLeft","-".concat(O,"00%")):null},[r.value.map(function(I){return Qt(I.node,{key:I.key,prefixCls:g,tabKey:I.key,id:i,animated:b,active:I.key===l,destroyInactiveTabPane:c})})])])}}});var wa={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"defs",attrs:{},children:[{tag:"style",attrs:{}}]},{tag:"path",attrs:{d:"M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"}},{tag:"path",attrs:{d:"M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"}}]},name:"plus",theme:"outlined"};const Ea=wa;function Tt(a){for(var e=1;e<arguments.length;e++){var t=arguments[e]!=null?Object(arguments[e]):{},r=Object.keys(t);typeof Object.getOwnPropertySymbols=="function"&&(r=r.concat(Object.getOwnPropertySymbols(t).filter(function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),r.forEach(function(n){_a(a,n,t[n])})}return a}function _a(a,e,t){return e in a?Object.defineProperty(a,e,{value:t,enumerable:!0,configurable:!0,writable:!0}):a[e]=t,a}var Qe=function(e,t){var r=Tt({},e,t.attrs);return f(qt,Tt({},r,{icon:Ea}),null)};Qe.displayName="PlusOutlined";Qe.inheritAttrs=!1;const Ba=Qe;var Ct=0,Rt=function(){return{prefixCls:{type:String},id:{type:String},activeKey:{type:[String,Number]},defaultActiveKey:{type:[String,Number]},direction:{type:String},animated:{type:[Boolean,Object]},renderTabBar:{type:Function},tabBarGutter:{type:Number},tabBarStyle:{type:Object},tabPosition:{type:String},destroyInactiveTabPane:{type:Boolean},hideAdd:Boolean,type:{type:String},size:{type:String},centered:Boolean,onEdit:{type:Function},onChange:{type:Function},onTabClick:{type:Function},onTabScroll:{type:Function},"onUpdate:activeKey":{type:Function},locale:{type:Object,default:void 0},onPrevClick:Function,onNextClick:Function,tabBarExtraContent:Ke.any}};function Ra(a){return a.map(function(e){if(Vt(e)){for(var t=R({},e.props||{}),r=0,n=Object.entries(t);r<n.length;r++){var i=_(n[r],2),l=i[0],u=i[1];delete t[l],t[Ut(l)]=u}var o=e.children||{},v=e.key!==void 0?e.key:void 0,c=t.tab,b=c===void 0?o.tab:c,g=t.disabled,O=t.forceRender,I=t.closable,z=t.animated,w=t.active,j=t.destroyInactiveTabPane;return R(R({key:v},t),{},{node:e,closeIcon:o.closeIcon,tab:b,disabled:g===""||g,forceRender:O===""||O,closable:I===""||I,animated:z===""||z,active:w===""||w,destroyInactiveTabPane:j===""||j})}return null}).filter(function(e){return e})}var Aa=ce({compatConfig:{MODE:3},name:"InternalTabs",inheritAttrs:!1,props:R(R({},kt(Rt(),{tabPosition:"top",animated:{inkBar:!0,tabPane:!1}})),{},{tabs:{type:Array}}),slots:["tabBarExtraContent","leftExtra","rightExtra","moreIcon","addIcon","removeIcon","renderTabBar"],setup:function(e,t){var r=t.attrs,n=t.slots;Xe(e.onPrevClick===void 0&&e.onNextClick===void 0,"Tabs","`onPrevClick / @prevClick` and `onNextClick / @nextClick` has been removed. Please use `onTabScroll / @tabScroll` instead."),Xe(e.tabBarExtraContent===void 0,"Tabs","`tabBarExtraContent` prop has been removed. Please use `rightExtra` slot instead."),Xe(n.tabBarExtraContent===void 0,"Tabs","`tabBarExtraContent` slot is deprecated. Please use `rightExtra` slot instead.");var i=Yt("tabs",e),l=i.prefixCls,u=i.direction,o=i.size,v=i.rootPrefixCls,c=Z(function(){return u.value==="rtl"}),b=Z(function(){var s=e.animated,y=e.tabPosition;return s===!1||["left","right"].includes(y)?{inkBar:!1,tabPane:!1}:s===!0?{inkBar:!0,tabPane:!0}:R({inkBar:!0,tabPane:!1},Xt(s)==="object"?s:{})}),g=G(!1),O=_(g,2),I=O[0],z=O[1];De(function(){z(sa())});var w=mt(function(){var s;return(s=e.tabs[0])===null||s===void 0?void 0:s.key},{value:Z(function(){return e.activeKey}),defaultValue:e.defaultActiveKey}),j=_(w,2),T=j[0],d=j[1],B=G(function(){return e.tabs.findIndex(function(s){return s.key===T.value})}),H=_(B,2),N=H[0],E=H[1];_e(function(){var s=e.tabs.findIndex(function(C){return C.key===T.value});if(s===-1){var y;s=Math.max(0,Math.min(N.value,e.tabs.length-1)),d((y=e.tabs[s])===null||y===void 0?void 0:y.key)}E(s)});var L=mt(null,{value:Z(function(){return e.id})}),V=_(L,2),D=V[0],F=V[1],se=Z(function(){return I.value&&!["left","right"].includes(e.tabPosition)?"top":e.tabPosition});De(function(){e.id||(F("rc-tabs-".concat(Ct)),Ct+=1)});var p=function(y,C){var K;(K=e.onTabClick)===null||K===void 0||K.call(e,y,C);var $=y!==T.value;if(d(y),$){var k;(k=e.onChange)===null||k===void 0||k.call(e,y)}};return Et({tabs:Z(function(){return e.tabs}),prefixCls:l}),function(){var s,y=e.id,C=e.type,K=e.tabBarGutter,$=e.tabBarStyle,k=e.locale,xe=e.destroyInactiveTabPane,he=e.renderTabBar,A=he===void 0?n.renderTabBar:he,U=e.onTabScroll,re=e.hideAdd,Se=e.centered,ge={id:D.value,activeKey:T.value,animated:b.value,tabPosition:se.value,rtl:c.value,mobile:I.value},Te;C==="editable-card"&&(Te={onEdit:function(Re,Ae){var pe,ze=Ae.key,$e=Ae.event;(pe=e.onEdit)===null||pe===void 0||pe.call(e,Re==="add"?$e:ze,Re)},removeIcon:function(){return f(Zt,null,null)},addIcon:n.addIcon?n.addIcon:function(){return f(Ba,null,null)},showAdd:re!==!0});var ve,Be=R(R({},ge),{},{moreTransitionName:"".concat(v.value,"-slide-up"),editable:Te,locale:k,tabBarGutter:K,onTabClick:p,onTabScroll:U,style:$});A?ve=A(R(R({},Be),{},{DefaultTabBar:St})):ve=f(St,Be,Bt(n,["moreIcon","leftExtra","rightExtra","tabBarExtraContent"]));var Q=l.value;return f("div",R(R({},r),{},{id:y,class:ye(Q,"".concat(Q,"-").concat(se.value),(s={},W(s,"".concat(Q,"-").concat(o.value),o.value),W(s,"".concat(Q,"-card"),["card","editable-card"].includes(C)),W(s,"".concat(Q,"-editable-card"),C==="editable-card"),W(s,"".concat(Q,"-centered"),Se),W(s,"".concat(Q,"-mobile"),I.value),W(s,"".concat(Q,"-editable"),C==="editable-card"),W(s,"".concat(Q,"-rtl"),c.value),s),r.class)}),[ve,f(Ia,R(R({destroyInactiveTabPane:xe},ge),{},{animated:b.value}),null)])}}});const Le=ce({compatConfig:{MODE:3},name:"ATabs",inheritAttrs:!1,props:kt(Rt(),{tabPosition:"top",animated:{inkBar:!0,tabPane:!1}}),slots:["tabBarExtraContent","leftExtra","rightExtra","moreIcon","addIcon","removeIcon","renderTabBar"],setup:function(e,t){var r=t.attrs,n=t.slots,i=t.emit,l=function(o){i("update:activeKey",o),i("change",o)};return function(){var u,o=Ra(Gt((u=n.default)===null||u===void 0?void 0:u.call(n)));return f(Aa,R(R(R({},ca(e,["onUpdate:activeKey"])),r),{},{onChange:l,tabs:o}),n)}}});var Ma=function(){return{tab:Ke.any,disabled:{type:Boolean},forceRender:{type:Boolean},closable:{type:Boolean},animated:{type:Boolean},active:{type:Boolean},destroyInactiveTabPane:{type:Boolean},prefixCls:{type:String},tabKey:{type:[String,Number]},id:{type:String}}};const Ze=ce({compatConfig:{MODE:3},name:"ATabPane",inheritAttrs:!1,__ANT_TAB_PANE:!0,props:Ma(),slots:["closeIcon","tab"],setup:function(e,t){var r=t.attrs,n=t.slots,i=x(e.forceRender);fe([function(){return e.active},function(){return e.destroyInactiveTabPane}],function(){e.active?i.value=!0:e.destroyInactiveTabPane&&(i.value=!1)},{immediate:!0});var l=Z(function(){return e.active?{}:e.animated?{visibility:"hidden",height:0,overflowY:"hidden"}:{display:"none"}});return function(){var u,o=e.prefixCls,v=e.forceRender,c=e.id,b=e.active,g=e.tabKey;return f("div",{id:c&&"".concat(c,"-panel-").concat(g),role:"tabpanel",tabindex:b?0:-1,"aria-labelledby":c&&"".concat(c,"-tab-").concat(g),"aria-hidden":!b,style:[l.value,r.style],class:["".concat(o,"-tabpane"),b&&"".concat(o,"-tabpane-active"),r.class]},[(b||i.value||v)&&((u=n.default)===null||u===void 0?void 0:u.call(n))])}}});Le.TabPane=Ze;Le.install=function(a){return a.component(Le.name,Le),a.component(Ze.name,Ze),a};export{Le as T,Ba as _,G as a,Ze as b,sa as i,mt as u};
