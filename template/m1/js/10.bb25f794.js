(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[10],{7292:function(t,a,e){"use strict";e("76da")},"76da":function(t,a,e){},9350:function(t,a,e){"use strict";e.r(a);var s=function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("q-page",[e("div",{staticClass:"person"},[e("q-avatar",{staticClass:"img",attrs:{color:"primary",size:"100px"}},[t.show?e("q-icon",{staticClass:"text-white",attrs:{size:"100px",name:"account_circle"},on:{click:function(a){return t.login()}}}):t._e(),t.show?t._e():e("img",{attrs:{size:"100px",src:t.qq.header}})],1),t.show?e("p",[t._v(" 点击登陆账号"),e("br"),e("h",[t._v("还没有账号吗？点我"),e("a",{attrs:{href:"http://www.xskj.store"}},[t._v("注册")])])],1):t._e(),t.show?t._e():e("p",[t._v("您好！用户 "+t._s(t.qq.name))])],1),e("q-card",{staticClass:"card inset-shadow shadow-up-2",attrs:{horizontal:""}},[e("div",{staticClass:"container"},[e("q-icon",{staticClass:"text-brown-13",attrs:{size:"38px",name:"create"}}),e("q-icon",{staticClass:"text-info",attrs:{size:"38px",name:"arrow_circle_down"}}),e("q-icon",{staticClass:"text-warning",attrs:{size:"38px",name:"backup"}}),e("q-icon",{staticClass:"text-grey-8",attrs:{size:"38px",name:"article"}})],1)]),e("q-card",{staticClass:"listCard",attrs:{horizontal:""}},[e("q-list",{staticClass:"rounded-borders text-primary",attrs:{bordered:""}},t._l(t.set,(function(a){return e("div",[e("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:"","active-class":"my-menu-link"},on:{click:function(e){return t.go(a.to)}}},[e("q-item-section",{attrs:{avatar:""}},[e("q-icon",{attrs:{name:a.icon}})],1),e("q-item-section",[t._v(t._s(a.name))]),"Coin"==a.to?e("div",[t._v(t._s(a.coin))]):t._e()],1),e("q-separator",{attrs:{spaced:""}})],1)})),0)],1)],1)},n=[],i=(e("b0c0"),{data:function(){return{set:[{icon:"create",name:"撰写文章",to:"Write"},{icon:"backup",name:"充值",to:"Voucher"},{icon:"money",name:"当前松币",coin:null,to:"Coin"},{icon:"cloud",name:"修改密码",to:3},{icon:"folder",name:"找回密码",to:4},{icon:"settings",name:"设置",to:5}],show:!1,qq:{name:"",header:""}}},methods:{login:function(){this.$router.push("login")},go:function(t){this.$router.push(t)},getQQ:function(){var t=this;this.$axios.get("/getUserData",{params:{token:this.$q.cookies.get("user_token")}}).then((function(a){200==a.data.code?(t.set[2].coin=a.data.cores,t.getqqdata(a.data.qq),t.getqqname(a.data.qq),console.log(a.data)):t.show=!0})).catch((function(t){console.log(t)}))},getqqname:function(t){var a=this;this.$axios.get("/getQQ",{params:{qq:t,is:""}}).then((function(t){a.qq.name=t.data,console.log(t.data)}))},getqqdata:function(t){var a=this;this.$axios.get("/getQQ",{params:{qq:t}}).then((function(t){a.qq.header=t.data.imgurl,console.log(t.data)}))}},mounted:function(){this.getQQ()}}),o=i,c=(e("7292"),e("2877")),r=e("9989"),l=e("cb32"),u=e("0016"),d=e("f09f"),q=e("1c1c"),m=e("66e5"),p=e("4074"),h=e("eb85"),g=e("714f"),f=e("eebe"),w=e.n(f),v=Object(c["a"])(o,s,n,!1,null,null,null);a["default"]=v.exports;w()(v,"components",{QPage:r["a"],QAvatar:l["a"],QIcon:u["a"],QCard:d["a"],QList:q["a"],QItem:m["a"],QItemSection:p["a"],QSeparator:h["a"]}),w()(v,"directives",{Ripple:g["a"]})}}]);