import{P as U,D as u,d as F,i as G,b as y,H as re,I as E,j as L,G as k,m as le,k as H,E as ie,J as R}from"./index.d2a08d1f.js";import{D as se}from"./Dropdown.eec030bd.js";import{R as de}from"./RightOutlined.882a607c.js";import{i as W,c as M}from"./collapseMotion.95cb8159.js";import{b as ue,B as A,o as pe}from"./button.db5874f5.js";import{E as ve,g as ce}from"./index.c27a060a.js";var z=function(){return{arrow:{type:[Boolean,Object],default:void 0},trigger:{type:[Array,String]},overlay:U.any,visible:{type:Boolean,default:void 0},disabled:{type:Boolean,default:void 0},align:{type:Object},getPopupContainer:Function,prefixCls:String,transitionName:String,placement:String,overlayClassName:String,overlayStyle:{type:Object,default:void 0},forceRender:{type:Boolean,default:void 0},mouseEnterDelay:Number,mouseLeaveDelay:Number,openClassName:String,minOverlayWidthMatchTrigger:{type:Boolean,default:void 0},destroyPopupOnHide:{type:Boolean,default:void 0},onVisibleChange:{type:Function},"onUpdate:visible":{type:Function}}},T=ue(),ye=function(){return u(u({},z()),{},{type:T.type,size:String,htmlType:T.htmlType,href:String,disabled:{type:Boolean,default:void 0},prefixCls:String,icon:U.any,title:String,loading:T.loading,onClick:{type:Function}})},me=["type","disabled","loading","htmlType","class","overlay","trigger","align","visible","onVisibleChange","placement","href","title","icon","mouseEnterDelay","mouseLeaveDelay","overlayClassName","overlayStyle","destroyPopupOnHide","onClick","onUpdate:visible"],fe=A.Group;const ge=F({compatConfig:{MODE:3},name:"ADropdownButton",inheritAttrs:!1,__ANT_BUTTON:!0,props:W(ye(),{trigger:"hover",placement:"bottomRight",type:"default"}),slots:["icon","leftButton","rightButton","overlay"],setup:function(n,m){var a=m.slots,$=m.attrs,P=m.emit,g=function(p){P("update:visible",p),P("visibleChange",p)},i=G("dropdown-button",n),N=i.prefixCls,w=i.direction,O=i.getPopupContainer;return function(){var b,p,e=u(u({},n),$),x=e.type,t=x===void 0?"default":x,o=e.disabled,r=e.loading,f=e.htmlType,s=e.class,d=s===void 0?"":s,l=e.overlay,C=l===void 0?(b=a.overlay)===null||b===void 0?void 0:b.call(a):l,D=e.trigger,v=e.align,c=e.visible;e.onVisibleChange;var h=e.placement,_=h===void 0?w.value==="rtl"?"bottomLeft":"bottomRight":h,S=e.href,Y=e.title,j=e.icon,q=j===void 0?((p=a.icon)===null||p===void 0?void 0:p.call(a))||y(ve,null,null):j,K=e.mouseEnterDelay,Q=e.mouseLeaveDelay,X=e.overlayClassName,Z=e.overlayStyle,ee=e.destroyPopupOnHide,te=e.onClick;e["onUpdate:visible"];var oe=re(e,me),ae={align:v,disabled:o,trigger:o?[]:D,placement:_,getPopupContainer:O.value,onVisibleChange:g,mouseEnterDelay:K,mouseLeaveDelay:Q,visible:c,overlayClassName:X,overlayStyle:Z,destroyPopupOnHide:ee},I=y(A,{type:t,disabled:o,loading:r,onClick:te,htmlType:f,href:S,title:Y},{default:a.default}),V=y(A,{type:t,icon:q},null);return y(fe,u(u({},oe),{},{class:E(N.value,d)}),{default:function(){return[a.leftButton?a.leftButton({button:I}):I,y(be,ae,{default:function(){return[a.rightButton?a.rightButton({button:V}):V]},overlay:function(){return C}})]}})}}});var J=F({compatConfig:{MODE:3},name:"ADropdown",inheritAttrs:!1,props:W(z(),{mouseEnterDelay:.15,mouseLeaveDelay:.1,placement:"bottomLeft",trigger:"hover"}),slots:["overlay"],setup:function(n,m){var a=m.slots,$=m.attrs,P=m.emit,g=G("dropdown",n),i=g.prefixCls,N=g.rootPrefixCls,w=g.direction,O=g.getPopupContainer,b=L(function(){var t=n.placement,o=t===void 0?"":t,r=n.transitionName;return r!==void 0?r:o.indexOf("top")>=0?"".concat(N.value,"-slide-down"):"".concat(N.value,"-slide-up")}),p=function(){var o,r,f,s=n.overlay||((o=a.overlay)===null||o===void 0?void 0:o.call(a)),d=Array.isArray(s)?s[0]:s;if(!d)return null;var l=d.props||{};k(!l.mode||l.mode==="vertical","Dropdown",'mode="'.concat(l.mode,`" is not supported for Dropdown's Menu.`));var C=l.selectable,D=C===void 0?!1:C,v=l.expandIcon,c=v===void 0?(r=d.children)===null||r===void 0||(f=r.expandIcon)===null||f===void 0?void 0:f.call(r):v,h=typeof c<"u"&&R(c)?c:y("span",{class:"".concat(i.value,"-menu-submenu-arrow")},[y(de,{class:"".concat(i.value,"-menu-submenu-arrow-icon")},null)]),_=R(d)?M(d,{mode:"vertical",selectable:D,expandIcon:function(){return h}}):d;return _},e=L(function(){var t=n.placement;if(!t)return w.value==="rtl"?"bottomRight":"bottomLeft";if(t.includes("Center")){var o=t.slice(0,t.indexOf("Center"));return k(!t.includes("Center"),"Dropdown","You are using '".concat(t,"' placement in Dropdown, which is deprecated. Try to use '").concat(o,"' instead.")),o}return t}),x=function(o){P("update:visible",o),P("visibleChange",o)};return function(){var t,o,r=n.arrow,f=n.trigger,s=n.disabled,d=n.overlayClassName,l=(t=a.default)===null||t===void 0?void 0:t.call(a)[0],C=M(l,le({class:E(l==null||(o=l.props)===null||o===void 0?void 0:o.class,H({},"".concat(i.value,"-rtl"),w.value==="rtl"),"".concat(i.value,"-trigger"))},s?{disabled:s}:{})),D=E(d,H({},"".concat(i.value,"-rtl"),w.value==="rtl")),v=s?[]:f,c;v&&v.indexOf("contextmenu")!==-1&&(c=!0);var h=ce({arrowPointAtCenter:ie(r)==="object"&&r.pointAtCenter,autoAdjustOverflow:!0}),_=pe(u(u(u({},n),$),{},{builtinPlacements:h,overlayClassName:D,arrow:r,alignPoint:c,prefixCls:i.value,getPopupContainer:O.value,transitionName:b.value,trigger:v,onVisibleChange:x,placement:e.value}),["overlay","onUpdate:visible"]);return y(se,_,{default:function(){return[C]},overlay:p})}}});J.Button=ge;const be=J;export{be as D,ge as a};