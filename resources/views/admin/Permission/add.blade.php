<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$reponse['formTitle']}}</title>
</head>
<body class="gray-bg">

@component('admin/components/form',$reponse)
@endcomponent


<script type="text/javascript">
    $(function () {
        $('#subPerm_chosen').hide();
        $('#topPerm').change(function () {
            var id = $(this).val();
            var htmls = "";
            $.getJSON("{{url('admin/permission/get-sub-perm')}}" + "/" + id, {}, function (result) {
                if (result.code == '0') {
                    $.each(result.data, function (i, v) {
                        htmls += "<option value='" + v.id + "'>" + v.display_name + "</option>";
                    });
                }
            });

            if (htmls != "") {
                $("#subPerm").html(htmls);
                $("#subPerm_chosen").show();
            }

        });

//        $('#subPerm').change(function () {
//            var id = $(this).val();
//            var html = getDatas(id);
//
//            $("#threePerm").html(html);
//        });


    })

    function getDatas(id) {


        $.getJSON("{{url('admin/permission/get-sub-perm')}}" + "/" + id, {}, function (result) {

            var htmls = "";
            if (result.code == '0') {
                $.each(result.data, function (i, v) {
                    htmls += "<option value='" + v.id + "'>" + v.display_name + "</option>";
                })
            }

            return 1;

        })


    }
</script>
</body>
</html>
