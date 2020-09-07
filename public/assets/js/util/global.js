// NOTE: refers to [this] for accessibility
let instance;
// NOTE: recommended use: extend
export class globals {
    constructor() {
        instance = this;
    }

    static sharedFunctionalities() {
        instance.previewPhoto();
        instance.tabsController();
        instance.bulletinToggler();
        instance.miniCarouselControls();
    }

    tabsController() {
        $(".toggable").click(function() {
            $(this).parents('.toggable-parent').find(".toggable").removeClass("toggable-tab-active"); // remove active indicator form tabs
            let elementToDisplay = $(this).data('target'); // get id of tab view to make visible
            // // 
            instance.navigationHistory({sub: true, log: elementToDisplay });

            // support nested toggables
            $(".toggable-view").each(function() {
                if ($(this).attr('id') == elementToDisplay) {
                    $(this).parents('.toggable-view').removeClass('d-none');
                    
                    $(this).parents('.toggable-view').find(".toggable-tab-active").css('border', '2px solid red !important')

                    console.log();

                } else {

                    
                    // if ($(this).find('toggable-view') == ) {
                        
                    // } else {
                        
                    // }
                    // console.log(   $(this).find('toggable-view12121')  );
                    
                    $(this).addClass('d-none'); // hide currently visible tab view

                    
                }
            });

            $(this).addClass("toggable-tab-active"); // show indicator on selected tab
            $('#'+elementToDisplay).removeClass('d-none'); // make user requested tab view visible
        });
    }

    bulletinToggler() {
        $(".toggle-none-admin-bulletin").click(function() {
            const height = $(this).parents('.card').find(".user-bulletin-content");
            if (height.css('height') == '176px') {
                $(this).html('read Less  <i class="fad fa-chevron-up"></i> ');
                height.css('height', height.prop('scrollHeight')+'px');
            } else {
                height.css('height', '176px');
                $(this).html('read more  <i class="fad fa-chevron-down"></i> ');
            }
        });
    }

    previewPhoto() {
        $(".attach-photo").change(function() {
            let previewer = $(this).attr('previewer');
            $(this)[0].files[0];
            $("."+previewer).css('background-image',  'url('+URL.createObjectURL($(this)[0].files[0])+')' );
        });
    }

    miniCarouselControls() {
        $(".mini-carouse-control").click(function() {
            const carousel  =  $(this).data("carousel");
            let direction   =  $(this).data("carousel-direction");
            let width       =  $('#'+carousel).find('div:first').css('width');
            direction       =  (direction == 'left') ? '-': '+';
            $("#"+carousel).animate({scrollLeft: direction+'='+width });
        });
    }


}

