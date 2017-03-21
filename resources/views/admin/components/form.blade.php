@inject('formPresenter','App\Presenters\Admin\FormPresenter')
@include('admin/common/css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/Validform_v5.3.2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/plugins/webuploader/webuploader.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/demo/webuploader-demo.css')}}">

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>{{$formTitle}}</h5>
                </div>
                <div class="ibox-content">
                    {!! Form::open(['url' => $formUrl,'class'=>'form-horizontal m-t validform']) !!}

                    @foreach ($formField as $i=>$v )
                        <div class="form-group">
                            {!! Form::label($v['title'], null, ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-8">
                                {!! $formPresenter->bulidFieldHtml($v['type'],$v['name'],$v['value'],$v['options']) !!}
                                @if( isset($v['tips']) )
                                    <span class="m-b-none"><i
                                                class="fa fa-info-circle"></i> {{$v['tips']}}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button class="btn btn-primary" type="submit">提交</button>
                            <a href="javascript:" onclick="javascript:history.go(-1)" class="btn btn-default" id="back">返回</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

</div>


<!-- 全局js -->
<script src="{{asset('admin/js/Validform_v5.3.2_min.js')}}"></script>
<script src="{{asset('admin/js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>
<script>
    $('select.chosen-select').chosen({width: "200px"});

    var targetUrl = "{{$formUrl}}";

    var $valid = $(".validform").Validform({
        tiptype: function (msg, o, cssctl) {

        },
        ajaxPost: true,
        datatype: {
            "zh": /^[\u4E00-\u9FA5\uf900-\ufa2d]$/,
            "username": function (gets, obj, curform, regxp) {
                //参数gets是获取到的表单元素值，obj为当前表单元素，curform为当前验证的表单，regxp为内置的一些正则表达式的引用;
                var reg1 = /^[\w\.]{4,16}$/,
                        reg2 = /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,8}$/;

                if (reg1.test(gets)) {
                    return true;
                }
                if (reg2.test(gets)) {
                    return true;
                }
                return false;

                //注意return可以返回true 或 false 或 字符串文字，true表示验证通过，返回字符串表示验证失败，字符串作为错误提示显示，返回false则用errmsg或默认的错误提示;
            }

        },
        beforeCheck: function (curform) {
            //在表单提交执行验证之前执行的函数，curform参数是当前表单对象。
            //这里明确return false的话将不会继续执行验证操作;
        },
        beforeSubmit: function (curform) {

            //在验证成功后，表单提交前执行的函数，curform参数是当前表单对象。
            //这里明确return false的话表单将不会提交;
        },
        callback: function (data) {
            if (data.code == '0') {
                layer.msg('操作成功');
                if(targetUrl)
                    setTimeout("window.location.href='"+targetUrl+"'",1000);
            }
            $('#Validform_msg').hide();

        }

    });
    $valid.tipmsg.w["zh"] = "请输入中文字符！";

</script>