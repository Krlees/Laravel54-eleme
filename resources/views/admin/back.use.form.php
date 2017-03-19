{
field: 'price',
title: 'Price',
align: 'center',
formatter: function (value, row, index) {
return '&yen;' + row.price;
},
//                        editable: {
//                            type: 'text',
//                            title: 'Item Price',
//                            validate: function (value) {
//                                value = $.trim(value);
//                                if (!value) {
//                                    return 'error: 不可为空';
//                                }
//                                var data = $table.bootstrapTable('getData'),
//                                        index = $(this).parents('tr').data('index');
//                                return '';
//                            }
//                        }
},