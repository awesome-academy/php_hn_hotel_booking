/*!
 * betterRating jQuery Plugin
 * Author: @malithmcr
 * Email : malith.priyashan.dev@gmail.com
 * Licensed under the MIT license
 */

/*
    This plugin allow you to create beautiful rating form. already styled.
*/

;(function($){
    $.fn.extend({
        betterRating: function( options ) {
            /**
             * @option : wrapper - rating list wrapper div
             * @option : icon - fontAwesome icon name
             */
            this.defaultOptions = {
                wrapper: '#list',
                icon: 'fa fa-star',
            };
            var settings = $.extend({}, this.defaultOptions, options);
            this.getRating(settings);
            return this.each(function() {
                var $this = $(this);
            });
        },
        getRating: function(settings) {
            var self = this;

            $('.rating i').on('click', function(){
                $('#rating-count').val($(this).data('rate'));
                $(this).parent().find('i:lt(' + ($(this).index() + 1) + ')').addClass('selected');
            });

            $('.rating i').on('mouseover', function(){
                $(this).parent().children('.rating i').each(function(e){
                    $(this).removeClass('selected');
                });
                $(this).parent().find('i:lt(' + ($(this).index() + 1) + ')').addClass('hover');
            }).on('mouseout', function(){
                $(this).parent().children('.rating i').each(function(e){
                    $(this).removeClass('hover');
                });
            });

            $(this).submit(function( event ) {
                event.preventDefault();
                var formData = $(this).serializeArray();
                console.log(formData);

                $('#better-rating-list').append(self.template(formData));
            });

        },

        /** creation of the list template*/
        template: function(data) {
            var rating = '<i class="fa fa-star selected" data-rate="1"></i>';
            for(var i =1; i < data[1].value; i++) {
                rating += '<i class="fa fa-star selected" data-rate="1"></i>';
            }
            var list =
                `<li>
                     <div class="profile-rating-wrapper">
                        <div class="profile-pic"><img src="images/profile_pic.png" alt="" /></div>
                        <div class="name">data[0].value Wrote:</div>
                        <div class="rating">rating</div>
                     </div>
                     <div class="content">
                     <p>data[2].value</p>
           </div>
                </li>`;
            return list;
        }
    });

})(jQuery);
