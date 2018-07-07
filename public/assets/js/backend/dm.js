define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'dm/index',
                    add_url: 'dm/add',
                    edit_url: 'dm/edit',
                    del_url: 'dm/del',
                    multi_url: 'dm/multi',
                    table: 'dm',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'model_name', title: __('Model_name')},
                        {field: 'addtime', title: __('Addtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'type', title: __('Type'), visible:false, searchList: {"4":__('Type 4')}},
                        {field: 'type_text', title: __('Type'), operate:false},
                        {field: 'create_type', title: __('Create_type'), visible:false, searchList: {"4":__('Create_type 4')}},
                        {field: 'create_type_text', title: __('Create_type'), operate:false},
                        {field: 'type1_num', title: __('Type1_num')},
                        {field: 'type2_num', title: __('Type2_num')},
                        {field: 'type3_num', title: __('Type3_num')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});