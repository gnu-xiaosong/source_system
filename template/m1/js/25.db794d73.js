(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[25],{"56b4":function(t,e,n){"use strict";n.r(e);var i=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("q-page",{staticStyle:{height:"800px"},attrs:{padding:""}},[n("div",{staticClass:"text-h4",staticStyle:{msrgin:"0 auto"}},[t._v("\n      用户注册\n ")]),n("q-input",{staticStyle:{"margin-top":"70px","margin-left":"25px","margin-right":"25px"},attrs:{outlined:"",rules:[function(t){return 0!=t.length||"不能为空！"}],"error-message":t.warning,label:"邮箱"},on:{blur:function(e){return e.preventDefault(),t.isValid(1)}},model:{value:t.user.email,callback:function(e){t.$set(t.user,"email",e)},expression:"user.email"}}),n("q-input",{staticStyle:{margin:"25px"},attrs:{outlined:"","error-message":t.warning,rules:[function(t){return null!==t||"不能为空！"},function(t){return t.length>6||"长度要大于6"}],label:"用户名(长度大于6为字符)"},on:{blur:function(e){return e.preventDefault(),t.isValid(2)}},model:{value:t.user.name,callback:function(e){t.$set(t.user,"name",e)},expression:"user.name"}}),n("q-input",{staticStyle:{margin:"25px"},attrs:{outlined:"","error-message":t.warning,rules:[function(t){return 0!=t.length||"不能为空！"}],label:"QQ"},on:{blur:function(e){return e.preventDefault(),t.isValid(3)}},model:{value:t.user.QQ,callback:function(e){t.$set(t.user,"QQ",e)},expression:"user.QQ"}}),n("q-input",{staticStyle:{margin:"25px"},attrs:{outlined:"",type:"password",rules:[function(t){return null!==t||"不能为空！"},function(t){return t.length>6||"长度要大于6"}],"error-message":t.warning,label:"密码(长度大于6为字符)"},model:{value:t.user.password,callback:function(e){t.$set(t.user,"password",e)},expression:"user.password"}}),n("q-input",{staticStyle:{margin:"25px"},attrs:{outlined:"",rules:[function(t){return null!==t||"不能为空！"}],"error-message":t.warning,type:"password",label:"再次输入密码"},on:{blur:function(e){return e.preventDefault(),t.verify()}},model:{value:t.user.Repassword,callback:function(e){t.$set(t.user,"Repassword",e)},expression:"user.Repassword"}}),n("q-input",{staticStyle:{margin:"25px"},attrs:{"bottom-slots":"",label:"请输入验证码",counter:""},scopedSlots:t._u([{key:"hint",fn:function(){},proxy:!0},{key:"after",fn:function(){return[n("q-btn",{attrs:{round:"",dense:"",flat:"",icon:"send"},on:{click:function(e){return t.sendEmail()}}})]},proxy:!0}]),model:{value:t.user.verification,callback:function(e){t.$set(t.user,"verification",e)},expression:"user.verification"}}),n("q-btn",{staticClass:"float-right ",staticStyle:{width:"100px","margin-top":"25px","margin-right":"25px","margin-bottom":"200px"},attrs:{loading:t.loading,color:"primary"},on:{click:function(e){return t.register()}}},[t._v("\n        "+t._s(t.tip)+"\n     ")])],1)},s=[],a=(n("b0c0"),n("4328")),r=n.n(a),o={data:function(){return{warning:"",tip:"注册",loading:!1,data:{},user:{email:"",QQ:"",name:"",password:"",Repassword:"",verification:null}}},methods:{sendEmail:function(){var t=this,e=this.rand(1e3,9999);this.$q.cookies.set("verification_code",e),console.log("生成的随机验证码为:"+this.$q.cookies.get("verification_code")),this.$axios.get("/sendMail",{params:{to:this.user.email,title:"注册验证码",content:"亲爱的用户您好！，您的验证码为:"+e}}).then((function(e){t.$q.notify({message:e.data.msg,icon:"announcement",position:"top",color:"negative"}),console.log(e.data)})).catch((function(t){console.log(t)}))},rand:function(t,e){return Math.floor(Math.random()*(e-t))+t},isValid:function(t){var e=this;this.data=1==t?{col:"email",data:this.user.email,err:"该邮箱已被注册"}:2==t?{col:"username",data:this.user.name,err:"该用户名已经存在"}:{col:"QQ",data:this.user.QQ,err:"该qq已被使用"},this.$axios.post("/isValid",r.a.stringify(this.data)).then((function(t){1==t.data.code&&e.$q.notify({message:t.data.msg,icon:"announcement"}),console.log(t.data)}))},verify:function(){this.user.password!=this.user.Repassword&&(this.$q.notify({message:"两次输入密码不一致！请重新输入！",icon:"announcement"}),this.user.Repassword)},register:function(){var t=this;this.tip="注册中…",this.user.password!=this.user.Repassword?this.$q.notify({message:"两次输入密码不一致！请重新输入！",icon:"announcement"}):this.$q.cookies.get("verification_code")!=this.user.verification?this.$q.notify({message:"验证码错误！请重新输入",icon:"announcement",position:"top",color:"negative"}):this.$axios.post("/register",r.a.stringify(this.user)).then((function(e){t.$q.notify({message:e.data.msg,icon:"announcement",position:"top",color:"negative"}),t.tip="注册",400!=e.data.code&&t.$router.push("login"),console.log(e.data)})).catch((function(t){console.log(t)}))}}},u=o,l=n("2877"),c=n("9989"),p=n("27f9"),d=n("9c40"),f=n("eebe"),g=n.n(f),m=Object(l["a"])(u,i,s,!1,null,null,null);e["default"]=m.exports;g()(m,"components",{QPage:c["a"],QInput:p["a"],QBtn:d["a"]})}}]);