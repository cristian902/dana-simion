(function ($) {
    $.danasimion = {
        'init': function () {
            this.initLightbox();
        },
        'initLightbox': function () {
            $('.category-item').click(function(){
                var itemModal = $(this).find('.modal');
                itemModal.modal({show:true});
            });
        }
    };

    $(document).ready(function () {
        $.danasimion.init();
    })

})(jQuery);


