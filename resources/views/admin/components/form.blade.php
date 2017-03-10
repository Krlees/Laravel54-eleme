@include('admin/common/css')
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
                    <form class="form-horizontal m-t" id="signupForm">

                        @foreach ($formField as $i=>$v )
                            <div class="form-group">
                                {{ Form::label($v['title'], null, ['class' => 'col-sm-3 control-label']) }}
                                <div class="col-sm-8">
                                    {{formCreate($v['type'],$v['name'],$v['value'],$v['options'])}}
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
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>


<!-- 全局js -->
@include('admin/common/js')
<script src="{{asset('admin/js/plugins/validate/messages_zh.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/validate/jquery.validate.extend.js')}}"></script>
<script>

    var $ = jQuery;
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            element.closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            if (element.is(":radio") || element.is(":checkbox")) {
                error.appendTo(element.parent().parent().parent());
            } else {
                error.appendTo(element.parent());
            }
        },
        errorClass: "help-block m-b-none",
        validClass: "help-block m-b-none"


    });

    //以下为官方示例
    $().ready(function () {

        // validate signup form on keyup and submit
        var icon = "<i class='fa fa-times-circle'></i> ";
        $("#signupForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                test: {
                    mobile: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                firstname: icon + "请输入你的姓",
                lastname: icon + "请输入您的名字",
                username: {
                    required: icon + "请输入您的用户名",
                    minlength: icon + "用户名必须两个字符以上"
                },
                password: {
                    required: icon + "请输入您的密码",
                    minlength: icon + "密码必须5个字符以上"
                },
                confirm_password: {
                    required: icon + "请再次输入密码",
                    minlength: icon + "密码必须5个字符以上",
                    equalTo: icon + "两次输入的密码不一致"
                },
                email: icon + "请输入您的E-mail",
                agree: {
                    required: icon + "必须同意协议后才能注册",
                    element: '#agree-error'
                }
            }
        });

    });


</script>
<script src="{{asset('admin/js/plugins/webuploader/webuploader.min.js')}}"></script>
<script src="{{asset('admin/js/uploads.setting.js')}}"></script>
<script src="{{asset('admin/js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>