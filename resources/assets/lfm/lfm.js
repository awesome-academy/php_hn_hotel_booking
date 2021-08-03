(function ($) {

    $.fn.filemanager = function (type, options) {
        type = type || 'file';
        this.on('click', function (e) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            localStorage.setItem('target_input', $(this).data('input'));
            localStorage.setItem('target_preview', $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
            window.SetUrl = function (url, file_path) {
                //set the value of the desired input to image url
                var target_input = $('#' + localStorage.getItem('target_input'));
                target_input.val(file_path).trigger('change');
                //set or change the preview image src
                var target_preview = $('#' + localStorage.getItem('target_preview'));
                target_preview.attr('src', file_path).trigger('change');
                let multiple = (options && options.multiple && options.element && options.name) ? options.multiple : false;
                if (multiple) {
                    let count = $('#slider_container').find('input').length;
                    let html = `<div class="col-3">` +
                        `<input name="` + options.name + `[]" hidden value="` + file_path + `"/>` +
                        `<button class="btn btn-danger position-absolute" style="top: 0; right: 0" type="button" onclick="$(this).parent().remove()"><i class="fas fa-times"></i></button>` +
                        `<img src="` + url + `" class="img-thumbnail">` +
                        `</div>`;
                    let limit = (options && options.limit) ? options.limit : Math.min();
                    if (count < limit) {
                        $(options.element).append(html);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: options.message
                        });
                    }
                }
            };
            return false;
        });
    }

})(jQuery);
