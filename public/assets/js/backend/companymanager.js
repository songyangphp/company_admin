define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {


    console.log(Config.bs_list);
    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'companymanager/index',
                    add_url: 'companymanager/add',
                    edit_url: 'companymanager/edit',
                    del_url: 'companymanager/del',
                    multi_url: 'companymanager/multi',
                    table: 'company',
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
                        /*{checkbox: true},*/
                        {field: 'id', title: __('Id') , operate:false},
                        {field: 'company_name', title: __('Company_name') , operate:false},
                        {field: 'code', title: __('Code')},
                        {field: 'f_name', title: __('F_name') , operate:false},
                        {field: 'addtime', title: __('Addtime'), operate:false, addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'floor', title: __('Floor'),  operate:false, visible:false, searchList: {"4":__('Floor 4')}},
                        /*{field: 'floor_text', title: __('Floor'), operate:false},*/
                        {field: 'companylevel.name', title: __('Companylevel.name') ,  searchList: {'A': __('A'), 'B': __('B'), 'C': __('C'), 'D': __('D')}},
                        {field: 'businessscope.name', title: __('Businessscope.name') ,searchList: JSON.parse(Config.bs_list)},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,
                            //要在列表页加按钮就在这加
                            buttons : [{name: 'detail', text: '详情', title: '详情', icon: 'fa fa-list', classname: 'btn btn-xs btn-primary btn-dialog', url: 'companymanager/info'}]}
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