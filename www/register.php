<script type="text/javascript">
    function ajaxCheckEmail(obj) {
        if($(obj).val() != '') {
            var email = obj;
            $.ajax({
                async: false,
                url:  "email_check_ajax.php",
                type: "POST",
                data: {email: $(email).val()},
                dataType: "json",
                success: function(respData) {
                        console.log(respData);
                    if(respData.email == 'busy'){
                        $(email).siblings("p.help-block").css({"display":"block", "color": "red"}).text("Email is busy!");
                        setBadValid(email);
                        email = false;
                    }else {
                        $(email).siblings("p.help-block").css({"display":"block", "color": "green"}).text("Email is free!");
                        setOkValid(email);
                        email = true;
                    }
                }
            });
            return email;
        }
        return false;
    }

    function setOkValid(obj) {
        $(obj).parent('div').removeClass('has-error').addClass('has-success');
        $(obj).siblings('span.glyphicon').addClass('glyphicon-ok').removeClass('glyphicon-remove');
    }
    function setBadValid(obj) {
        $(obj).parent("div").removeClass('has-success').addClass('has-error');
        $(obj).siblings('span.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
    }


    var Validation = {
        compareReg: function(reg, obj) {
            if(reg.test($(obj).val())) {
                $(obj).parent('div').removeClass('has-error').addClass('has-success');
                $(obj).siblings('span.glyphicon').addClass('glyphicon-ok').removeClass('glyphicon-remove');
                return true;
            }else {
                $(obj).parent("div").removeClass('has-success').addClass('has-error');
                $(obj).siblings('span.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
                return false;
            }
        },
        email: function(e, obj) {
            var object = (obj == undefined) ? this:obj;
            var reg = /^[A-Za-z0-9_\.]{1,}@[A-Za-z0-9_\.]{1,}$/;
            var flag = Validation.compareReg(reg, object);

            flag = (!flag) ?  false : (ajaxCheckEmail(object)) ? true : false;
            console.log(flag);
            return flag;
        },
        login: function() {

        },
        pass: function(e, obj) {
            var object = (obj == undefined) ? this:obj;
            var reg = /^\w{6,50}$/;
            return Validation.compareReg(reg, object);
        },
        confPass: function(e, obj) {
            var object = (obj == undefined) ? this:obj;
            var pass = $('#formRegister input[name="userPass"]');
            if(pass.val() == $(object).val()) {
                $(object).parent('div').removeClass('has-error').addClass('has-success');
                $(object).siblings('p').css({"display": "block", "color": ""}).addClass('text-success').text("Пароли совпадают ^_^");
                return true;
            }else {
                $(object).parent("div").removeClass('has-success').addClass('has-error');
                $(object).siblings('p').css({"display": "block", "color": "#f00"}).text("Пароли не совпадают!!!!");
                return false;
            }
        },
        name: function() {

        },
        birthday: function(e, obj) {
            var reg = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
            var object = (obj == undefined) ? this:obj;
            return Validation.compareReg(reg, object);
        },
        phone: function() {

        }
    };


    $(document).ready(function() {
        $('#datetimepicker').datetimepicker({
            language: 'ru',
            format: "YYYY-MM-DD",
            pickTime: false
        });

        $('#tooltip').tooltip();
        $('#popover').popover();

        var form = $("#formRegister");

        form.find("input[name='userPass']").on('keyup', function() {
            var confirm = form.find("input[name='userPassConfirm']");
            if($(this).val() == '') {
                confirm.attr('disabled', 'disabled');
            }else {
                confirm.removeAttr('disabled');
            }
        });

        form.find("input[name='userEmail']").on('blur', Validation.email);
        form.find("input[name='userPass']").on('blur', Validation.pass);
        form.find("input[name='userPassConfirm']").on('blur', Validation.confPass);
        form.find("input[name='userBDay']").on('blur', Validation.birthday);


        $("#formSend").on("click", function() {
            var Form = {};

            var email = form.find("input[name='userEmail']");
            var pass = form.find("input[name='userPass']");
            var confP = form.find("input[name='userPassConfirm']");
            var bd = form.find("input[name='userBDay']");
            Form.email = Validation.email(event, email);
            Form.pass = Validation.pass(event, pass);
            Form.confPas = Validation.confPass(event, confP);
            Form.bd = Validation.birthday(event, bd);
            for(cur in Form) {

                if (!Form[cur]){
                    console.log(cur);
                    return false;
                }
            }
            return true;
        });


    });
</script>

<div class="container" style="margin-top: 60px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body" style="min-height: 300px;">
                    <h1 class="page-header" style="margin-top: 0;">Регистрация</h1>
                    <div class="row">
                        <div class="col-md-5">
                            <form id="formRegister" method="POST" action="register_handl.php">
                                <div class="form-group has-feedback">
                                    <label class="control-label"><span class="text-danger">*</span>Email</label>
                                    <input id="emailU" type="text" class="form-control" name="userEmail" placeholder="Email"  />
                                    <span class="glyphicon form-control-feedback"></span>
                                    <p style="display: none;" class="help-block"></p>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="control-label">
                                        <span class="text-danger">*</span>Пароль
                                        <button style="border: 0; padding: 0;" type="button" class="btn btn-link" id="popover" data-toggle="popover" data-trigger="focus" title="Ограничение на пароль" data-content="Пароль не должен содержать менее 6 символов!">
                                            <span class="glyphicon glyphicon-question-sign"></span>
                                        </button>
                                    </label>
                                    <input type="text" class="form-control" name="userPass" placeholder="Пароль"  />
                                    <span class="glyphicon form-control-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        <span class="text-danger">*</span>Повторите пароль
                                        <a id="tooltip" data-toggle="tooltip" data-placement="top" title="Подвердите пароль!">
                                            <span class="glyphicon glyphicon-question-sign"></span>
                                        </a>
                                    </label>
                                    <input disabled type="text" class="form-control" name="userPassConfirm" placeholder="Пароль"  />
                                    <p style="display: none;" class="help-block"></p>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Имя</label>
                                    <input type="text" class="form-control" name="userName" placeholder="Имя" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">День рождения</label>
                                    <input id="datetimepicker" type="text" class="form-control" name="userBDay" placeholder="День рождения" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Телефон</label>
                                    <input type="text" class="form-control" name="userPhone" placeholder="Телефон" />
                                </div>

                                <div class="form-group">
                                    <label class="control-label">О себе</label>
                                    <textarea style="resize: vertical;" rows="7" class="form-control" name="userInfo" placeholder="Сообщение"></textarea>
                                </div>
                                <div class="form-group">
                                    <input id="formSend" type="submit" class="btn btn-primary" value="Зарегистрировать" />
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>