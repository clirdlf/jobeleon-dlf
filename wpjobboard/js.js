jQuery(function($) {
    
    if($(".wpjb-date-picker").length == 0) {
        return;
    }
    
    $(".wpjb-date-picker").DatePicker({
        format:'Y/m/d',
        date: "",
        current: "",
        starts: 1,
        position: 'l',
        onBeforeShow: function(param){
            $(this).addClass(param.id);
            var v = $(this).val();
            if(v.length > 0) {
                $(this).DatePickerSetDate(v, true);
            }
        },
        onChange: function(formated, dates){
            if($("#"+this.id+" tbody.datepickerDays").is(":visible")) {
                $("."+this.id).attr("value", formated).DatePickerHide();
            } 
            
            
        }
    });
});

jQuery(function($) {
    
    if(! $.isFunction($.fn.selectList)) {
        return;
    }
    
    $(".daq-multiselect").selectList({
        sort: false,
        template: '<li class="wpjb-upload-item">%text%</li>',
        onAdd: function (select, value, text) {

            if(value.length == 0) {
                $(select).parent().find(".selectlist-item:last-child")
                .css("display", "none")
                .click();
            }
            
            $(select).next().val("");
        }
    });
    $(".daq-multiselect").each(function(index, item) {
        if($(item).find("option[selected=selected]").length == 0) {
            $(item).prepend('<option value="" selected="selected"> </option>');
        }
    });
});

Wpjb = {
    State: null,
    LogoImg: null,
    Lang: {},
    Listing: [],
    ListingId: null,
    Discount: null,
    AjaxRequest: null,

    calculate: function() {
        return;
        var listing = null;
        var id = Wpjb.ListingId;
        for(var i in Wpjb.Listing) {
            if(Wpjb.Listing[i].id == id) {
                listing = Wpjb.Listing[i];
                break;
            }
        }

        var discount = "0.00";
        var total = listing.price;
        if(Wpjb.Discount) {
            if(Wpjb.Discount.type == 2) {
                if(Wpjb.Discount.currency != listing.currency) {
                    alert(Wpjb.Lang.CurrencyMismatch);
                } else {
                    discount = Wpjb.Discount.discount;
                    total -= discount;
                }
            } else {
                discount = Wpjb.Discount.discount*listing.price/100;
                total -= discount;
            }
        }

        if(total < 0) {
            total = 0;
        }

        var symbol = listing.symbol;
        var price = new Number(listing.price);
        jQuery("#wpjb_listing_cost").html(symbol+price.toFixed(2));
        discount = new Number(discount);
        jQuery("#wpjb_listing_discount").html(symbol+discount.toFixed(2));
        total = new Number(total);
        jQuery("#wpjb_listing_total").html(symbol+total.toFixed(2));
    }
};

(function($) {
    $.fn.wpjb_menu = function(options) {

        // merge default options with user options
        var settings = $.extend({
            position: "left",
            classes: "wpjb-dropdown wpjb-dropdown-shadow",
            postfix: "-menu"
        }, options);

        return this.each(function() {

            var menu = $(this);
            var img = menu.find("img");
            var ul = menu.find("ul");

            //var id = $(this).attr("id");
            var menuId = ul.attr("id");

            $("html").click(function() {
                $("#"+menuId).hide();
                $("#"+menuId+"-img").removeClass("wpjb-dropdown-open");
            });
            
            ul.find("li a").hover(function() {
                $(this).addClass("wpjb-hover");
            }, function() {
                $(this).removeClass("wpjb-hover");
            });

            ul.hide();
            $(this).after(ul);
            $(this).click(function(e) {
                var dd = $("#"+menuId);
                var visible = dd.is(":visible");
                dd.css("position", "absolute");
                dd.css("margin", "0");
                dd.css("padding", "0");

                $("html").click();
                
                img.addClass("wpjb-dropdown-open");

                var parent = $(this).position();
                var parent_width = $(this).width();

                //dd.css("top", parent.top+$(this).height());

                if(settings.position == "left") {
                    dd.css("left", parent.left);
                } else {
                    dd.show();
                    dd.css("left", parent.left+parent_width-dd.width());
                }

                if(visible) {
                    dd.hide();
                } else {
                    dd.show();
                }

                e.stopPropagation();
                e.preventDefault();
            });
        });


    }
})(jQuery);

jQuery(function($) {
    
    var WpjbDiscount = null;
    
    function wpjb_price_calc() {
        var coupon = $("#coupon");
        var data = {
            action: "wpjb_main_coupon",
            code: coupon.val(),
            id: WpjbListing["id"+$(".wpjb-listing-type-input:checked").val()].id
        };
        
        $("table#wpjb_pricing").css("opacity", "0.3");
        
        if(coupon.length == 0 || coupon.val().length == 0) {
            $("#wpjb-discount-check-result").remove();
            WpjbDiscount = null;
            wpjb_step_add_calc();
            return;
        }
        
        $.getJSON(ajaxurl, data, function(response) {
            WpjbDiscount = response;
            
            $("#wpjb-discount-check-result").remove();
            
            var span = $("<span></span>");
            span.attr("id", "wpjb-discount-check-result");
            if(response.result == 1) {
                span.css("color", "green");
            } else {
                span.css("color", "red");
            }
            
            span.css("display", "block");
            span.text(response.msg);
             
            $("#coupon").after(span);
             
            wpjb_step_add_calc();
        });
        
    }
    
    $("#coupon").blur(wpjb_price_calc);
    
    function wpjb_step_add_calc() {
        
        var l = WpjbListing["id"+$(".wpjb-listing-type-input:checked").val()];
        
        $("#wpjb-listing-cost").text(l.price);
        $("#wpjb-listing-discount").text("-");
        $("#wpjb-listing-total").text(l.price);
        
        if(WpjbDiscount) {
            $("#wpjb-listing-discount").text(WpjbDiscount.discount);
            $("#wpjb-listing-total").text(WpjbDiscount.total);
        }
        
        $("table#wpjb_pricing").css("opacity", "1");
    }
    
    $(".wpjb-page-add .wpjb-listing-type-input").click(function() {
        wpjb_price_calc();
    });
    $(".wpjb-page-add .wpjb-listing-type-input:checked").click();
});

jQuery(function() {

    if(jQuery("input#protection")) {
        jQuery("input#protection").attr("value", WpjbData.Protection);
    }

    if(jQuery(".wpjb_apply_form")) {
        var hd = jQuery('<input type="hidden" />');
        hd.attr("name", "protection");
        hd.attr("value", WpjbData.Protection);
        jQuery(".wpjb_apply_form").append(hd);
    }
});

jQuery(function() {
    
    var autoClear = jQuery("input.wpjb-auto-clear");
    
    autoClear.each(function(index, item) {
        var input = jQuery(item);
        input.attr("autocomplete", "off");
        input.attr("wpjbdef", input.val());
        input.addClass("wpjb-ac-enabled");
    });
    
    autoClear.keydown(function() {
        jQuery(this).removeClass("wpjb-ac-enabled");
    });
    
    autoClear.focus(function() {
        var input = jQuery(this);
        
        if(input.val() == input.attr("wpjbdef")) {
            input.val("");
            input.addClass("wpjb-ac-enabled");
        }
        
    });
    
    autoClear.blur(function() {
        var input = jQuery(this);
        input.removeClass("wpjb-ac-enabled");
        
        if(input.val() == "") {
            input.val(input.attr("wpjbdef"));
            input.addClass("wpjb-ac-enabled");
        }
    });
    
    autoClear.closest("form").submit(function() {
        autoClear.unbind("click");
        if(autoClear.val() == autoClear.attr("wpjbdef")) {
            autoClear.val("");
        }
    });

});

jQuery(function($) {
    $(".wpjb-form-toggle").click(function(event) {
        var id = $(this).data("wpjb-form");
        $(this).find(".wpjb-slide-icon").toggleClass("wpjb-slide-up");
        $("#"+id).slideToggle("fast");
        return false;
    });
    $(".wpjb-slide-icon").removeClass("wpjb-none");
});

jQuery(function($) {
    $(".wpjb-subscribe").click(function() {

        $("#wpjb-overlay").show();
        
        $("#wpjb-overlay").css("height", $(document).height());
        $("#wpjb-overlay").css("width", $(document).width());
        
        var c = $("#wpjb-overlay > div");
        c.css("position","absolute");
        c.css("top", Math.max(0, (($(window).height() - c.outerHeight()) / 2) + $(window).scrollTop()) + "px");
        c.css("left", Math.max(0, (($(window).width() - c.outerWidth()) / 2) +  $(window).scrollLeft()) + "px");
        
        return false;
    });
    
    $(".wpjb-overlay-close").click(function() {
        $(this).closest(".wpjb-overlay").hide();
        return false;
    });
    $(".wpjb-overlay").click(function() {
        $(this).hide();
        return false;
    });
    $(".wpjb-overlay > div").click(function(e) {
        e.stopPropagation();
    });
    $(".wpjb-subscribe-save").click(function() {
        
        var data = {
            action: "wpjb_main_subscribe",
            email: $("#wpjb-subscribe-email").val(),
            frequency: $(".wpjb-subscribe-frequency:checked").val(),
            criteria: WPJB_SEARCH_CRITERIA
        };
        
        $(".wpjb-subscribe-save").hide();
        $(".wpjb-subscribe-load").show();
        
        $.post(ajaxurl, data, function(response) {
            
            $(".wpjb-subscribe-load").hide();
            
            var span = $(".wpjb-subscribe-result");
            
            span.css("display", "block");
            span.text(response.msg);
            span.removeClass("wpjb-subscribe-success");
            span.removeClass("wpjb-subscribe-fail");
            
            if(response.result == "1") {
                span.addClass("wpjb-subscribe-success");
                $("#wpjb-subscribe-email").hide();
            } else {
                span.addClass("wpjb-subscribe-fail"); 
                $(".wpjb-subscribe-save").show();
                
            }
        }, "json");
        
        return false;
    });
});

jQuery(function($) {
    
    function wpjb_ls_jobs_init() {
        $(".wpjb-ls-item").click(function() {
            $("#wpjb-jobs-list").opacity(0.5);
        });
    }
    
    function wpjb_ls_jobs() {

    }
});