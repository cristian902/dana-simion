(function ($) {
    $.danasimion = {
        'init': function () {
            this.initLightbox();
            this.paginatePostsGridNext();
            this.paginatePostsGridPrev();
        },
        'initLightbox': function () {
            $('.category-item').click(function(){
                var itemModal = $(this).find('.modal');
                itemModal.modal({show:true});
            });
        },
        'paginatePostsGridNext': function () {
            $('.grid-pagination .next').on('click', function () {
                var paintingsGrid = $('.paintings-grid');
                var maxPage = paintingsGrid.data('max-page');
                var currentPage = paintingsGrid.data('current-page');
                if(currentPage < maxPage){
                    var nextpage = currentPage+1;
                    $('.page-'+currentPage).removeClass('current');
                    $('.page-'+nextpage).addClass('current');
                    paintingsGrid.data('current-page', nextpage);
                }
            });
        },
        'paginatePostsGridPrev': function () {
            $('.grid-pagination .prev').on('click', function () {
                var paintingsGrid = $('.paintings-grid');
                var currentPage = paintingsGrid.data('current-page');
                if(currentPage > 1){
                    var prevPage = currentPage-1;
                    $('.page-'+currentPage).removeClass('current');
                    $('.page-'+prevPage).addClass('current');
                    paintingsGrid.data('current-page', prevPage);
                }
            });
        }
    };

    $(document).ready(function () {
        $.danasimion.init();
    })

})(jQuery);


