define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'test/index',
                    add_url: 'test/add',
                    edit_url: 'test/edit',
                    del_url: 'test/del',
                    multi_url: 'test/multi',
                    table: 'test',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'weigh',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'admin_id', title: __('Admin_id')},
                        {field: 'category_id', title: __('Category_id')},
                        {field: 'category_ids', title: __('Category_ids')},
                        {field: 'week', title: __('Week'), visible:false, searchList: {"monday":__('week monday'),"tuesday":__('week tuesday'),"wednesday":__('week wednesday')}},
                        {field: 'week_text', title: __('Week'), operate:false},
                        {field: 'flag', title: __('Flag'), searchList: {"hot":__('flag hot'),"index":__('flag index'),"recommend":__('flag recommend')}, formatter: Table.api.formatter.flag},
                        {field: 'genderdata', title: __('Genderdata'), visible:false, searchList: {"male":__('genderdata male'),"female":__('genderdata female')}},
                        {field: 'genderdata_text', title: __('Genderdata'), operate:false},
                        {field: 'hobbydata', title: __('Hobbydata'), visible:false, searchList: {"music":__('hobbydata music'),"reading":__('hobbydata reading'),"swimming":__('hobbydata swimming')}},
                        {field: 'hobbydata_text', title: __('Hobbydata'), operate:false, formatter: Table.api.formatter.label},
                        {field: 'title', title: __('Title')},
                        {field: 'image', title: __('Image'), formatter: Table.api.formatter.image},
                        {field: 'images', title: __('Images'), formatter: Table.api.formatter.images},
                        {field: 'attachfile', title: __('Attachfile')},
                        {field: 'keywords', title: __('Keywords')},
                        {field: 'description', title: __('Description')},
                        {field: 'city', title: __('City')},
                        {field: 'price', title: __('Price'), operate:'BETWEEN'},
                        {field: 'views', title: __('Views')},
                        {field: 'startdate', title: __('Startdate'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'activitytime', title: __('Activitytime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'year', title: __('Year')},
                        {field: 'times', title: __('Times')},
                        {field: 'refreshtime', title: __('Refreshtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'weigh', title: __('Weigh')},
                        {field: 'switch', title: __('Switch'), searchList: {"1":__('switch 1')}},
                        {field: 'status', title: __('Status'), visible:false, searchList: {"normal":__('normal'),"hidden":__('hidden')}},
                        {field: 'status_text', title: __('Status'), operate:false},
                        {field: 'state', title: __('State'), visible:false, searchList: {"0":__('State 0'),"1":__('State 1'),"2":__('State 2')}},
                        {field: 'state_text', title: __('State'), operate:false},
                        {field: 'category.id', title: __('Category.id')},
                        {field: 'category.pid', title: __('Category.pid')},
                        {field: 'category.type', title: __('Category.type')},
                        {field: 'category.name', title: __('Category.name')},
                        {field: 'category.nickname', title: __('Category.nickname')},
                        {field: 'category.flag', title: __('Category.flag'), formatter: Table.api.formatter.flag},
                        {field: 'category.image', title: __('Category.image'), formatter: Table.api.formatter.image},
                        {field: 'category.keywords', title: __('Category.keywords')},
                        {field: 'category.description', title: __('Category.description')},
                        {field: 'category.diyname', title: __('Category.diyname')},
                        {field: 'category.createtime', title: __('Category.createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'category.updatetime', title: __('Category.updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'category.weigh', title: __('Category.weigh')},
                        {field: 'category.status', title: __('Category.status'), formatter: Table.api.formatter.status},
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