(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-0081add9"],{"579c":function(t,e,n){"use strict";n.r(e);var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("show",{attrs:{config:t.config}})],1)},o=[],s=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"word-wrap"},[n("div",{staticClass:"doc_title"},[n("h4",[t._v(t._s(t.title))])]),n("div",{directives:[{name:"show",rawName:"v-show",value:"docx"==t.control,expression:"control == 'docx'"}],staticClass:"docx"},[n("div",{staticClass:"right"}),n("div",{staticClass:"left"}),n("div",{staticClass:"docx_son",attrs:{id:"docx"},domProps:{innerHTML:t._s(t.outputHtml)}})]),n("div",{directives:[{name:"show",rawName:"v-show",value:"excel"==t.control,expression:"control == 'excel'"}],staticClass:"excel",domProps:{innerHTML:t._s(t.outputHtml)}}),n("div",{directives:[{name:"show",rawName:"v-show",value:"pdf"==t.control,expression:"control == 'pdf'"}],staticClass:"pdf"},[n("div",[n("button",{attrs:{type:"button"},on:{click:function(e){return t.changePdfPage(0)}}},[t._v("上一页")]),n("button",{attrs:{type:"button"},on:{click:function(e){return t.changePdfPage(1)}}},[t._v("下一页")]),n("button",{attrs:{type:"button"},on:{click:function(e){return t.scaleD()}}},[t._v("放大")]),n("button",{attrs:{type:"button"},on:{click:function(e){return t.scaleX()}}},[t._v("缩小")]),n("button",{attrs:{type:"button"},on:{click:function(e){return t.clock()}}},[t._v("顺时针")]),n("button",{attrs:{type:"button"},on:{click:function(e){return t.counterClock()}}},[t._v("逆时针")]),n("p",[t._v(t._s(t.pdfOptions.currentPage)+" / "+t._s(t.pdfOptions.pageCount))])]),n("div",{staticStyle:{width:"600px",heigth:"600px","padding-bottom":"20px"}},[n("pdf",{ref:"pdf",staticStyle:{width:"600px",heigth:"600px"},attrs:{src:t.fileURL,page:t.pdfOptions.currentPage,rotate:t.pdfOptions.pageRotate},on:{"num-pages":function(e){t.pdfOptions.pageCount=e},"page-loaded":function(e){t.pdfOptions.currentPage=e},loaded:t.loadPdfHandler}})],1)]),n("div",{directives:[{name:"show",rawName:"v-show",value:"inline"==t.control,expression:"control == 'inline'"}],staticClass:"mcriApi"},[n("iframe",{attrs:{src:t.fileURL,width:"100%",height:"700px"}})])])},a=[],r=n("53ca"),c=(n("34ef"),n("858e")),l=n("c343"),u=n.n(l),f=n("1146"),d=n.n(f),p={props:["config"],components:{pdf:c["a"]},data:function(){return{api:"/doc",data:{},control:"",title:"文件在线阅览",outputHtml:"",fileURL:"",text:"",excelOptions:{id:"excel",editable:"",header:"",footer:""},pdfOptions:{currentPage:0,pageCount:0,scale:100,pageRotate:0}}},created:function(){this.data={mode:"undefined"==typeof this.config.mode?"auto":this.config.mode,requestFileUrl:this.config.requestFileUrl,fileByteContent:"undefined"==typeof this.config.requestFileUrl?"":this.config.requestFileUrl,type:"auto"==this.config.mode?this.config.type:"",excelEditAble:"undefined"!=typeof this.config.excelEditAble&&this.config.excelEditAble,api:"undefined"==typeof this.config.api||0==this.config.api.length?"".concat(this.api):this.config.api},console.log(this.data),"auto"==this.data.mode||""==this.data.mode?this.auto():(this.getMcriOfficeApi(),this.control="inline")},methods:{auto:function(){var t=this,e=this.data.type;console.log(e),"xlsx"==e?(this.getExcelText(),this.$nextTick((function(){t.control="excel"})),console.log(this.control)):"docx"==e?(this.getWordText(),this.$nextTick((function(){t.control="docx"}))):"pdf"==e?(this.fileURL=this.data.requestFileUrl,this.$nextTick((function(){t.control="pdf"}))):(this.getMcriOfficeApi(),this.$nextTick((function(){t.control="inline"})))},getMcriOfficeApi:function(){this.fileURL=this.api+this.data.requestFileUrl},getExcelText:function(){if("undefined"!=typeof this.data.requestFileUrl||0!=this.data.requestFileUrl.length){this.fileURL=this.data.requestFileUrl;var t=new XMLHttpRequest;t.open("get",this.fileURL,!0),t.responseType="arraybuffer";var e=this;t.onload=function(n){console.log(n);var i="";if(200===t.status){for(var o=new Uint8Array(t.response),s=o.byteLength,a=0;a<s;a++)i+=String.fromCharCode(o[a]);var r=d.a.read(i,{type:"binary"}),c=r.SheetNames[0];this.title=c,console.log(c);var l=r.Sheets[c],u=d.a.utils.sheet_to_html(l,e.excelOptions);console.log("HTML:"),e.outputHtml=u,console.log(e.outputHtml)}},t.send()}else{for(var n=new Uint8Array(this.data.fileByteContent),i=n.byteLength,o=0;o<i;o++)binary+=String.fromCharCode(n[o]);var s=d.a.read(binary,{type:"binary"}),a=s.SheetNames[0];this.title=a,console.log(a);var r=s.Sheets[a],c=d.a.utils.sheet_to_html(r,_this.excelOptions);console.log("HTML:"),_this.outputHtml=c,console.log(_this.outputHtml)}},getWordText:function(){var t=this;if("undefined"!=typeof this.data.requestFileUrl||0!=this.data.requestFileUrl.length){var e=new XMLHttpRequest;Object(r["a"])(this.data.f)&&e.open("get",this.data.requestFileUrl,!0),e.responseType="arraybuffer",e.onload=function(){200==e.status&&(u.a.convertToHtml({arrayBuffer:new Uint8Array(e.response)}).then((function(e){t.outputHtml=e.value})),u.a.extractRawText({arrayBuffer:new Uint8Array(e.response)}).then((function(e){t.text=e.value})).done())},e.send()}else u.a.convertToHtml({arrayBuffer:new Uint8Array(this.data.fileByteContent)}).then((function(e){t.outputHtml=e.value})),u.a.extractRawText({arrayBuffer:new Uint8Array(this.data.fileByteContent)}).then((function(e){t.text=e.value})).done()},loadPdfHandler:function(t){this.pdfOptions.currentPage=1},changePdfPage:function(t){0===t&&this.pdfOptions.currentPage>1&&this.pdfOptions.currentPage--,1===t&&this.pdfOptions.currentPage<this.pdfOptions.pageCount&&this.pdfOptions.currentPage++},scaleD:function(){this.pdfOptions.scale+=5,this.$refs.pdf.$el.style.width=parseInt(this.pdfOptions.scale)+"%"},scaleX:function(){100!==this.pdfOptions.scale&&(this.pdfOptions.scale+=-5,this.$refs.pdf.$el.style.width=parseInt(this.pdfOptions.scale)+"%")},clock:function(){this.pdfOptions.pageRotate+=90},counterClock:function(){this.pdfOptions.pageRotate-=90}}},h=p,g=(n("9c18"),n("2877")),v=Object(g["a"])(h,s,a,!1,null,null,null),x=v.exports,y=x,m={components:{show:y},data:function(){return{config:{mode:"auto",requestFileUrl:"",type:"docx",fileByteContent:"",api:"",excelEditAble:!0}}},created:function(){this.config.requestFileUrl=this.$route.query.url,this.config.type=this.$route.query.type}},w=m,b=Object(g["a"])(w,i,o,!1,null,null,null);e["default"]=b.exports},"823f":function(t,e,n){},"9c18":function(t,e,n){"use strict";n("823f")}}]);