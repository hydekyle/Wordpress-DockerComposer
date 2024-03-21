jQuery(document).ready(function ($) {
    function media_upload(button_class) {
        var _custom_media = false,
            _orig_send_attachment = wp.media.editor.send.attachment;
        $('body').on('click', button_class, function (e) {
            var button_id = '#' + $(this).attr('id');
            var self = $(button_id);
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(button_id);
            var id = button.attr('id').replace('_button', '');
            _custom_media = true;
            wp.media.editor.send.attachment = function (props, attachment) {
                if (_custom_media) {
                    $('.custom_media_id').val(attachment.id);
                    $('.custom_media_url').val(attachment.url);
                    $('.custom_media_image').attr('src', attachment.url).css('display', 'block');
                } else {
                    return _orig_send_attachment.apply(button_id, [props, attachment]);
                }
            }
            wp.media.editor.open(button);
            return false;
        });
    }

    media_upload('.custom_media_button');

    magazinemax_adi_install.recommended_plugins = [
        'one-click-demo-import',
        'mailchimp-for-wp',
        // Add more plugin slugs as needed
    ];

    function performAjaxRequest(slug) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'magazinemax_getting_started',
                    security: magazinemax_adi_install.nonce,
                    slug: slug,
                },
                success: function () {
                    resolve();
                },
                error: function () {
                    reject();
                },
            });
        });
    }

    function installPluginsSequentially(index) {
        if (index < magazinemax_adi_install.recommended_plugins.length) {
            var slug = magazinemax_adi_install.recommended_plugins[index];
            performAjaxRequest(slug).then(function () {
                installPluginsSequentially(index + 1);
            }).catch(function () {
                console.log('Failed to install plugin: ' + slug);
            });
        } else {
            // All plugins installed, now redirect
            var redirect_uri = magazinemax_adi_install.adminurl + '/themes.php?page=theme-dashboard&section=starter-templates';
            window.location.href = redirect_uri;
        }
    }

    $('.magazinemax-install-plugins').click(function (e) {
        e.preventDefault();
        $(this).addClass('updating-message');
        $(this).text(magazinemax_adi_install.btn_text);

        installPluginsSequentially(0);
    });
});