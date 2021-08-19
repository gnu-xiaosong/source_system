(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-609f0cd5"],{a853:function(e,t,a){"use strict";a.r(t);var l=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"doc"},[a("el-dialog",{attrs:{title:"文档上传",visible:e.dialogFormVisible},on:{"update:visible":function(t){e.dialogFormVisible=t}}},[a("div",[a("el-form",{ref:"upload",attrs:{"label-width":"auto"}},[a("el-form-item",{attrs:{label:"文档描述"}},[a("textarea",{directives:[{name:"model",rawName:"v-model",value:e.upload.description,expression:"upload.description"}],staticStyle:{resize:"none"},attrs:{cols:"60",rows:"5"},domProps:{value:e.upload.description},on:{input:function(t){t.target.composing||e.$set(e.upload,"description",t.target.value)}}})]),a("el-form-item",{attrs:{label:"文档标签"}},[a("el-input",{staticStyle:{width:"300px"},model:{value:e.upload.label,callback:function(t){e.$set(e.upload,"label",t)},expression:"upload.label"}})],1),a("el-form-item",{attrs:{label:"下载密码"}},[a("el-input",{staticStyle:{width:"300px"},model:{value:e.upload.passwd,callback:function(t){e.$set(e.upload,"passwd",t)},expression:"upload.passwd"}})],1),a("el-form-item",{attrs:{label:"分类"}},[a("el-select",{attrs:{filterable:"",placeholder:"类别选择"},model:{value:e.upload.classify,callback:function(t){e.$set(e.upload,"classify",t)},expression:"upload.classify"}},e._l(e.category,(function(e,t){return a("el-option",{key:t,attrs:{label:e.name,value:e.name}})})),1),e._v("\n\n          自定义类别：\n          "),a("el-input",{staticStyle:{width:"200px"},attrs:{placeholder:"请输入类别名","suffix-icon":"el-icon-plus"},model:{value:e.upload.classify,callback:function(t){e.$set(e.upload,"classify",t)},expression:"upload.classify"}})],1),a("el-upload",{staticClass:"upload-demo",attrs:{drag:"",name:"file","show-file-list":"","on-success":e.success,multiple:"",data:e.upload,"on-error":e.error,"before-upload":e.beforeUpload,accept:".doc,.docx,.xlsx, .xls, .ppt, .pdf,.txt,.csv,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document",action:"/api/fileSubmit"},scopedSlots:e._u([{key:"tip",fn:function(){return[a("div",{staticClass:"el-upload__tip"},[e._v("\n              支持多文件上传"),a("em",{staticStyle:{color:"#21a366"}},[e._v("\n                支持png,bmp,jpg,jpeg,gif格式")])])]},proxy:!0}])},[a("i",{staticClass:"el-icon-upload"}),a("div",{staticClass:"el-upload__text"},[e._v("\n            将文件拖到此处，或"),a("em",[e._v("点击上传")])])])],1)],1),a("div",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[a("el-button",{on:{click:function(t){e.dialogFormVisible=!1}}},[e._v("取 消")])],1)]),a("div",{staticClass:"lib"},[a("div",{staticClass:"handle-box"},[a("el-button",{staticClass:"handle-del mr10",attrs:{type:"danger",icon:"el-icon-delete"},on:{click:e.delAllSelection}},[e._v("批量删除")]),a("el-select",{staticClass:"handle-select mr10",staticStyle:{"margin-left":"10px"},attrs:{placeholder:"文档类别"},model:{value:e.search.category,callback:function(t){e.$set(e.search,"category",t)},expression:"search.category"}},[a("el-option",{key:"100",attrs:{label:"全部",value:"全部"}}),e._l(e.category,(function(e,t){return a("el-option",{key:t,attrs:{label:e.name,value:e.name}})}))],2),a("el-button",{staticStyle:{"margin-left":"30px"},attrs:{type:"primary",icon:"el-icon-search"},on:{click:e.handleSearch}},[e._v("搜索")]),e._v("\n      每页数量\n      "),a("el-input-number",{attrs:{step:1,"step-strictly":""},model:{value:e.query.pageSize,callback:function(t){e.$set(e.query,"pageSize",t)},expression:"query.pageSize"}}),a("el-button",{staticStyle:{"margin-left":"30px"},attrs:{type:"success",icon:"el-icon-upload"},on:{click:function(t){return e.upload2()}}},[e._v("上传文档")]),a("el-button",{staticStyle:{"margin-left":"30px"},attrs:{type:"warning",icon:"el-icon-download"},on:{click:function(t){return e.generate()}}},[e._v("导出EXCEL")])],1),a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.tableData,id:"excel4"},on:{"selection-change":e.handleSelectionChange}},[a("el-table-column",{attrs:{type:"selection",width:"55"}}),a("el-table-column",{attrs:{label:"日期",width:"160",prop:"time"}}),a("el-table-column",{attrs:{label:"分类",width:"110"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-select",{attrs:{placeholder:"分类选择"},model:{value:t.row.classify,callback:function(a){e.$set(t.row,"classify",a)},expression:"scope.row.classify"}},e._l(e.category,(function(e){return a("el-option",{key:e.value,attrs:{label:e.name,value:e.name}})})),1)]}}])}),a("el-table-column",{attrs:{label:"文档链接",width:"180",prop:"file_path"}}),a("el-table-column",{attrs:{label:"文档大小(单位kb)",width:"130",prop:"file_size"}}),a("el-table-column",{attrs:{label:"访问密码",width:"90"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-input",{attrs:{placeholder:"无密码"},model:{value:t.row.passwd,callback:function(a){e.$set(t.row,"passwd",a)},expression:"scope.row.passwd"}})]}}])}),a("el-table-column",{attrs:{label:"文档类型",width:"80"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("div",{staticClass:"name-wrapper",attrs:{slot:"reference"},slot:"reference"},[a("el-tag",{attrs:{size:"medium",type:"warning"}},[e._v(e._s(t.row.file_type))])],1)]}}])}),a("el-table-column",{attrs:{label:"标签",width:"100"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("div",{staticClass:"name-wrapper",attrs:{slot:"reference"},slot:"reference"},[a("el-input",{attrs:{placeholder:"用户自定义标签"},model:{value:t.row.user_defined_label,callback:function(a){e.$set(t.row,"user_defined_label",a)},expression:"scope.row.user_defined_label"}})],1)]}}])}),a("el-table-column",{attrs:{label:"当前状态",width:"100"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("div",{staticClass:"name-wrapper",attrs:{slot:"reference"},slot:"reference"},[a("el-select",{attrs:{placeholder:"请选择"},model:{value:t.row.status,callback:function(a){e.$set(t.row,"status",a)},expression:"scope.row.status"}},e._l(["正常","禁用"],(function(e){return a("el-option",{key:e,attrs:{label:e,value:"正常"==e?1:0}})})),1)],1)]}}])}),a("el-table-column",{attrs:{label:"操作",width:"300"},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-button",{attrs:{size:"mini",type:"success"},on:{click:function(a){return e.read(t.row)}}},[e._v("阅览")]),a("el-button",{attrs:{size:"mini",type:"success"},on:{click:function(a){return e.modifaction(t.row)}}},[e._v("修改")]),a("el-button",{attrs:{size:"mini",type:"success"},on:{click:function(a){return e.downloadDoc(t.row.file_path)}}},[e._v("下载")]),a("el-button",{attrs:{size:"mini",type:"danger"},on:{click:function(a){return e.handleDelete(t.$index,t.row)}}},[e._v("删除")])]}}])})],1),a("div",{staticClass:"page"},[a("el-pagination",{attrs:{"current-page":e.query.pageIndex,"page-sizes":[10,50,100,200],"page-size":e.query.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:e.query.count},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}})],1)],1)],1)},o=[],n=(a("6b54"),a("87b3"),a("386d"),a("4328")),s=a.n(n),i={data:function(){return{dialogFormVisible:!1,search:{category:"全部",question:null},upload:{description:"",label:"",classify:"",user:"admin",doc_id:0,passwd:""},tableData:[],query:{pageIndex:1,pageSize:10,count:100},category:[],multipleSelection:[]}},methods:{modifaction:function(e){var t=this;this.$axios.post("/setDocSingle",s.a.stringify(e)).then((function(e){console.log(e.data),t.$message({message:e.data.msg,type:"success"}),t.getdocList()})),console.log(e)},read:function(e){this.$router.push({path:"/DocShow",query:{url:e.file_path,type:e.file_type}})},upload2:function(){this.dialogFormVisible=!0},getdocList:function(){var e=this;this.$axios.get("/getDocList",{params:{page:this.query.pageIndex,eachPageNum:this.query.pageSize}}).then((function(t){e.tableData=t.data.data,console.log(e.tableData)})).catch((function(e){console.log(e)}))},getSearchData:function(){var e=this;this.$axios.get("/getSearchDoc",{params:{category:this.search.category,page:this.query.pageIndex,eachPageNum:this.query.pageSize}}).then((function(t){e.tableData=t.data.data,console.log(t.data)})).catch((function(e){console.log(e)}))},handleSearch:function(){this.getSearchData()},getdocCategory:function(){var e=this;this.$axios.get("/getDocCategory").then((function(t){e.category=t.data.category,console.log("there"),e.query.count=t.data.total,console.log(e.category)})).catch((function(e){console.log(e)}))},handleDelete:function(e,t){var a=this;console.log(e),console.log(t),this.$confirm("确定要删除吗？","提示",{type:"warning"}).then((function(){var l=[t.id];a.delSingleSelection(l),a.tableData.splice(e,1)})).catch((function(){}))},handleSelectionChange:function(e){this.multipleSelection=e},generate:function(){var e=new Date;this.$htmlToExcel.getExcel("#excel4",e.getFullYear().toString()+e.getMonth().toString()+e.getDate().toString()+e.getDay().toString()+e.getHours().toString()+e.getMinutes().toString()+e.getSeconds().toString())},delSingleSelection:function(e){var t=this;console.log(e),this.$axios({method:"post",url:"/delDoc",headers:{"content-type":"application/json"},data:e}).then((function(e){console.log(e.data),t.$message.error(e.data.msg),t.getData()})).catch((function(e){console.log(e)}))},getTime:function(){var e=new Date,t="-",a=e.getFullYear(),l=e.getMonth()+1,o=e.getDate();l>=1&&l<=9&&(l="0"+l),o>=0&&o<=9&&(o="0"+o);var n=a+t+l+t+o;return n},downloadDoc:function(e){var t=new XMLHttpRequest;t.open("get",e,!0),t.responseType="arraybuffer",t.send()},success:function(e,t,a){200==e.code?(this.$message({message:"上传成功！",type:"success"}),this.getdocList()):this.$message.error("服务器程序异常！"),console.log(t),console.log(a)},error:function(e,t,a){this.$message.error(e),console.log(t),console.log(a)},beforeUpload:function(e,t){console.log(e),console.log(t)},delAllSelection:function(){var e=this;console.log(this.multipleSelection);for(var t=new Array(this.multipleSelection.length),a=0;a<this.multipleSelection.length;a++)t[a]=this.multipleSelection[a].id;this.tableData.splice(0,this.query.pageSize),console.log("哈"),console.log(t),this.$axios({method:"post",url:"/delDoc",headers:{"content-type":"application/json"},data:t}).then((function(t){console.log(t.data),e.$message.error(t.data.msg),e.getdocList(),e.getdocCategory()})).catch((function(e){console.log(e)}))},handleCurrentChange:function(e){this.query.pageIndex=e,this.getdocList()},handleSizeChange:function(e){this.query.pageSize=e,this.getdocList(),console.log("每页 ".concat(e," 条"))}},created:function(){this.getdocList(),this.getdocCategory()}},c=i,r=(a("f5cb"),a("2877")),u=Object(r["a"])(c,l,o,!1,null,null,null);t["default"]=u.exports},b0ef:function(e,t,a){},f5cb:function(e,t,a){"use strict";a("b0ef")}}]);