jQuery(document).ready( function($) {
    
    // get fancybox ready
    // Initialization values for fancy box	
    $(".fancybox").fancybox({
	width : 790,
	height : 460,
	closeClick : false,
	openEffect : 'fade',
	closeEffect : 'fade',
	scrolling : 'no',
	autoSize: false,
	autoCenter: false,
	fitToView: true,
	beforeShow: function () {
	    if (this.title) {
	        this.title += '<div id="doit"></div>';
	    }       
	},
	afterShow: function(e) {
	    
	    // Render tweet button and facebook buttons
	    document.getElementById("doit").innerHTML = '<p /><div id="moveit"><iframe src="//www.facebook.com/plugins/like.php?href=' + pageURL + '&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=143293702457868" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;"></iframe>  <a href="javascript:void(0)" onclick="window.open(\'http://www.facebook.com/sharer/sharer.php?u=' +  pageURL + '\',\'share_window\',\'width=700,height=400\')"><img alt="share button" src="/wp-content/plugins/baeblemusic/includes/images/share.png" /></a></div>';
	},
    });
	
    //// Initialization block - start
    
    // Hide the buttons - trending
    $("#driver").hide("fast");
    $("#driver2").hide("fast");
    
    // Hide the buttons - newest
    $("#driver_newest").hide("fast");
    $("#driver2_newest").hide("fast");
    
    // Hid the buttons - concerts
    $("#driver_concerts").hide("fast");
    $("#driver2_concerts").hide("fast");
    
    // Hide the buttons - sessions
    $("#driver_sessions").hide("fast");
    $("#driver2_sessions").hide("fast");
    
    // Hide the buttons - interviews
    $("#driver_interviews").hide("fast");
    $("#driver2_interviews").hide("fast");
    
    // Hide the buttons - Music Videos
    $("#driver_music").hide("fast");
    $("#driver2_music").hide("fast");
    
    // alert(testvariable.name);
    // alert(tiles.length);

    // let's get the first results for trending	    
    var data = {
        action: 'test_response',
        post_var: 'trending',
	page_state: testvariable.name
    };
	
    // the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
    $.post(the_ajax_script.ajaxurl, data, function(response) {
	
        // change the DIV here to the response value
        $('#display_trending').html(response);
        $(".roll").css("opacity","0");
	
	// lets make sure the buttons are in the right place
	
	if (tiles.length == 5) {
	    $('#driver').css({"left":896});
	    $('#driver2').css({"left":846});
	} else if (tiles.length == 4) {
	    $('#driver').css({"left":723});
	    $('#driver2').css({"left":673});
	} else if (tiles.length == 3) {
	    $('#driver').css({"left":550});
	    $('#driver2').css({"left":500});
	} else if (tiles.length == 2) {
	    $('#driver').css({"left":377});
	    $('#driver2').css({"left":327});
	} else if (tiles.length == 1) {
	    $('#driver').css({"left":204});
	    $('#driver2').css({"left":154});
	}
	
        // hover functions
        $(".roll").hover(function () {
            // SET OPACITY TO 70%
            $(this).stop().animate({
                opacity: .7
            }, "slow");
        }, function () {
	    // SET OPACITY BACK TO 50%
	    $(this).stop().animate({
		opacity: 0
	    }, "slow");
	});
		
	// Trending - current set of results
	var current_page = $('#current_page').attr('value');
	if (current_page == 0) {
	    $("#driver2").hide("fast");  
        }
	 // show the first button - trending
	$("#driver").show("fast");
	
    });
    
    
     // let's get the first results for newest
    var data = {
        action: 'test_response',
        post_var: 'newest',
	page_state: testvariable.name
    };
    
    $.post(the_ajax_script.ajaxurl, data, function(response) {
	// change the DIV here to the response value
        $('#display_newest').html(response);
        $(".roll").css("opacity","0");
	
	if (tiles.length == 5) {
	    $('#driver_newest').css({"left":896});
	    $('#driver2_newest').css({"left":846});
	} else if (tiles.length == 4) {
	    $('#driver_newest').css({"left":723});
	    $('#driver2_newest').css({"left":673});
	} else if (tiles.length == 3) {
	    $('#driver_newest').css({"left":550});
	    $('#driver2_newest').css({"left":500});
	} else if (tiles.length == 2) {
	    $('#driver_newest').css({"left":377});
	    $('#driver2_newest').css({"left":327});
	} else if (tiles.length == 1) {
	    $('#driver_newest').css({"left":204});
	    $('#driver2_newest').css({"left":154});
	}

	
	// hover functions
        $(".roll").hover(function () {
            // SET OPACITY TO 70%
            $(this).stop().animate({
                opacity: .7
            }, "slow");
        }, function () {
	    // SET OPACITY BACK TO 50%
	    $(this).stop().animate({
		opacity: 0
	    }, "slow");
	});
	// Newest - current set of results
	var current_page_newest = $('#current_page_newest').attr('value');
	if (current_page_newest == 0) {
	    $("#driver2_newest").hide("fast");  
        }
        // show the first button - newest
        $("#driver_newest").show("fast");
    
    });
    
    // let's get the first results for concerts
    var data = {
        action: 'test_response',
        post_var: 'concerts',
	page_state: testvariable.name
    };
    
    
    
    
    $.post(the_ajax_script.ajaxurl, data, function(response) {
	// change the DIV here to the response value
        $('#display_concerts').html(response);
        $(".roll").css("opacity","0");
	
	if (tiles.length == 5) {
	    $('#driver_concerts').css({"left":896});
	    $('#driver2_concerts').css({"left":846});
	} else if (tiles.length == 4) {
	    $('#driver_concerts').css({"left":723});
	    $('#driver2_concerts').css({"left":673});
	} else if (tiles.length == 3) {
	    $('#driver_concerts').css({"left":550});
	    $('#driver2_concerts').css({"left":500});
	} else if (tiles.length == 2) {
	    $('#driver_concerts').css({"left":377});
	    $('#driver2_concerts').css({"left":327});
	} else if (tiles.length == 1) {
	    $('#driver_concerts').css({"left":204});
	    $('#driver2_concerts').css({"left":154});
	}

	// hover functions
        $(".roll").hover(function () {
            // SET OPACITY TO 70%
            $(this).stop().animate({
                opacity: .7
            }, "slow");
        }, function () {
	    // SET OPACITY BACK TO 50%
	    $(this).stop().animate({
		opacity: 0
	    }, "slow");
	});
	// Concerts - current set of results
	var current_page_concerts = $('#current_page_concerts').attr('value');
	if (current_page_concerts == 0) {
	    $("#driver2_concerts").hide("fast");  
        }
        // show the first button - concerts
        $("#driver_concerts").show("fast");

    });
    
    // let's get the first results for sessions
     var data = {
        action: 'test_response',
        post_var: 'sessions',
	page_state: testvariable.name
    };
    
    $.post(the_ajax_script.ajaxurl, data, function(response) {
	// change the DIV here to the response value
	 $('#display_sessions').html(response);
	 $(".roll").css("opacity","0");
	 
	if (tiles.length == 5) {
	    $('#driver_sessions').css({"left":896});
	    $('#driver2_sessions').css({"left":846});
	} else if (tiles.length == 4) {
	    $('#driver_sessions').css({"left":723});
	    $('#driver2_sessions').css({"left":673});
	} else if (tiles.length == 3) {
	    $('#driver_sessions').css({"left":550});
	    $('#driver2_sessions').css({"left":500});
	} else if (tiles.length == 2) {
	    $('#driver_sessions').css({"left":377});
	    $('#driver2_sessions').css({"left":327});
	} else if (tiles.length == 1) {
	    $('#driver_sessions').css({"left":204});
	    $('#driver2_sessions').css({"left":154});
	}
	 
	 // hover functions
	 $(".roll").hover(function () {
            // SET OPACITY TO 70%
            $(this).stop().animate({
                opacity: .7
            }, "slow");
        }, function () {
	    // SET OPACITY BACK TO 50%
	    $(this).stop().animate({
		opacity: 0
	    }, "slow");
	});
	 
	// Sessions - current set of results
	var current_page_sessions = $('#current_page_sessions').attr('value');
	if (current_page_sessions == 0) {
	    $("#driver2_sessions").hide("fast");  
        }
        // show the first button - sessions
        $("#driver_sessions").show("fast");

    });
    
    // let's get the first results for interviews
    var data = {
        action: 'test_response',
        post_var: 'interviews',
	page_state: testvariable.name
    };
    
    $.post(the_ajax_script.ajaxurl, data, function(response) {
	// change the DIV here to the response value
	$('#display_interviews').html(response);
	$(".roll").css("opacity","0");
	
	if (tiles.length == 5) {
	    $('#driver_interviews').css({"left":896});
	    $('#driver2_interviews').css({"left":846});
	} else if (tiles.length == 4) {
	    $('#driver_interviews').css({"left":723});
	    $('#driver2_interviews').css({"left":673});
	} else if (tiles.length == 3) {
	    $('#driver_interviews').css({"left":550});
	    $('#driver2_interviews').css({"left":500});
	} else if (tiles.length == 2) {
	    $('#driver_interviews').css({"left":377});
	    $('#driver2_interviews').css({"left":327});
	} else if (tiles.length == 1) {
	    $('#driver_interviews').css({"left":204});
	    $('#driver2_interviews').css({"left":154});
	}

	// hover functions
	$(".roll").hover(function () {
	    // SET OPACITY TO 70%
            $(this).stop().animate({
                opacity: .7
            }, "slow");
        }, function () {
	    // SET OPACITY BACK TO 50%
	    $(this).stop().animate({
		opacity: 0
	    }, "slow");
	});
	// interviews - current set of results
	var current_page_interviews = $('#current_page_interviews').attr('value');
	if (current_page_interviews == 0) {
	    $("#driver2_interviews").hide("fast");  
        }
	// show the first button - interviews
        $("#driver_interviews").show("fast");

	
    });
    
    // let's get the first results for music videos
    var data = {
	action: 'test_response',
	post_var: 'music',
	page_state: testvariable.name
    };
    
    $.post(the_ajax_script.ajaxurl, data, function(response) {
	// change the DIV here to the response value
	$('#display_music').html(response);
	$(".roll").css("opacity","0");
	if (tiles.length == 5) {
	    $('#driver_music').css({"left":896});
	    $('#driver2_music').css({"left":846});
	} else if (tiles.length == 4) {
	    $('#driver_music').css({"left":723});
	    $('#driver2_music').css({"left":673});
	} else if (tiles.length == 3) {
	    $('#driver_music').css({"left":550});
	    $('#driver2_music').css({"left":500});
	} else if (tiles.length == 2) {
	    $('#driver_music').css({"left":377});
	    $('#driver2_music').css({"left":327});
	} else if (tiles.length == 1) {
	    $('#driver_music').css({"left":204});
	    $('#driver2_music').css({"left":154});
	}
	
	// hover functions
	$(".roll").hover(function () {
	    // SET OPACITY TO 70%
            $(this).stop().animate({
                opacity: .7
            }, "slow");
	}, function () {
	    // SET OPACITY BACK TO 50%
	    $(this).stop().animate({
		opacity: 0
	    }, "slow");
	});
	// music - current set of results
	var current_page_music = $('#current_page_music').attr('value');
	if (current_page_music == 0) {
	    $("#driver2_music").hide("fast");  
        }
	// show the first button - music videos
	$("#driver_music").show("fast");

    });
    // Initialization block - stop
    
	
    // Create on click events
    
    // Trending - Next
    $("#driver").click(function(event){
        var current_page = $('#current_page').attr('value');
        current_page++;
        $('#current_page').val(current_page);
        var data = {
	    action: 'test_response',
	    post_var: 'trending',
	    current_page: current_page,
	    page_state: testvariable.name
	};
	
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	
	    // change the DIV here to the response value
	    $('#display_trending').html(response);
	    if (current_page == 0) {
		$("#driver2").hide("fast");  
	    } else {
	        $("#driver2").show("fast");     
	    }
	
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
            
		// SET OPACITY TO 70%
		$(this).stop().animate({
		    opacity: .7
		}, "slow");
	    },
            
	    // ON MOUSE OUT
	    function () {
	    
	        // SET OPACITY BACK TO 50%
	        $(this).stop().animate({
			opacity: 0
	        }, "slow");
	    });
	});
    });
	
    // Trending - Previous
    $("#driver2").click(function(event){
	var current_page = $('#current_page').attr('value');
	current_page--;
	$('#current_page').val(current_page);
	var data = {
	    action: 'test_response',
            post_var: 'trending',
	    current_page: current_page,
	    page_state: testvariable.name
	};
	
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    $('#display_trending').html(response);    
	    if (current_page == 0) {
	        $("#driver2").hide("fast");  
	    } else {
	        $("#driver2").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
	    // SET OPACITY TO 70%
	        $(this).stop().animate({
		    opacity: .7
                }, "slow");
            },
                
	    // ON MOUSE OUT
            function () {
		// SET OPACITY BACK TO 50%
		$(this).stop().animate({
		    opacity: 0
		}, "slow");
            });
	});    
    });
    
    // Newest - Next
    $("#driver_newest").click(function(event){
        var current_page_newest = $('#current_page_newest').attr('value');
        current_page_newest++;
        $('#current_page_newest').val(current_page_newest);
        var data = {
	    action: 'test_response',
	    post_var: 'newest',
	    current_page_newest: current_page_newest,
	    page_state: testvariable.name
	};
	
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	
	    // change the DIV here to the response value
	    $('#display_newest').html(response);
	    if (current_page_newest == 0) {
		$("#driver2_newest").hide("fast");  
	    } else {
	        $("#driver2_newest").show("fast");     
	    }
	
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
            
		// SET OPACITY TO 70%
		$(this).stop().animate({
		    opacity: .7
		}, "slow");
	    },
            
	    // ON MOUSE OUT
	    function () {
	    
	        // SET OPACITY BACK TO 50%
	        $(this).stop().animate({
			opacity: 0
	        }, "slow");
	    });
	});
    });
    
    // Newest - Previous
    $("#driver2_newest").click(function(event){
	var current_page_newest = $('#current_page_newest').attr('value');
	current_page_newest--;
	$('#current_page_newest').val(current_page_newest);
	var data = {
	    action: 'test_response',
            post_var: 'newest',
	    current_page_newest: current_page_newest,
	    page_state: testvariable.name
	};
	
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    $('#display_newest').html(response);    
	    if (current_page_newest == 0) {
	        $("#driver2_newest").hide("fast");  
	    } else {
	        $("#driver2_newest").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
	    // SET OPACITY TO 70%
	        $(this).stop().animate({
		    opacity: .7
                }, "slow");
            },
                
	    // ON MOUSE OUT
            function () {
		// SET OPACITY BACK TO 50%
		$(this).stop().animate({
		    opacity: 0
		}, "slow");
            });
	});    
    });
    // Concerts - Next
    $("#driver_concerts").click(function(event){
	var current_page_concerts = $('#current_page_concerts').attr('value');
        current_page_concerts++;
        $('#current_page_concerts').val(current_page_concerts);
	var data = {
	    action: 'test_response',
	    post_var: 'concerts',
	    current_page_concerts: current_page_concerts,
	    page_state: testvariable.name
	};
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    // change the DIV here to the response value
	    $('#display_concerts').html(response);
	    if (current_page_concerts == 0) {
		$("#driver2_concerts").hide("fast");  
	    } else {
	        $("#driver2_concerts").show("fast");     
	    }
	    
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
            
		// SET OPACITY TO 70%
		$(this).stop().animate({
		    opacity: .7
		}, "slow");
	    },
	    
	    // ON MOUSE OUT
	    function () {
	    
	        // SET OPACITY BACK TO 50%
	        $(this).stop().animate({
			opacity: 0
	        }, "slow");
	    });
	});
    });
    
    // Concerts - Previous
    $("#driver2_concerts").click(function(event){
	var current_page_concerts = $('#current_page_concerts').attr('value');
	current_page_concerts--;
	$('#current_page_concerts').val(current_page_concerts);
	var data = {
	    action: 'test_response',
            post_var: 'concerts',
	    current_page_concerts: current_page_concerts,
	    page_state: testvariable.name
	};
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    $('#display_concerts').html(response);    
	    if (current_page_concerts == 0) {
	        $("#driver2_concerts").hide("fast");  
	    } else {
	        $("#driver2_concerts").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
	    // SET OPACITY TO 70%
	        $(this).stop().animate({
		    opacity: .7
                }, "slow");
            },
	    
	    // ON MOUSE OUT
            function () {
		// SET OPACITY BACK TO 50%
		$(this).stop().animate({
		    opacity: 0
		}, "slow");
            });
	});    
    });
	
    // Sessions - Next
    $("#driver_sessions").click(function(event){
	var current_page_sessions = $('#current_page_sessions').attr('value');
	current_page_sessions++;
        $('#current_page_sessions').val(current_page_sessions);
	var data = {
	    action: 'test_response',
	    post_var: 'sessions',
	    current_page_sessions: current_page_sessions,
	    page_state: testvariable.name
	};
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	     // change the DIV here to the response value
	    $('#display_sessions').html(response);
	    if (current_page_sessions == 0) {
		$("#driver2_sessions").hide("fast");  
	    } else {
	        $("#driver2_sessions").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
            
		// SET OPACITY TO 70%
		$(this).stop().animate({
		    opacity: .7
		}, "slow");
	    },
	    
	    // ON MOUSE OUT
	    function () {
	    
	        // SET OPACITY BACK TO 50%
	        $(this).stop().animate({
			opacity: 0
	        }, "slow");
	    });
	});
    });
    
    // Sessions - Previous
    $("#driver2_sessions").click(function(event){
	var current_page_sessions = $('#current_page_sessions').attr('value');
	current_page_sessions--;
	$('#current_page_sessions').val(current_page_sessions);
	var data = {
	    action: 'test_response',
            post_var: 'sessions',
	    current_page_sessions: current_page_sessions,
	    page_state: testvariable.name
	};
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    $('#display_sessions').html(response);
	    if (current_page_sessions == 0) {
	        $("#driver2_sessions").hide("fast");  
	    } else {
	        $("#driver2_sessions").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
	    // SET OPACITY TO 70%
	        $(this).stop().animate({
		    opacity: .7
                }, "slow");
            },
	    // ON MOUSE OUT
            function () {
		// SET OPACITY BACK TO 50%
		$(this).stop().animate({
		    opacity: 0
		}, "slow");
            });
	});    
    });
    
    // Interviews - Next
    $("#driver_interviews").click(function(event){
	var current_page_interviews = $('#current_page_interviews').attr('value');
	current_page_interviews++;
	 $('#current_page_interviews').val(current_page_interviews);
	 var data = {
	    action: 'test_response',
	    post_var: 'interviews',
	    current_page_interviews: current_page_interviews,
	    page_state: testvariable.name
	};
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    // change the DIV here to the response value
	    $('#display_interviews').html(response);
	    if (current_page_interviews == 0) {
		$("#driver2_interviews").hide("fast");  
	    } else {
		$("#driver2_interviews").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
            
		// SET OPACITY TO 70%
		$(this).stop().animate({
		    opacity: .7
		}, "slow");
	    },
	    
	    // ON MOUSE OUT
	    function () {
	    
	        // SET OPACITY BACK TO 50%
	        $(this).stop().animate({
			opacity: 0
	        }, "slow");
	    });
	});
    });
   
    // Interviews - Previous
    $("#driver2_interviews").click(function(event){
	var current_page_interviews = $('#current_page_interviews').attr('value');
	current_page_interviews--;
	$('#current_page_interviews').val(current_page_interviews);
	var data = {
	    action: 'test_response',
	    post_var: 'interviews',
	    current_page_interviews: current_page_interviews,
	    page_state: testvariable.name
	};
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    $('#display_interviews').html(response);
	    if (current_page_interviews == 0) {
	        $("#driver2_interviews").hide("fast");  
	    } else {
	        $("#driver2_interviews").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
	    // SET OPACITY TO 70%
	        $(this).stop().animate({
		    opacity: .7
                }, "slow");
            },
	    // ON MOUSE OUT
            function () {
		// SET OPACITY BACK TO 50%
		$(this).stop().animate({
		    opacity: 0
		}, "slow");
            });
	});    
    });
    
    // Music Videos - Next
    $("#driver_music").click(function(event){
	var current_page_music = $('#current_page_music').attr('value');
	current_page_music++;
	$('#current_page_music').val(current_page_music);
	var data = {
	    action: 'test_response',
	    post_var: 'music',
	    current_page_music: current_page_music,
	    page_state: testvariable.name
	};
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    // change the DIV here to the response value
	    $('#display_music').html(response);
	    if (current_page_music == 0) {
		$("#driver2_music").hide("fast");  
	    } else {
		$("#driver2_music").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
            
		// SET OPACITY TO 70%
		$(this).stop().animate({
		    opacity: .7
		}, "slow");
	    },
	    // ON MOUSE OUT
	    function () {
	    
	        // SET OPACITY BACK TO 50%
	        $(this).stop().animate({
			opacity: 0
	        }, "slow");
	    });
	});
    });
    
    // Music Videos - Previous
    $("#driver2_music").click(function(event){
	var current_page_music = $('#current_page_music').attr('value');
	current_page_music--;
	$('#current_page_music').val(current_page_music);
	var data = {
	    action: 'test_response',
	    post_var: 'music',
	    current_page_music: current_page_music,
	    page_state: testvariable.name
	};
	// send the data
	$.post(the_ajax_script.ajaxurl, data, function(response) {
	    $('#display_music').html(response);
	    if (current_page_music == 0) {
	        $("#driver2_music").hide("fast");  
	    } else {
	        $("#driver2_music").show("fast");     
	    }
	    $(".roll").css("opacity","0");
	    $(".roll").hover(function () {
	    // SET OPACITY TO 70%
	        $(this).stop().animate({
		    opacity: .7
                }, "slow");
            },
	    // ON MOUSE OUT
            function () {
		// SET OPACITY BACK TO 50%
		$(this).stop().animate({
		    opacity: 0
		}, "slow");
            });
	});    
    });
    
    
    
});

function setURL(url) {
    pageURL = url;
}
