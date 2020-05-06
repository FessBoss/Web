$(document).ready(function ()
{
    Insert_record();
    view_record();
    get_record();
    update_record();
    delete_record();
});

//добавить пользователя
function Insert_record() {
    jQuery.noConflict();
    jQuery(document).on('click', '#btn_register', function ()
    {
        var User = jQuery('#UserName').val();
        var Login = jQuery('#UserLogin').val();
        var Email = jQuery('#UserEmail').val();
        var Pass = jQuery('#UserPass').val();
        var RPass = jQuery('#UserRPass').val();
        var Status = jQuery('#UserStatus').val();

        jQuery.ajax(
            {
                url : 'AjaxInsert.php',
                method: "post",
                data:{UName:User, ULogin: Login, UEmail: Email, UPass: Pass, URPass: RPass, UStatus: Status},
                success: function (data)
                {
                    jQuery('#message').html(data);
                    $('#Registration').modal('show');
                    jQuery('form').trigger('reset');
                    view_record();
                }
            });
    });

    jQuery(document).on('click', '#btn_close', function () {
        jQuery('form').trigger('reset');
        jQuery('#message').html('');
    });
}

//Показать таблицу
function view_record()
{
    jQuery.noConflict();
    jQuery.ajax(
        {
            url: 'AjaxSelect.php',
            method: 'post',
            success: function (data) {
                data = jQuery.parseJSON(data);
                jQuery('#table').html(data);
            }
        }
    );
}

//получить пользователя по id
function get_record()
{
    jQuery.noConflict();
    jQuery(document).on('click', '#btn_edit', function()
    {
        var ID = jQuery(this).attr('data-id');
        jQuery.ajax(
            {
               url: 'get_data.php',
                method: 'post',
                data: {UserID: ID},
                dataType: 'JSON',
                success: function (data)
                {
                    jQuery('#Up_UserID').val(data[0]);
                    jQuery('#Up_UserName').val(data[1]);
                    jQuery('#Up_UserLogin').val(data[2]);
                    jQuery('#Up_UserEmail').val(data[3]);
                    $('#update').modal('show');
                }
            });
    });
}

//изменить пользователя
function update_record()
{
    jQuery.noConflict();
    jQuery(document).on('click', '#btn_update', function () {
        var UpdateId = jQuery('#Up_UserID').val();
        var UpdateUser = jQuery('#Up_UserName').val();
        var UpdateLogin = jQuery('#Up_UserLogin').val();
        var UpdateEmail = jQuery('#Up_UserEmail').val();
        var UpdateStatus = jQuery('#Up_UserStatus').val();

        if (UpdateLogin == "" || UpdateEmail == "" || UpdateUser =="") {
            jQuery('#up-message').html('Введите данные полностью');
            $('#update').modal('show');
        }
        else {
            jQuery.ajax({
                url: 'AjaxUpdate.php',
                method: 'post',
                data: {U_ID: UpdateId, U_User: UpdateUser, U_Login:UpdateLogin, U_Email: UpdateEmail, U_Status: UpdateStatus},
                success: function (data) {
                    jQuery('#up-message').html(data);
                    $('#update').modal('show');
                    view_record();
                }
            });
        }
    });
}

function delete_record() {
    jQuery.noConflict();
    jQuery(document).on('click', '#btn_delete', function ()
    {
        var Delete_ID = jQuery(this).attr('data-id1');
        $('#delete').modal('show');
        jQuery(document).on('click', '#btn_delete_record', function ()
        {
            jQuery.ajax(
                {
                    url: 'AjaxDelete.php',
                    method: 'post',
                    data:{Del_ID: Delete_ID},
                    success: function (data)
                    {
                        jQuery('#delete-message').html(data).hide(5000);
                        view_record();
                    }
                });
        })
    });
}

