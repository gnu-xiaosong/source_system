(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([[16],{"8fc2":function(e,t,a){"use strict";a.r(t);var n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("div",{staticClass:"q-pa-md q-gutter-sm",staticStyle:{"margin-top":"1px"}},[a("div",[a("q-breadcrumbs",[a("q-breadcrumbs-el",{attrs:{icon:"undo"},on:{click:function(t){return e.re()}}}),a("q-breadcrumbs-el",{attrs:{label:"松币充值",icon:"article",to:""},on:{click:function(t){return e.go()}}})],1)],1),a("div",{staticClass:"q-pa-md",staticStyle:{"max-width":"auto"}},[a("q-list",{staticClass:"rounded-borders",attrs:{dense:"",bordered:"",padding:""}},[a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:""}},[a("q-item-section")],1),a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:""}},[a("q-item-section",[e._v("\n          充值账号:"+e._s(e.name)+"\n        ")])],1),a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:""}},[a("q-item-section",[e._v("\n          充值金额:\n          "),a("q-input",{staticStyle:{"max-width":"200px"},attrs:{standout:"",type:"number",filled:""},model:{value:e.money,callback:function(t){e.money=t},expression:"money"}})],1)],1),a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:""}},[a("q-item-section",[e._v("\n          松币:\n     "),a("q-input",{staticStyle:{"max-width":"200px"},attrs:{standout:"",type:"number",filled:""},model:{value:e.cores,callback:function(t){e.cores=t},expression:"cores"}})],1)],1),a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:""}},[a("q-item-section",[e._v("\n          备注:\n     "),a("q-input",{staticStyle:{"max-width":"200px"},attrs:{standout:"",filled:""},model:{value:e.remark,callback:function(t){e.remark=t},expression:"remark"}})],1)],1),a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:""}},[a("q-item-section",[e._v("\n        兑换规则:\n        100松币=1元，可能略有波动。\n        ")])],1),a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:""}},[a("q-item-section")],1),a("q-item",{directives:[{name:"ripple",rawName:"v-ripple"}],attrs:{clickable:""}},[a("q-item-section",[a("q-btn",{attrs:{color:"amber",glossy:"",label:"充值"},on:{click:function(t){return e.voucher()}}})],1)],1)],1)],1)])])},i=[],r=(a("99af"),a("b0c0"),a("a9e3"),a("4328"),{data:function(){return{name:"",money:520,cores:1314,remark:""}},methods:{voucher:function(){var e=this.tradeNo();window.location.href="/public/index.php/pay?token="+this.$q.cookies.get("user_token")+"&out_trade_no="+e+"&total_amount="+this.money+"&subject=购买松币&description=这是购买松币&remark="+this.remark+"&category=购买松币&pay_type=1&pay_methods=web"},tradeNo:function(){var e=new Date,t=e.getFullYear(),a=e.getMonth()+1,n=e.getDate(),i=e.getHours(),r=e.getMinutes(),c=e.getSeconds();String(a).length<2&&(a=Number("0"+a)),String(n).length<2&&(n=Number("0"+n)),String(i).length<2&&(i=Number("0"+i)),String(r).length<2&&(r=Number("0"+r)),String(c).length<2&&(c=Number("0"+c));for(var o="".concat(t).concat(a).concat(n).concat(i).concat(r).concat(c),s=4,l="",m=0;m<s;m++)l+=Math.floor(10*Math.random());return o+l},getQQ:function(){var e=this;this.$axios.get("/getUserData",{params:{token:this.$q.cookies.get("user_token")}}).then((function(t){200==t.data.code&&(e.name=t.data.username,console.log(t.data))})).catch((function(e){console.log(e)}))},re:function(){this.$router.back()}},watch:{money:function(e,t){this.cores=100*Number(e),console.log(this.cores)},cores:function(e,t){this.money=parseInt(Number(e)/100),console.log(this.money)}},created:function(){this.getQQ()}}),c=r,o=a("2877"),s=a("ead5"),l=a("079e"),m=a("1c1c"),u=a("66e5"),p=a("4074"),d=a("27f9"),b=a("9c40"),v=a("714f"),h=a("eebe"),g=a.n(h),f=Object(o["a"])(c,n,i,!1,null,null,null);t["default"]=f.exports;g()(f,"components",{QBreadcrumbs:s["a"],QBreadcrumbsEl:l["a"],QList:m["a"],QItem:u["a"],QItemSection:p["a"],QInput:d["a"],QBtn:b["a"]}),g()(f,"directives",{Ripple:v["a"]})}}]);