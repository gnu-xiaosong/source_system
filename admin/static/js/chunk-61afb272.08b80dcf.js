(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-61afb272"],{"6f8c":function(t,e,a){"use strict";a("8fca")},"8fa9":function(t,e,a){"use strict";a.r(e);var i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"aaa"},[a("el-form",{ref:"form",attrs:{model:t.form,"label-width":"auto"}},[a("el-form-item",{attrs:{label:"标题"}},[a("el-input",{staticStyle:{width:"500px"},model:{value:t.article1.title,callback:function(e){t.$set(t.article1,"title",e)},expression:"article1.title"}})],1),a("el-form-item",{attrs:{label:"资源分类"}},[a("el-select",{attrs:{filterable:"",placeholder:"类别选择"},model:{value:t.article1.category,callback:function(e){t.$set(t.article1,"category",e)},expression:"article1.category"}},t._l(t.category,(function(t,e){return a("el-option",{key:e,attrs:{label:t.name,value:t.name}})})),1),t._v("\n\n        自定义类别：\n        "),a("el-input",{staticStyle:{width:"200px"},attrs:{placeholder:"请输入类别名","suffix-icon":"el-icon-plus"},model:{value:t.article1.category,callback:function(e){t.$set(t.article1,"category",e)},expression:"article1.category"}})],1),a("el-form-item",{attrs:{label:"资源标签"}},[a("el-input",{staticStyle:{width:"300px"},model:{value:t.article1.label,callback:function(e){t.$set(t.article1,"label",e)},expression:"article1.label"}})],1),a("el-form-item",{attrs:{label:"下载链接"}},[a("el-input",{staticStyle:{width:"500px"},attrs:{autosize:""},model:{value:t.article1.download_url,callback:function(e){t.$set(t.article1,"download_url",e)},expression:"article1.download_url"}})],1),a("el-form-item",{attrs:{label:"访问密码"}},[a("el-input",{staticStyle:{width:"200px"},attrs:{autosize:""},model:{value:t.article1.passwd,callback:function(e){t.$set(t.article1,"passwd",e)},expression:"article1.passwd"}}),a("el-tag",{attrs:{type:"success"}},[t._v(" 为空默认不需要密码")])],1),a("el-form-item",{attrs:{label:"封面图链接"}},[a("el-input",{staticStyle:{width:"500px"},attrs:{autosize:"",placeholder:"可自定义封面图链接",maxlength:"10"},model:{value:t.article1.image_url,callback:function(e){t.$set(t.article1,"image_url",e)},expression:"article1.image_url"}}),a("el-upload",{staticClass:"upload-demo",attrs:{name:"common",action:"/api/publicUploadFile","on-success":t.success,"list-type":"picture"},scopedSlots:t._u([{key:"tip",fn:function(){return[a("div",{staticClass:"el-upload__tip"},[t._v("\n              只能上传 jpg/png 文件，且不超过 500kb\n            ")])]},proxy:!0}])},[a("el-button",{attrs:{size:"small",type:"primary"}},[t._v("点击上传")])],1)],1),a("el-form-item",{attrs:{label:"描述"}},[a("textarea",{directives:[{name:"model",rawName:"v-model",value:t.article1.description,expression:"article1.description"}],attrs:{name:"",id:"",cols:"60",rows:"5"},domProps:{value:t.article1.description},on:{input:function(e){e.target.composing||t.$set(t.article1,"description",e.target.value)}}})]),a("el-form-item",{attrs:{label:"资源使用介绍"}},[a("quill-editor",{ref:"myTextEditor",attrs:{options:t.editorOption},model:{value:t.article1.use_description,callback:function(e){t.$set(t.article1,"use_description",e)},expression:"article1.use_description"}})],1),a("el-button",{staticClass:"editor-btn",attrs:{type:"primary"},on:{click:function(e){return t.submit(0)}}},[t._v("保存")]),a("el-button",{staticClass:"editor-btn",attrs:{type:"primary"},on:{click:function(e){return t.submit(1)}}},[t._v("上传")])],1)],1)])},l=[],s=a("ade3"),c=(a("a753"),a("8096"),a("14e1"),a("4328")),o=a.n(c),r=a("953d"),n={name:"editor",data:function(){var t;return{content:"",category:[],delivery:!1,editorOption:{placeholder:"Hello World"},article1:(t={title:"",category:"",label:"",download_url:"",description:"",use_description:"",passwd:"",status:1,image_url:""},Object(s["a"])(t,"status",null),Object(s["a"])(t,"user_id","11"),Object(s["a"])(t,"user_name","admin"),t)}},components:{quillEditor:r["quillEditor"]},methods:{getSourceCategory:function(){var t=this;this.$axios.get("/getSourceCategory").then((function(e){t.category=e.data.data,console.log(t.category)}))},getSource:function(){var t=this;this.getSourceCategory(),this.$axios.get("/getSingleSource?id=".concat(this.id)).then((function(e){t.article1=e.data.data,console.log(t.article1)}))},success:function(t,e,a){this.$message.success(t.message),this.article1.image_url=t.data.url,console.log(t),console.log(e),console.log(a)},submit:function(t){var e=this;this.article1.status=t,this.$axios.post("/updateSource",o.a.stringify(this.article1)).then((function(t){200==t.data.code?0==e.article1.status?e.$message.success("保存成功！"):1==e.article1.status?e.$message.success("发布成功！"):e.$message.success("已提交审核成功！"):(e.$message.success("操作失败！"),console.log(t.data))})).catch((function(t){e.$message.success(t),console.log(t)}))}},mounted:function(){this.getSourceCategory(),this.getSource()},created:function(){this.id=this.$route.params.id}},u=n,d=(a("6f8c"),a("2877")),p=Object(d["a"])(u,i,l,!1,null,"9df3fcba",null);e["default"]=p.exports},"8fca":function(t,e,a){},ade3:function(t,e,a){"use strict";function i(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}a.d(e,"a",(function(){return i}))}}]);