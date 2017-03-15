$('i.glyphicon-refresh-animate').hide();
function updateItems(r) {
    _opts=r;
    search('avaliable');
    search('assigned');
}

$('.btn-assign').click(function () {
    var $this = $(this);
    var target = $this.data('target');
    var items = $('select.list[data-target="' + target + '"]').val();
    var cell_id=$('select.cell')[0].value;
    if (items && items.length) {
        $this.children('i.glyphicon-refresh-animate').show();
        $.post($this.attr('href'), {items: items,cell_id:cell_id}, function (r) {
            updateItems(r);
        }).always(function () {
            $this.children('i.glyphicon-refresh-animate').hide();
        });
    }
    return false;
});

$('.search[data-target]').keyup(function () {
    search($(this).data('target'));
});
// $('#cell').onchange(function () {
//     console.log("1");

// });
$("select[name='cell']").bind('change',function () {
    search('avaliable');
    search('assigned');
});

function search(target) {
   var cell_id=$('select.cell')[0].value;
    // console.log(cell_id,_opts[cell_id],$('#cell'));
    var $list = $('select.list[data-target="' + target + '"]');
    $list.html('');
    var q = $('.search[data-target="' + target + '"]').val();
    // _opts.items = _opts.items[$cell_id];
    var groups = {
        role: [$('<optgroup label="角色">'), false],
        permission: [$('<optgroup label="权限">'), false],
    };
    $.each(_opts[cell_id][target], function (name, group) {
        // console.log(name, group,q,name.indexOf(q),groups[group][0],groups[group],groups['role']);
        if (name.indexOf(q) >= 0) {
            $('<option>').text(name).val(name).appendTo(groups[group][0]);
            groups[group][1] = true;
        }
    });
    $.each(groups, function () {
        if (this[1]) {
            $list.append(this[0]);
        }
    });
}
// initial
console.log(_opts);
search('avaliable');
search('assigned');

