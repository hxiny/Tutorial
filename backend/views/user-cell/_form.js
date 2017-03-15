//小区改变
$("#usercell-cell_id").change(function() {
    var cellid = $(this).val();
    $("#usercell-build_id").html("<option value=\"0\">请选择所属楼宇...</option>");
    $("#deviceuserauth-house_id").html("<option value=\"0\">请选择所属房屋...</option>");
    $("#deviceuserauth-device_name").html("<option value=\"0\">请选择相应设备...</option>");
    if (cellid > 0) {
        getBuilds(cellid);
    }
});
$("#usercell-build_id").change(function() {
    var buildid = $(this).val();
    $("#deviceuserauth-house_id").html("<option value=\"\">请选择所属房屋...</option>");
    if (buildid > 0) {
        getHouses(buildid);
    }
});
$("#btn_search").click(function () {
    var name = $("#userselect-name").val();
    var phone = $("#userselect-phone").val();
    var href = url+"/users";
    $.ajax({
        "type" : "GET",
        "url"  : href,
        "data" : {name : name,phone:phone},
        "dataType": "JSON",
        success : function(d) {
            if(d){
                var appendOp = "";
                $.each(d, function(index, value, array) {
                    appendOp += "<option value=" +JSON.stringify(value)+ ">" +  value.NICKNAME +"&nbsp"+value.PHONE+ "</option>";
                });
                $("#user_select").html(appendOp);
            }
        }
    });
});


$('#user_select').dblclick(function(){
    // var value=$('#user_select').val();
    var value = JSON.parse($('#user_select').val());
    $("#usercell-user_id").val(value.USER_ID);
    $(".bs-example-modal-lg").modal('toggle');
    $(".field-user-nickname").show();
    $(".field-user-phone").show();
    $("#user-nickname").val(value.NICKNAME);
    $("#user-phone").val(value.PHONE);
}); // 该组件禁用右键菜单（Firefox会触发右键菜单）;
function getBuilds(id)
{
    var href = url+"/builds";
    $.ajax({
        "type" : "GET",
        "url"  : href,
        "data" : {cellId : id},
        "dataType": "JSON",
        success : function(d) {
            if(d){
                var appendOp = "";
                $.each(d, function(index, value, array) {
                    appendOp += "<option value=\"" + index + "\">" + value + "</option>";
                });
                $("#usercell-build_id").append(appendOp);
            }
        }
    });
}
function getHouses(id)
{
    var href = url+"/houses";
    console.log(href, id);
    $.ajax({
        "type" : "GET",
        "url"  : href,
        "data" : {buildId : id},
        "dataType": "JSON",
        success : function(d) {
            if(d){
                var appendOp = "";
                $.each(d, function(index, value, array) {
                    appendOp += "<option value=\"" + index + "\">" + value + "</option>";
                });
                $("#usercell-house_id").append(appendOp);
            }
        }
    });
}

function getHouseUsers(id)
{
    var href = url+"/houseusers";
    $.ajax({
        "type" : "GET",
        "url"  : href,
        "data" : {houseId : id},
        "dataType": "JSON",
        success : function(d) {
            if(d){
                var appendOp = "";
                $.each(d, function(index, value, array) {
                    appendOp += "<label><input type=\"checkbox\" name=\"DeviceUserAuth[USER_ID][]\" value=\""+index+"\">" + value + "</label>"
                });
                $("#deviceuserauth-user_id").append(appendOp);
            }
        }
    });
}
