<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>IT Balans test</title>
    <script type="text/javascript" src="/lib/ext-4.2.1/examples/shared/include-ext.js"></script>
    <script type="text/javascript" src="/lib/ext-4.2.1/locale/ext-lang-ru.js"></script>
    <link rel="stylesheet" type="text/css" href="/lib/ext-4.2.1/examples/ux/grid/css/GridFilters.css" />
    <link rel="stylesheet" type="text/css" href="/lib/ext-4.2.1/examples/ux/grid/css/RangeMenu.css" />
    <style>
        body {
            background: #fff;
            margin: 0 !important;
            padding: 0 !important;
        }
    </style>
</head>
<body>
</body>
<script type="text/javascript">
Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', '/lib/ext-4.2.1/examples/ux');
Ext.require([
    'Ext.selection.CellModel',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.form.*',
    'Ext.toolbar.Paging',
    'Ext.ux.ajax.JsonSimlet'
]);

Ext.define('Person', {
    extend: 'Ext.data.Model',
    fields: [{
        name: 'person_id',
        type: 'int'
    }, {
        name: 'person_name'
    }, {
        name: 'education'
    }, {
        name: 'city'
    }]
});

Ext.define('Education', {
    extend: 'Ext.data.Model',
    fields: [{
        name: 'ed_id',
        type: 'int'
    }, {
        name: 'ed_name'
    }]
});

Ext.onReady(function(){
    var store=Ext.create('Ext.data.JsonStore', {
        autoDestroy: true,
        model: 'Person',
        proxy: {
            type: 'ajax',
            url: 'get-grid.php',
            reader: {
                type: 'json',
                root: 'data',
                idProperty: 'person_id',
                totalProperty: 'total'
            }
        },
        remoteSort: false,
        sorters: [{
            property: 'person_name',
            direction: 'ASC'
        }],
        pageSize: 10
    });

    var ed_store=new Ext.create('Ext.data.JsonStore', {
        model: 'Education',
        proxy: {
            type: 'ajax',
            url: 'get-ed.php',
            reader: {
                type: 'json',
                root: 'education_levels',
                idProperty: 'ed_id'
            }
        },
    });

    var createColumns=function (finish, start) {
        var columns=[{
            dataIndex: 'person_name',
            text: 'Имя',
            id: 'person_name',
            flex: .4
        }, {
            dataIndex: 'education',
            text: 'Образование',
            flex: .2,
            editor: new Ext.form.field.ComboBox({
                typeAhead: false,
                triggerAction: 'all',
                displayField: 'ed_name',
                valueField: 'ed_name',
                store: ed_store
            })
        }, {
            dataIndex: 'city',
            text: 'Город',
            flex: .4,
            sortable: false
        }];
        return columns.slice(start || 0, finish);
    };
    
    var grid=Ext.create('Ext.grid.Panel', {
        border: false,
        store: store,
        columns: createColumns(3),
        loadMask: true,
        dockedItems: [Ext.create('Ext.toolbar.Paging', {
            dock: 'bottom',
            store: store
        })],
        emptyText: 'No Matching Records',
        plugins: [
            Ext.create('Ext.grid.plugin.CellEditing', {
                clicksToEdit: 1
            })
        ]
    });

    grid.on('edit', function(editor, e) {
        if (e.originalValue!=e.value) {
            Ext.Ajax.request({
                url: '/set-ed.php?user_id='+e.record.id+'&ed_value='+e.value,
                success: function(response, options){
                    var objAjax = Ext.decode(response.responseText);
                    alert(objAjax.res);
                },
                failure: function(response, options){
                    alert("Ошибка: "+response.statusText);
                }
            }); 
        }
        e.record.commit();
    });

    Ext.create('Ext.panel.Panel', {
        width: '100%',
        height: '100%',
        layout: 'border',
        items: [{
            region: 'center',
            xtype: 'panel',
            layout: 'fit',
            margins: '0 0 0 0',
            items: grid
        }],
        renderTo: Ext.getBody()
    });

    store.load();
    ed_store.load();
});
</script>
</html>