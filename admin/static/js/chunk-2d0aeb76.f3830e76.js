(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0aeb76"],{"0af5":function(t,e,a){"use strict";a.r(e);var l=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"crumbs"},[a("el-breadcrumb",{attrs:{separator:"/"}},[a("el-breadcrumb-item",[a("i",{staticClass:"el-icon-lx-home"}),t._v("系统设置\n      ")]),a("el-breadcrumb-item",[t._v("公众号配置")])],1)],1),a("div",{staticClass:"container"},[a("el-form",{attrs:{"label-position":"left","label-width":"70px"}},[a("el-form-item",{attrs:{label:"接口开关"}},[t._v("\n        始终打开\n        ")]),a("el-form-item",{attrs:{label:"对接URL"}},[t._v("\n        "+t._s(t.api)+"\n      ")]),a("el-form-item",{attrs:{label:"微信对接TOKEN"}},[a("el-input",{model:{value:t.wechat.token,callback:function(e){t.$set(t.wechat,"token",e)},expression:"wechat.token"}})],1),a("el-form-item",{attrs:{label:"关注公众号回复"}},[a("el-input",{attrs:{type:"textarea"},model:{value:t.wechat.subscribe,callback:function(e){t.$set(t.wechat,"subscribe",e)},expression:"wechat.subscribe"}})],1),a("el-form-item",{attrs:{label:"关键词回复"}},t._l(t.wechat.keyword,(function(e,l){return a("div",{key:l},[a("el-col",{attrs:{span:11}},[a("el-input",{model:{value:e.keywords,callback:function(a){t.$set(e,"keywords",a)},expression:"item.keywords"}})],1),a("el-col",{staticClass:"line",attrs:{span:2}},[t._v("-")]),a("el-col",{attrs:{span:11}},[a("el-form-item",{attrs:{label:"回复:"}},[a("el-input",{attrs:{type:"textarea",autosize:""},model:{value:e.reply_word,callback:function(a){t.$set(e,"reply_word",a)},expression:"item.reply_word"}})],1)],1)],1)})),0),a("el-form-item",[a("el-button",{attrs:{type:"primary"},on:{click:function(e){return t.save()}}},[t._v("保存")])],1)],1),a("el-tag",{attrs:{type:"warning"}},[t._v("说明:默认会返回调用数据库中的资源自动回复")])],1)])},o=[],s={data:function(){return{api:"http://域名/public/index.php/wechat",wechat:{}}},methods:{save:function(){var t=this;this.$axios({method:"post",url:"/set_wechat_public",headers:{"content-type":"application/json"},data:this.wechat}).then((function(e){console.log(e.data),t.$message.success(e.data.msg)})).catch((function(t){console.log(t)}))},getData:function(){var t=this;this.$axios.get("/get_wechat_public").then((function(e){console.log(e.data),200==e.data.code&&(console.log(e.data),t.wechat=e.data.data)})).catch((function(t){}))}},mounted:function(){this.api=window.location.protocol+"//"+window.location.host+"/public/index.php/wechat",this.getData()}},n=s,i=a("2877"),c=Object(i["a"])(n,l,o,!1,null,null,null);e["default"]=c.exports}}]);