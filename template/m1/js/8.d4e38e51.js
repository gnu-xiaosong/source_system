(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[8],{8041:function(t,o,a){"use strict";a("cb9a")},"8b24":function(t,o,a){"use strict";a.r(o);var e=function(){var t=this,o=t.$createElement,a=t._self._c||o;return a("div",[a("keep-alive",[t.$route.meta.keepAlive?a("router-view"):t._e()],1),t.$route.meta.keepAlive?t._e():a("router-view"),a("q-footer",{staticClass:"bg-white shadow-2 text-primary",attrs:{reveal:"",elevated:"",bordered:""}},[a("q-tabs",{staticClass:"text-grey",attrs:{"no-caps":"","active-color":"red","indicator-color":"transparent"},model:{value:t.tab,callback:function(o){t.tab=o},expression:"tab"}},[a("q-tab",{attrs:{name:t.foot[0].name,label:t.foot[0].name},on:{click:function(o){return t.go(t.foot[0].to,t.foot[0].name)}}}),a("q-tab",{attrs:{name:t.foot[1].name,label:t.foot[1].name},on:{click:function(o){return t.go(t.foot[1].to,t.foot[1].name)}}}),a("q-tab",{attrs:{name:t.foot[2].name,label:t.foot[2].name},on:{click:function(o){return t.go(t.foot[2].to,t.foot[2].name)}}}),a("q-tab",{attrs:{name:t.foot[3].name,label:t.foot[3].name},on:{click:function(o){return t.go(t.foot[3].to,t.foot[3].name)}}})],1)],1),a("q-page-sticky",{attrs:{position:"bottom-right",offset:t.fabPos}},[a("q-fab",{directives:[{name:"touch-pan",rawName:"v-touch-pan.prevent.mouse",value:t.moveFab,expression:"moveFab",modifiers:{prevent:!0,mouse:!0}}],attrs:{icon:"add",direction:"up",color:"accent",disable:t.draggingFab}},[a("q-fab-action",{attrs:{color:"primary",icon:"brightness_medium",disable:t.draggingFab},on:{click:function(o){return t.changDarkStatus()}}}),a("q-fab-action",{attrs:{color:"primary",icon:"keyboard_arrow_up",disable:t.draggingFab},on:{click:function(o){return t.show()}}})],1)],1)],1)},n=[],i={data:function(){return{foot:[{name:"首页",to:"/"},{name:"发现",to:"community"},{name:"功能",to:"Function"},{name:"个人中心",to:"Person"}],tab:"首页",fabPos:[18,18],draggingFab:!1,right:!1,drawer:!1,leftDrawerOpen:!1,BottomPage:{message:"快捷方式",grid:!0,actions:[{label:"Drive",img:"https://cdn.quasar.dev/img/logo_drive_128px.png",id:"drive"},{label:"Keep",img:"https://cdn.quasar.dev/img/logo_keep_128px.png",id:"keep"},{label:"Google Hangouts",img:"https://cdn.quasar.dev/img/logo_hangouts_128px.png",id:"calendar"},{label:"Calendar",img:"https://cdn.quasar.dev/img/logo_calendar_128px.png",id:"calendar"},{label:"Share",icon:"share",id:"share"},{label:"Upload",icon:"cloud_upload",color:"primary",id:"upload"},{label:"John",avatar:"https://cdn.quasar.dev/img/boy-avatar.png",id:"john"}]}}},methods:{moveFab:function(t){this.draggingFab=!0!==t.isFirst&&!0!==t.isFinal,this.fabPos=[this.fabPos[0]-t.delta.x,this.fabPos[1]-t.delta.y]},changDarkStatus:function(){this.$q.dark.toggle(),this.$q.dark.isActive?this.tip("已切换为暗夜模式"):this.tip("已切换为正常模式")},go:function(t,o){this.tab=o,this.$router.push(t)},tip:function(t){this.$q.notify({message:t,color:"primary",position:"top",timeout:1e3,badgeColor:"primary",badgeTextColor:"dark",badgeClass:"shadow-3 glossy my-badge-class"})},show:function(t){this.$q.bottomSheet({message:this.BottomPage.message,grid:this.BottomPage.grid,actions:this.BottomPage.actions}).onOk((function(t){})).onCancel((function(){})).onDismiss((function(){}))}},beforeRouteLeave:function(t,o,a){this.scrollTop=document.documentElement.scrollTop||document.body.scrollTop,this.$store.commit("app/updateScrollTop",this.scrollTop),a()}},r=i,s=(a("8041"),a("2877")),c=a("7ff0"),l=a("429b"),d=a("7460"),m=a("de5e"),u=a("c294"),g=a("72db"),b=a("75c3"),p=a("eebe"),f=a.n(p),h=Object(s["a"])(r,e,n,!1,null,null,null);o["default"]=h.exports;f()(h,"components",{QFooter:c["a"],QTabs:l["a"],QTab:d["a"],QPageSticky:m["a"],QFab:u["a"],QFabAction:g["a"]}),f()(h,"directives",{TouchPan:b["a"]})},cb9a:function(t,o,a){}}]);