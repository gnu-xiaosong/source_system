(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[7],{"46a1":function(t,e,a){},"4a51":function(t,e,a){"use strict";a.r(e);var o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("q-layout",{attrs:{view:"lhh LpR lff"}},[a("q-header",{staticClass:"bg-primary text-white",attrs:{elevated:"","height-hint":"98"}},[a("q-toolbar",[a("q-btn",{attrs:{dense:"",flat:"",round:"",icon:"menu"},on:{click:function(e){t.leftDrawerOpen=!t.leftDrawerOpen}}}),a("q-toolbar-title",[a("q-avatar",[a("img",{attrs:{src:t.web.web_log}})]),t._v("\n        "+t._s(t.web.web_title)+"\n               \n        ")],1)],1)],1),a("q-drawer",{attrs:{bordered:"",behavior:"mobile"},on:{click:function(e){t.leftDrawerOpen=!1}},model:{value:t.leftDrawerOpen,callback:function(e){t.leftDrawerOpen=e},expression:"leftDrawerOpen"}},[a("q-scroll-area",{staticClass:"fit"},[a("q-toolbar",{staticClass:"GPL__toolbar"},[a("q-toolbar-title",{staticClass:"row items-center text-grey-8"},[a("img",{staticClass:"q-pl-md",attrs:{src:t.web.web_log}})])],1),a("q-list",{attrs:{padding:""}},[t._l(t.links1,(function(e){return a("q-item",{key:e.text,staticClass:"GPL__drawer-item",attrs:{clickable:""}},[a("q-item-section",{attrs:{avatar:""}},[a("q-icon",{attrs:{name:e.icon}})],1),a("q-item-section",{on:{click:function(a){return t.goPage(e.to)}}},[a("q-item-label",[t._v(t._s(e.text))])],1)],1)})),a("q-separator",{staticClass:"q-my-md"})],2)],1)],1),a("q-page-container",[a("keep-alive",[t.$route.meta.keepAlive?a("router-view"):t._e()],1),t.$route.meta.keepAlive?t._e():a("router-view")],1)],1)},n=[],i={data:function(){return{webTitle:"资源网",right:!1,drawer:!1,leftDrawerOpen:!1,search:"",storage:.26,web:{},links1:[{icon:"home",text:"主页",to:"/"},{icon:"arrow_circle_up",text:"资源提交",to:"upSource"},{icon:"pageview",text:"在线查题",to:"QuSearch"},{icon:"find_in_page",text:"站内搜索"},{icon:"account_circle",text:"登陆",to:"Login"},{icon:"payment",text:"注册账户",to:"Register"}],createMenu:[{icon:"photo_album",text:"Album"},{icon:"people",text:"Shared Album"},{icon:"movie",text:"Movie"},{icon:"library_books",text:"Animation"},{icon:"dashboard",text:"Collage"},{icon:"book",text:"Photo book"}]}},methods:{goPage:function(t){this.$router.push(t)},showDialog:function(){this.$q.dialog({title:"网站公告:",message:"欢迎进入"+this.web.web_title,html:!0}).onOk((function(){})).onCancel((function(){})).onDismiss((function(){}))},getWebInformation:function(){var t=this;this.$axios.get("/getWebsiteInformation").then((function(e){t.web=e.data.data,console.log(t.web)})).catch((function(t){console.log(t)}))}},created:function(){this.$store.commit("app/updateScrollTop",0),this.getWebInformation(),this.showDialog()}},r=i,c=(a("cbca"),a("2877")),l=a("4d5a"),s=a("e359"),u=a("65c6"),b=a("9c40"),m=a("6ac5"),p=a("cb32"),w=a("429b"),f=a("7867"),h=a("9404"),g=a("4983"),d=a("1c1c"),_=a("66e5"),q=a("4074"),v=a("0016"),x=a("0170"),Q=a("eb85"),k=a("09e3"),D=a("eebe"),C=a.n(D),O=Object(c["a"])(r,o,n,!1,null,null,null);e["default"]=O.exports;C()(O,"components",{QLayout:l["a"],QHeader:s["a"],QToolbar:u["a"],QBtn:b["a"],QToolbarTitle:m["a"],QAvatar:p["a"],QTabs:w["a"],QRouteTab:f["a"],QDrawer:h["a"],QScrollArea:g["a"],QList:d["a"],QItem:_["a"],QItemSection:q["a"],QIcon:v["a"],QItemLabel:x["a"],QSeparator:Q["a"],QPageContainer:k["a"]})},cbca:function(t,e,a){"use strict";a("46a1")}}]);