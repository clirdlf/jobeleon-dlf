
var WpjbXHR = null;

function wpjb_ls_jobs_init() {
                
    var $ = jQuery;
        
    $(".wpjb-ls-query").keyup(function() {
        wpjb_ls_jobs();
    });
    $(".wpjb-ls-category").change(function() {
        $(".wpjb-ls-category-title").html($(this).find("option:selected").text());
        wpjb_ls_jobs();
    });
    $(".wpjb-ls-type").click(function() {
        $(".wpjb-ls-type-main").html($(this).html());
        $(".wpjb-ls-type").removeClass("wpjb-ls-checked");
        $(this).addClass("wpjb-ls-checked");
        wpjb_ls_jobs();
        return false;
    });
    $(".wpjb-ls-type-main").click(function() {
        return false;
    });
                
    $("#wpjb-paginate-links").hide();
                
    wpjb_ls_jobs();
}        
     
function wpjb_ls_jobs(e) {
        
    var $ = jQuery;
        
    if(WpjbXHR) {
        WpjbXHR.abort();
    }
                
    var page = null;
                
    if(typeof e == 'undefined') {
        page = 1;
    } else {
        page = parseInt($(".wpjb-ls-load-more a.btn").data("wpjb-page"));
    }
        
    var data = $.extend({}, WPJB_SEARCH_CRITERIA);
    data.action = "wpjb_jobs_search";
    data.page = page;
    
    WPJB_SEARCH_CRITERIA.filter = "active";
                
    if($(".wpjb-ls-query").val().length > 0) {
        data.query = $(".wpjb-ls-query").val();
        WPJB_SEARCH_CRITERIA.query = data.query;
    }                             
    
    if($(".wpjb-ls-type.wpjb-ls-checked").length > 0) {
        
        data.type = [];
        
        $(".wpjb-ls-type.wpjb-ls-checked").each(function() {
            if($(this).data("wpjb-id") != "0") {
                data.type.push($(this).data("wpjb-id"));
                WPJB_SEARCH_CRITERIA.type = data.type;
            }
        });
    }
    
    if($(".wpjb-ls-category").length && $(".wpjb-ls-category").val().length > 0) {
        data.category = $(".wpjb-ls-category").val();
        WPJB_SEARCH_CRITERIA.category = data.category;
    }
                
    $("#wpjb-job-list").css("opacity", "0.4");
                
    WpjbXHR = $.ajax({
        type: "POST",
        data: data,
        url: ajaxurl,
        dataType: "json",
        success: function(response) {
                        
            var total = parseInt(response.total);
            var nextPage = parseInt(response.page)+1;
            var perPage = parseInt(response.perPage);
            var loaded = 0;
                                
            $(".wpjb-subscribe-rss input[name=feed]").val(response.url.feed);
            $(".wpjb-subscribe-rss a.wpjb-button.btn").attr("href", response.url.feed);
                                
            if(total == 0) {
                $("#wpjb-job-list tbody").html('<tr><td colspan="3">'+WpjbLiveSearchLocale.no_jobs_found+'</td></tr>');
                return;
            }
                                
            var more = perPage;
                                
            if(nextPage == 2) {
                $("#wpjb-job-list tbody").empty();
            }
                        
            $("#wpjb-job-list tr.wpjb-ls-load-more").remove();
            $("#wpjb-job-list").css("opacity", "1");
            $("#wpjb-job-list tbody").append(response.html);
                                
            loaded = $("#wpjb-job-list tr").length;
                                
            var delta = total-loaded;
                                
            if(delta > perPage) {
                more = perPage;
            } else if(delta > 0) {
                more = delta;
            } else {
                more = 0;
            }
                                
            if(more) {
                var txt = WpjbLiveSearchLocale.load_x_more.replace("%d", more);
                $("#wpjb-job-list tbody").append('<tr class="wpjb-ls-load-more"><td colspan="3"><a href="#" data-wpjb-page="'+(nextPage)+'" class="btn">'+txt+'</a></td></tr>');
                $("#wpjb-job-list tr.wpjb-ls-load-more a").click(wpjb_ls_jobs);
            }
                                
        }
    });
                
    return false;
}
        
        
function wpjb_ls_resumes_init() {
                
    var $ = jQuery;
        
    $(".wpjb-ls-query").keyup(function() {
        wpjb_ls_resumes();
    });
    $(".wpjb-ls-category").change(function() {
        $(".wpjb-ls-category-title").html($(this).find("option:selected").text());
        wpjb_ls_resumes();
    });
                
    $("#wpjb-paginate-links").hide();
                
    wpjb_ls_resumes();
}

function wpjb_ls_resumes(e) {
        
    var $ = jQuery;
        
    if(WpjbXHR) {
        WpjbXHR.abort();
    }
                
    var page = null;
                
    if(typeof e == 'undefined') {
        page = 1;
    } else {
        page = parseInt($(".wpjb-ls-load-more a.btn").data("wpjb-page"));
    }
        
    var data = {
        action: "wpjb_resumes_search",
        page: page
    }
                
    if($(".wpjb-ls-query").val().length > 0) {
        data.query = $(".wpjb-ls-query").val();
    }                
    if(parseInt($(".wpjb-ls-category").val()) > 0) {
        data.category = parseInt($(".wpjb-ls-category").val());
    }                
                
    $("#wpjb-resume-list").css("opacity", "0.4");
                
    WpjbXHR = $.ajax({
        type: "POST",
        data: data,
        url: ajaxurl,
        dataType: "json",
        success: function(response) {
                        
            var total = parseInt(response.total);
            var nextPage = parseInt(response.page)+1;
            var perPage = parseInt(response.perPage);
            var loaded = 0;
                                
            if(total == 0) {
                $("#wpjb-resume-list").html('<tr><td colspan="3">'+WpjbLiveSearchLocale.no_resumes_found+'</td></tr>');
                return;
            }
                                
            var more = perPage;
                                
            if(nextPage == 2) {
                $("#wpjb-resume-list tbody").empty();
            }
                        
            $("#wpjb-resume-list tr.wpjb-ls-load-more").remove();
            $("#wpjb-resume-list").css("opacity", "1");
            $("#wpjb-resume-list tbody").append(response.html);
                                
            loaded = $("#wpjb-resume-list tr").length;
                                
            var delta = total-loaded;
                                
            if(delta > perPage) {
                more = perPage;
            } else if(delta > 0) {
                more = delta;
            } else {
                more = 0;
            }
                                
            if(more) {
                var txt = WpjbLiveSearchLocale.load_x_more.replace("%d", more);
                $("#wpjb-resume-list tbody").append('<tr class="wpjb-ls-load-more"><td colspan="3"><a href="#" data-wpjb-page="'+(nextPage)+'" class="btn">'+txt+'</a></td></tr>');
                $("#wpjb-resume-list tr.wpjb-ls-load-more a").click(wpjb_ls_resumes);
            }
                                
        }
    });
                
    return false;
}