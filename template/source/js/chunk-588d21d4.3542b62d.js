(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-588d21d4"],{ace2:function(t,a,s){"use strict";s("ee28")},c6a8:function(t,a,s){"use strict";s.r(a);var e=function(){var t=this,a=t.$createElement,s=t._self._c||a;return s("div",{staticClass:"article"},[s("el-page-header",{attrs:{content:"详情页面"},on:{back:t.goBack}}),s("div",{staticClass:"article_top"},[s("div",{staticClass:"top1"},[s("a-descriptions",{attrs:{title:t.data.title}},[s("a-descriptions-item",{attrs:{label:"作者"}},[t._v(" "+t._s(t.data.author)+" ")]),s("a-descriptions-item",{attrs:{label:"时间"}},[t._v(" "+t._s(t.data.time)+" ")]),s("a-descriptions-item",{attrs:{label:"标签"}},[t._v(" "+t._s(t.data.label)+" ")]),s("a-descriptions-item",{attrs:{label:"分类"}},[t._v(" "+t._s(t.data.category)+" ")]),s("a-descriptions-item",{attrs:{label:"点赞"}},[t._v(" "+t._s(t.data.star)+" ")]),s("a-descriptions-item",{attrs:{label:"阅读"}},[t._v(" "+t._s(t.data.hits)+" ")])],1)],1),s("div",{staticClass:"content"},[t._v(" "+t._s(t.data.content)+" ")])])],1)},i=[],n={data:function(){return{id:0,data:{}}},methods:{goBack:function(){console.log("go back"),window.history.back(-1)},getNewsList:function(){var t=this;this.$axios.get("getNewsDetail",{params:{id:this.id}}).then((function(a){t.data=a.data,console.log(t.data)}))}},mounted:function(){this.id=this.$route.params.id,this.getNewsList(),console.log(this.data)}},o=n,c=(s("ace2"),s("2877")),d=Object(c["a"])(o,e,i,!1,null,null,null);a["default"]=d.exports},ee28:function(t,a,s){}}]);
//# sourceMappingURL=chunk-588d21d4.3542b62d.js.map