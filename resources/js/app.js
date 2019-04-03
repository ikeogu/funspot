
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

//var menu = document.getElementById('dpd');

// $('.h-menu').click(function() {
//     $('#dpd').toggle();
// })



$('.h-menu').click(function () {
    $('.side-menu-modal').show();
})

$('.close-bar').click(function() {
    $('.side-menu-modal').hide();
})

window.onclick = function (even) {
    var modal = document.getElementById('mod');
    if (even.target == modal) {
        modal.style.display = 'none';
    }
}

var droppedFiles = false;
var isAjaxUpload = true;

var isAjaxUpload = function () {
    var div = document.createElement('div');
    return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}();

$('.v-upload-form').on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
    //alert('ray');
  })
  .on('dragover dragenter', function(e) {
    //   $('.v-upload-form').addClass('is-dragover');
      $('.box__input').addClass('is-dragover');
  })
  .on('dragleave dragend drop', function() {
      $('.box__input').removeClass('is-dragover');
  })
  .on('drop', function(e) {
    droppedFiles = e.originalEvent.dataTransfer.files;
    actn(droppedFiles)
    // console.log(e.originalEvent.dataTransfer.files)
  });

function  actn(e) {
    for (let i = 0; i < droppedFiles.length; i++) {
        if (!droppedFiles[i].type.match('video')) {
            alert('Only video formats are allowed');
            return;
        }
    }
    $('.box__input').addClass('m-hide');
    $('.box__uploading').addClass('m-show');
    for (let x = 0; x < droppedFiles.length; x++) {
        $('.form-wrap').append(vidBoxHtml(x + 1, droppedFiles[x].name,x));
        getFileThumbnail(droppedFiles[x], x)
    }

    $('.form-wrap').append('<button class="btn btn-primary pub" type="submit">Publish Video</button>');
}

$('.input').on('change', function (e) {
    droppedFiles = e.target.files;
    actn(droppedFiles)
});

var ind = 0;
var isUploading = true;

$('.form-wrap').on('click','.pub',function() {
    var ajaxData;
    var fm = $('.form-wrap .v-fm');
    var fth = $('.form-wrap .v-thumbnail');
    for (let i = 0; i < fm.length; i++) {
        if (fm[i] != null) {
            ajaxData = new FormData(fm.get(i));
            var ft = fth.get(i);
            var thData = $(ft).find('img').attr('src');
            ajaxData.append('v_file', droppedFiles[i]);
            ajaxData.append('v_thumbnail', thData);
            var getVal = fm.get(i);
            var val = $(getVal).find('.v-title').val();
            var gtEl = $('.v-ti').get(i);
            $(gtEl).find('span').html(val);
            ajxUpl(ajaxData, i)
        }
    }
    $('.v-meta').fadeOut();
    $('.upl-box').fadeIn();
    $('.x-close').hide();
    $(this).fadeOut();
    var cou = 0;
    for (let x = 0; x < droppedFiles.length; x++) {
        if (droppedFiles[x] != null) {
            cou++;
        }
    }
    $('.box__uploading div span').html(`
        Uploaded <span id="upd">0</span> of ${cou}
    `)
})

$('.form-wrap').on('click','.x-close',function() {
    var count = 0;
    var id = $(this).data('id');
    var fm = $('.form-wrap .ap-box');
    fm[id] = null
    droppedFiles[id] = null
    $(this).parent().parent().removeClass('in-list');
    $(this).parent().parent().fadeOut();
})

function  uploadIt(i) {
    var ajaxData;
    var fm = $('.form-wrap .v-fm');
    ajaxData = new FormData(fm.get(i));
    ajaxData.append('v_file', droppedFiles[i]);
    ajxUpl(ajaxData, i)
    console.log('called')
}

function  vidBoxHtml(cou,title,id) {
    var token = $('input[name=_token]');
    return `<div class="ap-box in-list" data-id="${id}">
        <div class="f-header"><p class="">${cou}</p><span class="float-right"></span></div>
        <form class="v-fm" method="POST" enctype="multipart/form-data">
        <div class="v-thumbnail"></div>
        <div class="float-right x-close" data-id="${id}"><span title="remove">x</span></div>
        <div class="upl-box">
            <div class="v-ti"><span></span></div>
            <div class="up-note"><span id="perc">Waiting&hellip;</span> <span id="per">0%</span></div>
            <div class="pro-bar"><span></span></div>
        </div>
        <div class="v-meta">
        <input type="hidden" name="_token" value="${token.val()}">
            <div class="form-group">
                <label>Title</label><br>
                <input type="text" name="title" class="form-control v-title" value="${title}">
            </div>
            <div class="form-group">
                <label>Description</label><br>
                <textarea name="desc" class="form-control"></textarea><br>
            </div>
            <div class="form-group">
                <label>Tag</label><br>
                <input type="text" name="tags" class="form-control v-tag">
            </div>
        </div>
        </form>
    </div>`;
}

var comp = 0;

function ajxUpl(ajaxData,index) {
    if (isAjaxUpload) {
        //e.preventDefault();
        var cou = 0;
        var image = $('#file');
        var form = $('.v-upload-form');
        var upB = $('.form-wrap .v-fm .upl-box');
        var url = form.attr('action');
        var $input = form.find('input[type="file"]');

        var token = $('input[name=_token]');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': token.val()
            },
            data: ajaxData,
            complete: function (da) {
                console.log(da.responseText)
                var v = $('#upd').html();
                var pInt = parseInt(v) + 1;
                $('#upd').html(pInt);
                var upBar = upB.get(index);
                var perc = '100';
                $(upBar).find('#perc').html('Completed&hellip;')
                $(upBar).find('#per').html(perc + '%')
                $(upBar).find('.pro-bar span').css('width', perc + '%');
                $(upBar).find('.pro-bar span').css('background', 'green');
            },
            success: function (data) {
                console.log('ray')
            },
            error: function (e) {
                // console.log(e.statusText)
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', function(e) {
                        if (e.lengthComputable) {
                            var max = e.total;
                            var current = e.loaded;
                            var Percentage = (current * 100) / max;
                            var perc = Math.floor(Percentage);
                            var upBar = upB.get(index);
                            if (perc >= 100) {
                                perc = '99';
                            }
                            // <div class="up-note"><span id="perc">Waiting&hellip;</span> <span>0%</span></div>
                            // <div class="pro-bar"><span></span></div>
                            $(upBar).find('#perc').html('Uploading&hellip;')
                            $(upBar).find('#per').html(perc + '%')
                            $(upBar).find('.pro-bar span').css('width', perc + '%');

                            //$(upBar.get(ind)).css('background', 'red');

                            //console.log(Math.floor(Percentage));

                            if (Percentage >= 100) {
                                // process completed  
                                // console.log(ind)
                                // console.log('completed ' + index)
                            }
                        }
                    }, false);
                }
                return myXhr;
            },
        });
    }   
}

var curVal = 0;

function progress(e) {
    if (e.lengthComputable) {
        var max = e.total;
        var current = e.loaded;
        var Percentage = (current * 100) / max;
        var perc = Math.floor(Percentage);
        var upBar = $('.form-wrap .v-fm .upl-box').get(ind);
        if (curVal < perc) {
            curVal = perc;
        }
        // <div class="up-note"><span id="perc">Waiting&hellip;</span> <span>0%</span></div>
        // <div class="pro-bar"><span></span></div>
        $(upBar).find('#perc').html('Uploading&hellip;')
        $(upBar).find('#per').html(curVal+'%')
        $(upBar).find('.pro-bar span').css('width', curVal+'%');
        
        //$(upBar.get(ind)).css('background', 'red');

        //console.log(Math.floor(Percentage));

        if (Percentage >= 100) {
            // process completed  
            // console.log(ind)
            // console.log('completed ' + ind)
        }
    }
}


// ///////////////////////////////////////////////////////////////////////////////////

// $('#inp').click(function (params) {
//     uploadFile();
// })

var form = $('#upload_form')
var url = form.attr('action');

$('#file1').on('change',function (e) {
    e.preventDefault();
    e.stopPropagation();
    //uploadFile();
    //droppedFiles = e.target.files;
    for (let x = 0; x < droppedFiles.length; x++) {
        //getFileThumbnail(droppedFiles[x])
    }
})


function _(el) {
    return document.getElementById(el);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img').attr('value', e.target.result);
            //$('#blah').addClass('show');
            $('#img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function getFileThumbnail(fileOB,i) {
    var file = fileOB;
    // console.log(file.type)
    var fileReader = new FileReader();
    var fm = $('.v-fm');
    if (file.type.match('image')) {
        fileReader.onload = function () {
            var img = document.createElement('img');
            img.src = fileReader.result;
            img.classList.add('measureImg')
            // document.getElementById('stage').appendChild(img);
            // fm.get(i).find('.v-thumbail').append(img)
            $(fm.get(i)).find('.v-thumbnail').append(img)
        };
        fileReader.readAsDataURL(file);
        return true;
    } else if (file.type.match('video')) {
        fileReader.onload = function () {
            var blob = new Blob([fileReader.result], { type: file.type });
            var url = URL.createObjectURL(blob);
            var video = document.createElement('video');
            var timeupdate = function () {
                if (snapImage()) {
                    video.removeEventListener('timeupdate', timeupdate);
                    video.pause();
                }
            };
            video.addEventListener('loadeddata', function () {
                if (snapImage()) {
                    video.removeEventListener('timeupdate', timeupdate);
                }
            });
            var snapImage = function () {
                var canvas = document.createElement('canvas');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                var image = canvas.toDataURL();
                var success = image.length > 100000;
                if (success) {
                    var img = document.createElement('img');
                    img.src = image;
                    img.classList.add('measureImg')
                    // document.getElementById('stage').appendChild(img);
                    // fm.get(i).find('.v-thumbail').append(img)
                    $(fm.get(i)).find('.v-thumbnail').append(img)
                    // console.log($(fm.get(i)).find('.v-thumbail').append(img))
                    URL.revokeObjectURL(url);
                }
                return success;
            };
            video.addEventListener('timeupdate', timeupdate);
            video.preload = 'metadata';
            video.src = url;
            // Load video in Safari / IE11
            video.muted = true;
            video.playsInline = true;
            video.play();
            // video.pause();
        };
        fileReader.readAsArrayBuffer(file);
        return true;
    }
}