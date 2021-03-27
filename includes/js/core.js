var ajxPath = "/" + window.location.pathname.split("/")[1] + "/ajx/";

// overwrite login links with modal
$(function(){
    $('a[href*="login.php"').click(function(e){
        if ($(this).attr("modal") != '0'){
            e.preventDefault();
            modal1('show')
            $.ajax({
                url: '../../ajx/user.php',
                data: {action: "showForm-tabs", return: 0, active: "login"}, // serializes the form's elements.
                type: 'POST',
                success: function(result) {
                    $('#modal1 .modal-body').html(result)
                }
            });
        }
    });    
})

// overwrite register links with modal
$(function(){
    $('a[href*="register.php"').click(function(e){
        if ($(this).attr("modal") != '0'){
            e.preventDefault();
            modal1('show')
            $.ajax({
                url: '../../ajx/user.php',
                data: {action: "showForm-tabs", return: 0, active: "register"}, // serializes the form's elements.
                type: 'POST',
                success: function(result) {
                    $('#modal1 .modal-body').html(result)
                }
            });
        }
    });    
})

// prevent form submit in forms using ajax submit
$(document).on('submit','form[prevent-default]',function(e){
  e.preventDefault();
});


function mainResult(data){
    try {
        data = JSON.parse(data)
        loading('hide');
        if(data.notification){
            if(data.notification.link){
                notify(data.notification.type, data.notification.msg, data.notification.link);
            }else{
                notify(data.notification.type, data.notification.msg);
                if(data.notification.type == 'success'){modal1('hide');}
            }
        }
        if (data.result) {
            $('.modal').modal('hide');
            setTimeout(function () {
                $('#result-modal .modal-body').html(data.result)
                $('#result-modal').modal('show');
            }, 150);
        }

        if (data.reload) {
            setTimeout(function () {
                location.reload();
            }, 1000);
        }

        if (data.student) {
            setTimeout(function () {
                document.location = data.redirect;
            }, 800);
        }

        if (data.notifyDo) {

            if (data.notifyDo.script) {
                $(".wrapper").append(data.notifyDo.script)
            }

            notify(data.notifyDo.type, data.notifyDo.msg);

            if (data.notifyDo.redirectTo) {
                setTimeout(function () { document.location = data.notifyDo.redirectTo;}, 1000);
            }
        }

    } catch(e) {
        notify('danger','An unknown error occured. Please reload and try again!');
    }    
}


// submit forms using ajax
function submitForm(obj,link) {
    var $this = $(obj);
    if ($this[0].checkValidity()) {
        loading('show')
        setTimeout(function () {
            $.ajax({
                url: "../ajx/" + link,
                data: new FormData(obj),
                type: 'POST',
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                    // $('#loading-modal .modal-content').html(data)
                    // modal1('hide');
                    mainResult(data)
                }
            });
        }, 500);
    }else{
        notify('danger','Please complete the required fields!');
    }
}


function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

// next form in the same modal
function nextForm(obj,link) {
    var $this = $(obj);
    if ($this[0].checkValidity()) {
        modal1('hide')
        loading('show')
        setTimeout(function () {
            $.ajax({
                url: ajxPath + link,
                data: $this.serialize(), // serializes the form's elements.
                type: 'POST',
                success: function(data) {
                    loading('hide')
                    setTimeout(function () {
                        modal1('show')
                        $('#modal1 .modal-body').html(data)
                    }, 500);
                }
            });
        }, 500);
    }else{
        notify('danger','Please complete the required fields!');
    }
}


function nextmodal(link,data) {
    modal1('hide')
    loading('show')
    setTimeout(function () {
        $.ajax({
            url: ajxPath + link,
            data: data, // serializes the form's elements.
            type: 'POST',
            success: function(data) {
                loading('hide')
                if (isJson(data)){
                    mainResult(data);
                }else{
                    setTimeout(function () {
                        modal1('show')
                        $('#modal1 .modal-body').html(data)
                    }, 500);
            
                }
            }
        });
    }, 500);
}

// loading modal
function loading(action){
    if (action=='show') {
        $('#loading-modal').modal({backdrop: 'static', keyboard: false});
    }
    if (action=='hide'){
        $('#loading-modal').modal('hide');
        $('body').css('padding-right','');
    }
}

// forms modal
function modal1(action){
    if (action=='show') {
        $('#modal1').modal('show');
    }
    if (action=='hide'){
        $('body').css('padding-right','');
        $('#modal1').modal('hide');
    }
}

// notify alerts
function notify(type,msg,url=''){
    switch(type) {
      case 'danger':
        icon = 'fi-caution'
        break;
      case 'success':
        icon = 'fi-checkmark'
        break;
      case 'info':
        icon = 'fi-info'
        break;
      case 'warning':
        icon = 'fi-flag1'
        break;
      default:
        icon = ''
    }
    $.notify({
        // options
        icon: icon,
        url: url,
        message: msg 
    },{
        // settings
        type: type,
        z_index: 1050,
        mouse_over: 'pause',
        placement: {
            align: "center"
        }
    });
}

// show form
function formShow(link,data,no="") {
    $.ajax({
        url: ajxPath + link,
        type: 'POST',
        data:data,//{ id: pid, action: 'overform' },
        success: function (result) {
            $('.maindiv'+no).html(result);
            // $('form').on('keypress', function (e) {
            //     var keyCode = e.keyCode || e.which;
            //     if (keyCode === 13) {
            //         e.preventDefault();
            //         $('form .btn').click();
            //     }
            // });
        }
    });
}

function submitmodel(link,data) {
    if ($(data)[0].checkValidity()) {
        $.ajax({
            url: ajxPath + link,
            data: $(data).serialize(), // serializes the form's elements.
            type: 'POST',
            success: function(result) {
                $('#popup1').modal('hide');
                $('.resultpop').html(result);
                $('#result-popup').modal('show');
            }
        });
    }else{
        alert("Complete the form fields");
    }
}

function modalShow(link,data,no="") {
    $.ajax({
        url: ajxPath + link,
        type: 'POST',
        data:data,//{ id: pid, action: 'overform' },
        success: function (result) {
            $('#modal1 .modal-body').html(result);
            $('#modal1').modal('show');
            asset();
        }
    });
}

function modalShow2(link,data) {
    $.ajax({
        url: 'ajax/'+link,
        type: 'POST',
        data:data,//{ id: pid, action: 'overform' },
        success: function (result) {
            $('.popup-result2').html(result);
            $('#popup2').modal('show');
            $('#popup1').modal('hide');
        }
    });
}

function morefields(link, data) {
    var cid = $("#trader").val();
    data['cid'] = cid;
    $.ajax({
        url: 'ajax/' + link,
        type: 'POST',
        data: data,
        success: function (result) {
            $("#tbody").append(result);
        }
    });
} 


function removeParent(x){
    $(x).closest('.remove').fadeOut(200, function() {
        $(this).remove()
    })
}

function showdisable(params) {
    if(params){
        window.location.href = '?datastatus=canceled&'+params;
    }else{
        window.location.href = '?datastatus=canceled';

    }
}

function showenable(params) {
    if(params){
        window.location.href =  window.location.origin + window.location.pathname+'?'+params;
    }else{
    window.location.href = window.location.origin + window.location.pathname;
    }
}

$(document).on("change", ".element", function () {
    var pram = "?";
    var path = window.location.pathname;
    $(".element").each(function () {
        var valu = $(this).val();
        var name = $(this).attr("name");
        pram = pram + name + "=" + valu + "&";
    });
    document.location = path + pram;

});

$(document).on("hidden.bs.modal", ".modal", function () {
    $(".popup-result").children().remove();
});


function moreField(link,data,divId) {
    data.number = product+1;
    $.ajax({
        url: ajxPath + link,
        type: 'POST',
        data:data,//{ id: pid, action: 'overform' },
        success: function (result) {
            product++;
            var objTo = document.getElementById(divId);
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass"+product);
            var rdiv = 'removeclass'+product;
            divtest.innerHTML =result;
            
            objTo.appendChild(divtest)
        }
    });
}

function remove_form_fields(link,data,rid) {
    $('.removeclass'+rid).remove();
    delete  products[rid];
    if(data.id > 0){
        $.ajax({
            url: ajxPath + link,
            type: 'POST',
            data:data,//{ id: pid, action: 'overform' },
            success: function (result) {
                $('.table').DataTable().ajax.reload();
            }
        });
    }
}


function asset() {
    $('#student').select2({ 
        width: '100%',
        placeholder: 'Select Student',
        allowClear: true,
        minimumInputLength: 5,
        ajax: {
            url: ajxPath + 'student.php',
            type: 'post',
            data: function (params) {
                var query = { search: params.term, action: 'findStudent' }
                return query;
            },
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data
                };
            },
        },
    }); 
};

$(document).ready(function() {
    asset();
});

// link action
$(document).on('click','.action',function (e) {
    e.preventDefault();
    var url = 'ajx/' + $(this).attr('url')
    var data = $(this).attr('data');
    data = JSON.parse(data)
    // console.log(data)
    loading('show')
    setTimeout(function () {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (data) {
                mainResult(data)
                // // send event to Google Analytics
                // action = data.action;
                // gtag('event', action);
            }
        });
    }, 500);
})

// App Functions

function ajxReq(link, data, responseArea, clearFlag = false, requestedElem = '') {

    if($(responseArea).has(requestedElem).length == 0) {

        procData = true; 
        contType = 'application/x-www-form-urlencoded'; 

        if (typeof data.action === 'object') {
            data = new FormData(data);
            procData = false;
            contType = false;
        }

        $.ajax({
            url: ajxPath + link,
            data: data,
            type: 'POST',
            contentType: contType,
            cache: false,
            processData: procData,
            success: function(res) {
                if (clearFlag) {
                    $(responseArea).fadeOut(180, function() {
                        $(this).empty().append(res).fadeIn();
                    });
                } else {
                    $(responseArea).append(res);
                }
            }
        });
        
    } else {
        slideToggleDiv(requestedElem);
    }
}

function slideToggleDiv(divClass) {
    $(divClass).fadeIn(1000);
    $(divClass + ' .card-body').slideToggle(function() {
        $(divClass + ' .slideBtn i').toggleClass("fa-angle-up fa-angle-down");
    });
}

function hideElem(elemClass, formClass = '') {
    if (formClass != '') {
        $(formClass).submit(function() {
            slideToggleDiv(elemClass);
            $(elemClass).fadeOut(1100);
        });
    } else {
        slideToggleDiv(elemClass);
        $(elemClass).fadeOut(1100);
    }

}

function removeElem(elemClass, formClass = '') {
    if (formClass != '') {
        $(formClass).submit(function() {
            $(elemClass).fadeOut(300, function () {
                $(this).remove();
            });
        });

    } else {
        $(elemClass).fadeOut(300, function () {
            $(this).remove();
        });
    }

}

function selectOption(optionObj, resDivClass, inputName, btnColor = 'dark', doReq = false, link = '', action = '') {

    var val = optionObj.val(), name = optionObj.text().slice(1, -1);

    if (doReq) {

        $.ajax({
            url: ajxPath + link,
            data: {action:action, id:val},
            type: 'POST',
            contentType: contType,
            cache: false,
            processData: procData,
            success: function(res) {
                $(resDivClass).empty();
                $.each(JSON.parse(res), function(k, v) {
                    generateSelectedLabel(resDivClass, inputName, k, v, btnColor);
                });
            }
        });
        
    } else {
        generateSelectedLabel(resDivClass, inputName, val, name, btnColor);
    }
}

function generateSelectedLabel(resDivClass, inputName, val, name, btnColor) {
    var divId = name.split(' ').join('-');
    if ($(resDivClass+' div').is('#'+divId+'')) {
        $('#'+divId).fadeOut(100, function() { $(this).fadeIn(100);});
    } else {
        if (val != '') {
            var input = '<div class="col-md-2 mt-2 remove" id="'+divId+'"> <input type="hidden" name="'+inputName+'[]" value="'+val+'">';
            var span  = '<span class="btn btn-'+btnColor+' btn-sm mr-0 w-75" style="border-top-right-radius: 0;border-bottom-right-radius: 0;">'+name+'</span><span class="btn btn-danger btn-sm ml-0 w-25" style="border-top-left-radius: 0;border-bottom-left-radius: 0;" onclick="removeParent(this);"> <i class="fa fa-close"></i></span>';
            var html  = input+span+'</div>'
        
            $(resDivClass).append(html);
        }
    }
}


function getOldVal(optionObj, valueFor, reqDetials) {
    
    var val = optionObj.val();

    $.ajax({
        url: ajxPath + reqDetials.link,
        data: {action:reqDetials.action, id:val, tblName:reqDetials.tblName},
        type: 'POST',
        cache: false,
        success: function(res) {
            var res = JSON.parse(res);
            if (valueFor.name) {
                $("input[name='"+valueFor.name+"']").val(""+res.name+"");
            }
            if (valueFor.price) {
                $("input[name='"+valueFor.price+"']").val(""+res.price+"");
            }
            if (valueFor.final) {
                $("input[name='"+valueFor.final+"']").val(""+res.final+"");
            }
            if (valueFor.midterm) {
                $("input[name='"+valueFor.midterm+"']").val(""+res.midterm+"");
            }
            if (valueFor.activity) {
                $("input[name='"+valueFor.activity+"']").val(""+res.activity+"");
            }
            if (valueFor.attendace) {
                $("input[name='"+valueFor.attendace+"']").val(""+res.attendace+"");
            }
            if (valueFor.start) {
                $("input[name='"+valueFor.start+"']").val(""+res.start_at+"");
            }
            if (valueFor.end) {
                $("input[name='"+valueFor.end+"']").val(""+res.end_at+"");
            }
            if (valueFor.status) {
                $("select[name='"+valueFor.status+"']").val(""+res.status+"");
            }
            // console.log(valuesPostion);
            // console.log($("input[name='"+valuesPostion.val1Pos+"']"));
            // $(resDivClass).empty();
            // $.each(JSON.parse(res), function(k, v) {
            //     generateSelectedLabel(resDivClass, inputName, k, v, btnColor);
            // });
        }
    });

}

function printIt(content = '') {
    if (content === '') {
        var content = $(".toPrint").html();
    }
    var popupWin = window.open('', '_blank', 'width=600,height=600');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + content + '</html>');
    popupWin.document.close();
}


function pay(link, data) {
    $.ajax({
        url: ajxPath + link,
        data: data,
        type: 'POST',
        contentType: 'application/x-www-form-urlencoded',
        cache: false,
        processData: true,
        success: function(res) {
            mainResult(res)
        }
    });
}
