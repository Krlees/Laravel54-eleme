<?php

if (!function_exists('humanFilesize')) {
    /**
     * 返回更好的尺寸
     *
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    function human_filesize($bytes, $decimals = 2)
    {
        $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}

if (!function_exists('isImage')) {
    /**
     * 判断文件的MIME类型是否为图片
     */
    function isImage($mimeType)
    {
        return starts_with($mimeType, 'image/');
    }
}

if (!function_exists('returnformField')) {
    /**
     * 返回组装的字段数据【辅助表单】
     *
     * @param $type
     * @param string $title
     * @param $name
     * @param null $value
     * @param $options
     * @param null $tips
     * @return array
     */
    function returnformField($type, $title = '', $name, $value = '', $options=[], $tips = null)
    {
        return compact('type', 'title', 'name', 'value', 'options', 'tips');

    }
}

if (!function_exists('formCreate')) {

    /**
     * 生成html
     *
     * @param $type
     * @param $name
     * @param null $value
     * @param array $options
     */
    function formCreate($type, $name, $value = null, $options = [])
    {
        // 默认样式
        $opt = ['class' => 'form-control'];

        if (in_array($type, ['text', 'date', 'datetime', 'url', 'tel', 'number', 'hidden', 'email', 'datetimeLocal', 'color'])) {
            $options = array_merge($options, $opt);

            return  Form::$type($name, $value, $options);
        } elseif ($type == 'checkbox') {
            $opt = ['class' => 'form-control checkbox-inline'];
            $options = array_merge($options, $opt);
            if (!is_array($value)) {
                return  "";
            }

            foreach ($value as $k => $v) {
                return  '<label class="checkbox-inline">'.Form::checkbox($name, $v['value'], isset($v['checked'])?$v['checked']:false, $options).$v['text'].'</label>';
            }

        } elseif ($type == 'radio') {
            $opt = ['class' => 'form-control radio-inline'];
            $options = array_merge($options, $opt);
            if (!is_array($value)) {
                return  "";
            }

            foreach ($value as $k => $v) {
                return  '<label class="radio-inline">'.Form::radio($name, $v['value'], isset($v['checked'])?$v['checked']:false, $options).$v['text'].'</label>';
            }

        } elseif ($type == 'select') {

            if (!is_array($value)) {
                return  "";
            }
            $opt = ['class' => 'chosen-select'];
            $options = array_merge($options, $opt);

            $checked = false;
            foreach ($value as $k => $v) {
                $list[$v['value']] = $v['text'];
                if (isset($v['checked']) && $v['checked'] == true) {
                    $checked = $k;
                }
            }

            return  Form::select($name, $list, $checked, $options);

        } elseif ($type == 'textarea') {
            $options = array_merge($options, $opt);
            return  Form::textarea($name, $value, $options);
        } elseif ($type == 'image') {
            return  Form::image($value, $name);
        } elseif ($type == 'password') {
            $options = array_merge($options, $opt);
            return  Form::password($name, $options);
        } elseif ($type == 'file') {
            return  <<<EOT
<div class="page-container">
    <p>您可以尝试文件拖拽来上传图片</p>
    <div id="uploader" class="wu-example">
        <div class="queueList">
            <div id="dndArea" class="placeholder">
                <div id="filePicker"></div>
                <p>或将照片拖到这里，单次最多可选300张</p>
            </div>
        </div>
        <div class="statusBar" style="display:none;">
            <div class="progress">
                <span class="text">0%</span>
                <span class="percentage"></span>
            </div>
            <div class="info"></div>
            <div class="btns">
                <div id="filePicker2"></div>
                <div class="uploadBtn">开始上传</div>
            </div>
        </div>
    </div>
</div>
EOT;
        }

    }
}


