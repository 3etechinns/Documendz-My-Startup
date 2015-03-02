function just_view() {
    $(document).ready(function() {
        $("#sidebar").removeClass("opened");
        $("#tour").css("display", "none");
        $("#clear-all-history").css("display", "none");
        $("#save-button").css("display", "none");
        $("#page_no").css("display", "none");
        $("#page-text").css("display", "none");
        $("#page-down").css("display", "none");
        $("#page-up").css("display", "none")
    })
}
var key = key_check;
if (parseInt(key) == 0) {
    just_view()
} else {
    var comm_del = 0;
    $(window).unload(function() {
        var e;
        if (window.XMLHttpRequest) {
            e = new XMLHttpRequest
        } else if (window.ActiveXObject) {
            e = new ActiveXObject("Msxml2.XMLHTTP")
        } else {
            throw new Error("Ajax is not supported by this browser")
        }
        e.onreadystatechange = function() {
            if (e.readyState == 4 && e.status == 200) {}
        };
        e.open("POST", "../../open_file_access.php?token=" + shared_id, false);
        e.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        e.send()
    });

    function setSelection(e, t) {
        if (document.createRange) {
            var n = document.createRange();
            c = window.getSelection();
            n.selectNodeContents(e);
            if (t) {
                n.collapse(false)
            }
            c.removeAllRanges();
            c.addRange(n)
        } else {
            if (document.body.createTextRange) {
                var n = document.body.createTextRange();
                n.moveToElementText(e);
                if (t) {
                    n.collapse(false)
                }
                n.select()
            }
        }
    }

    function clear_all_history() {
        $("#svg-container > .handle").remove();
        $("#svg_id > path").remove();
        var e = $("#history li");
        e.each(function() {
            var e = $("." + $(this).attr("class") + " > #anno_type > b")[0].innerHTML;
            if (e == "Pin comment" || e == "Text comment") {
                if ($("#comment-container").children().length == 1) {
                    comm_del = 0
                }
                var t = "." + $(this).attr("class");
                $("#svg_id > " + t).remove();
                $("#connector-svg > " + t).remove();
                $("#image-container > " + t).remove();
                $("#svg-container").textHighlighter();
                $("#svg-container").getHighlighter().removeHighlights("." + $(this).attr("class"), $(this).attr("class"));
                delete_commentbox_update_arrays($(t).children(".delete-comment")[0])
            }
            if (e == "Strike" || e == "Highlight") {
                $("#svg-container").textHighlighter();
                $("#svg-container").getHighlighter().removeHighlights("." + $(this).attr("class"), $(this).attr("class"))
            }
        });
        $("#history").empty();
        $.contextMenu("destroy");
        $(".highlight_colors").css("display", "none");
        $(".draw_colors").css("display", "none");
        $("#svg-container").textHighlighter();
        $("#svg-container").getHighlighter().destroy();
        change_sketchpads(0);
        svg_cont_style("text");
        document.getElementById("svg_id").style.pointerEvents = "none";
        $(".clickable").unbind("click");
        $("#svg-container").unbind();
        $("#svg-container").css({
            cursor: "text"
        });
        $("#draw, #strike,#textbox, #highlight, #drop-comment,#drag-comment, #highlight_blue, #highlight_red, #highlight_green, #highlight_yellow, #draw_black, #draw_red, #draw_green, #draw_blue").prop("checked", false);
        click_counter = -1;
        comment_div_id_cnt = -1
    }

    function hideintro() {
        $("#intro-modal").fadeOut("slow");
        $(document).unbind("keyup")
    }

    function displayintro() {
        $("#intro-modal").css("display", "block");
        $("#intro-modal").css("opacity", "0.65");
        $(document).bind("keyup", function(e) {
            if ($("#intro-modal").css("display") == "block" && e.keyCode == 27) {
                hideintro()
            }
        })
    }

    function check_empty_commentbox(e) {
        $(".comment-box").each(function() {
            if ($.trim($(this).children("li:last").children(".comment-text").text()).length == 0) {
                if ($(this).children("li").length == 1) {
                    var e = "." + $(this).attr("class").split(" ")[1];
                    $("#svg_id > " + e).remove();
                    $("#connector-svg > " + e).remove();
                    $("#image-container > " + e).remove();
                    $("#history > " + e).remove();
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().removeHighlights(e, $(this).attr("class").split(" ")[1]);
                    if ($("#strike").is(":checked") == true || $("#highlight").is(":checked") == true || $("#drag-comment").is(":checked") == true) {} else {
                        $("#svg-container").getHighlighter().destroy()
                    }
                    delete_commentbox_update_arrays($(this).children(".delete-comment")[0]);
                    comm_del = 1
                } else {
                    $(this).children("li:last").remove()
                }
            }
        })
    }

    function update_history(e, t, n) {
        if (t != undefined) {
            if (t.length > 25) {
                t = t.substring(0, 22) + "..."
            }
            $("#history").children("." + e).children("#matter").text(t)
        }
        if (n != undefined) {
            $("#history").children("." + e).children("#other").text("Page: " + n)
        }
    }

    function add_history(e, t, n, r) {
        var i = new Date;
        var s = new Array;
        s[0] = "Jan";
        s[1] = "Feb";
        s[2] = "Mar";
        s[3] = "Apr";
        s[4] = "May";
        s[5] = "Jun";
        s[6] = "Jul";
        s[7] = "Aug";
        s[8] = "Sep";
        s[9] = "Oct";
        s[10] = "Nov";
        s[11] = "Dec";
        var o = s[i.getMonth()];
        var u = i.getDate();
        var a = i.getHours();
        var f = i.getMinutes();
        var l = "  " + o + " " + u + " " + a + ":" + f;
        $("#history").append('<li class="' + e + '">' + '<div id="matter" style="padding-left:1px;margin-right:2px;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;line-height:24px;float:left; top:0px;left: 40px;height:20px;width:95px;font-size: 10pt">' + t + "</div>" + '<div id="anno_type" style="text-align:right;color:#218221;opacity:0.6;font-size:8pt;line-height:23px;width:73px;height:20px;float:left"><b>' + r + "</b></div>" + '<div id="other1" style="line-height:17px;float:left;color:#B2B2B2;top:20px;left:40px; height:15px;width:40px;font-size: 8pt">Page:' + n + " </div>" + '<div id="other2" style="line-height:17px;float:left;color:#B2B2B2;top:20px;height:15px;width:65px;font-size:8pt">' + l + " </div>" + '<div id="other3" style="line-height:17px;color:#B2B2B2;float:left;top:20px;height:15px;width:65px;font-size:8pt; overflow:hidden">' + user + "</div></li>")
    }

    function isNumber(e) {
        e = e ? e : window.event;
        var t = e.which ? e.which : e.keyCode;
        if (t > 31 && (t < 48 || t > 57)) {
            return false
        }
    }

    function random_class_generator() {
        function e() {
            return ((1 + Math.random()) * 65536 | 0).toString(16).substring(1)
        }
        return (e() + "-" + e() + "-" + e() + e() + e()).toLowerCase()
    }

    function svg_cont_style(e) {
        $("#svg-container").css({
            position: "absolute",
            height: "auto",
            left: svg_left("after"),
            cursor: e
        })
    }

    function connector_lines(e, t, n) {
        var r = "http://www.w3.org/2000/svg";
        var i = document.createElementNS(r, "line");
        i.setAttributeNS(null, "x1", "0");
        i.setAttributeNS(null, "y1", e);
        i.setAttributeNS(null, "x2", "27");
        i.setAttributeNS(null, "y2", t);
        i.setAttributeNS(null, "style", "stroke:#99CCFF;stroke-width:1");
        i.setAttributeNS(null, "class", n);
        document.getElementById("connector-svg").appendChild(i)
    }

    function comment_lines(e, t, n, r, i) {
        var s = $(".pf").width();
        var o = "http://www.w3.org/2000/svg";
        var u = document.createElementNS(o, "line");
        u.setAttributeNS(null, "x1", e);
        u.setAttributeNS(null, "y1", t);
        u.setAttributeNS(null, "x2", s);
        u.setAttributeNS(null, "y2", r);
        u.setAttributeNS(null, "style", "stroke:#99CCFF;stroke-width:1");
        u.setAttributeNS(null, "class", i);
        document.getElementById("svg_id").appendChild(u)
    }

    function delete_commentbox_update_arrays(e) {
        if (e != undefined) {
            window.id_to_be_deleted = $(e).parent().attr("id");
            var t = all_click_y_positions.map(function(e, t) {
                return e[1]
            });
            for (j = 0; j < t.length; j++) {
                if (t[j] == id_to_be_deleted) {
                    var n = j;
                    break
                }
            }
            if (n == undefined) {}
            var r = $(e).parent().parent().children().index($(e).parent());
            $(e).parent().remove();
            original_aligned_y.splice(r, 1);
            all_click_y_positions.splice(n, 1);
            if (r > 0) {
                height_change_align_comment_boxes(r - 1)
            } else if (r == 0 && $("#comment-container").children().length > 0) {
                var i = original_aligned_y[0];
                $("#comment-container ul:first-child").css("top", new_top_calculator(i));
                height_change_align_comment_boxes(0);
                $("#connector-svg > ." + $("#comment-container ul:first-child").attr("class").split(" ")[1]).attr("y2", new_top_calculator(i))
            }
        } else {}
    }

    function contextmenu_activate() {
        $(function() {
            $.contextMenu({
                selector: ".highlighted",
                build: function(e, t) {
                    if ($(e[0]).parent().attr("class").split(" ")[0] == "striked") {
                        return {
                            callback: function(e, t) {
                                switch (e) {
                                    case "remove-highlight":
                                        var n = "." + $(this).attr("class").split(" ")[1];
                                        $("#svg-container").getHighlighter().removeHighlights("." + $(this).attr("class").split(" ")[1], $(this).attr("class").split(" ")[1]);
                                        $("#svg_id > " + n).remove();
                                        $("#connector-svg > " + n).remove();
                                        $("#history > " + n).remove();
                                        delete_commentbox_update_arrays($(n).children(".delete-comment")[0]);
                                        if ($("#comment-container").children().length == 0) {
                                            comm_del = 0
                                        }
                                        break;
                                    case "remove-strike":
                                        var r = "." + $(this).parent().attr("class").split(" ")[1];
                                        $("#svg-container").getHighlighter().removeHighlights("." + $(this).parent().attr("class").split(" ")[1], $(this).parent().attr("class").split(" ")[1]);
                                        $("#history > " + r).remove();
                                        break
                                }
                            },
                            items: {
                                "remove-highlight": {
                                    name: "Remove Highlight",
                                    icon: "delete"
                                },
                                "remove-strike": {
                                    name: "Remove Strike",
                                    icon: "delete"
                                }
                            }
                        }
                    } else {
                        return {
                            callback: function(e, t) {
                                var n = "." + $(this).attr("class").split(" ")[1];
                                $("#svg-container").getHighlighter().removeHighlights("." + $(this).attr("class").split(" ")[1], $(this).attr("class").split(" ")[1]);
                                $("#svg_id > " + n).remove();
                                $("#connector-svg > " + n).remove();
                                $("#history > " + n).remove();
                                delete_commentbox_update_arrays($(n).children(".delete-comment")[0]);
                                if ($("#comment-container").children().length == 0) {
                                    comm_del = 0
                                }
                            },
                            items: {
                                "remove-highlight": {
                                    name: "Remove Highlight",
                                    icon: "delete"
                                }
                            }
                        }
                    }
                }
            })
        });
        $(function() {
            $.contextMenu({
                selector: ".striked",
                build: function(e, t) {
                    if ($(e[0]).parent().attr("class").split(" ")[0] == "highlighted") {
                        return {
                            callback: function(e, t) {
                                switch (e) {
                                    case "remove-strike":
                                        var n = "." + $(this).attr("class").split(" ")[1];
                                        $("#svg-container").getHighlighter().removeHighlights("." + $(this).attr("class").split(" ")[1], $(this).attr("class").split(" ")[1]);
                                        $("#history > " + n).remove();
                                        break;
                                    case "remove-highlight":
                                        var r = "." + $(this).parent().attr("class").split(" ")[1];
                                        $("#svg-container").getHighlighter().removeHighlights("." + $(this).parent().attr("class").split(" ")[1], $(this).parent().attr("class").split(" ")[1]);
                                        $("#svg_id > " + r).remove();
                                        $("#connector-svg > " + r).remove();
                                        $("#history > " + r).remove();
                                        delete_commentbox_update_arrays($(r).children(".delete-comment")[0]);
                                        if ($("#comment-container").children().length == 0) {
                                            comm_del = 0
                                        }
                                        break
                                }
                            },
                            items: {
                                "remove-highlight": {
                                    name: "Remove Highlight",
                                    icon: "delete"
                                },
                                "remove-strike": {
                                    name: "Remove Strike",
                                    icon: "delete"
                                }
                            }
                        }
                    } else {
                        return {
                            callback: function(e, t) {
                                var n = "." + $(this).attr("class").split(" ")[1];
                                $("#svg-container").getHighlighter().removeHighlights("." + $(this).attr("class").split(" ")[1], $(this).attr("class").split(" ")[1]);
                                $("#history > " + n).remove()
                            },
                            items: {
                                "remove-strike": {
                                    name: "Remove Strike",
                                    icon: "delete"
                                }
                            }
                        }
                    }
                }
            })
        })
    }

    function drop_contextmenu() {
        $(function() {
            $.contextMenu({
                selector: ".drop-comment",
                callback: function() {
                    var e = "." + $(this).attr("class").split(" ")[1];
                    $("#svg_id > " + e).remove();
                    $("#connector-svg > " + e).remove();
                    $("#image-container >" + e).remove();
                    delete_commentbox_update_arrays($(e).children(".delete-comment")[0]);
                    if ($("#comment-container").children().length == 0) {}
                },
                items: {
                    "remove-comment": {
                        name: "Remove Comment",
                        icon: "delete"
                    }
                }
            })
        })
    }

    function draw_contextmenu() {
        $(function() {
            $.contextMenu({
                selector: ".pathclass",
                callback: function() {
                    var e = "." + $(this).attr("class").split(" ")[1];
                    $("#svg_id " + e).remove();
                    $("#history > " + e).remove()
                },
                items: {
                    "remove-draw": {
                        name: "Remove Path",
                        icon: "delete"
                    }
                }
            })
        })
    }
    $(document).on({
        click: function() {
            if ($.trim($(this).parent().find("li:last > .comment-text").text()) != "") {
                $(this).siblings(".delete-comment").before('<li><span class="critic_name" contenteditable="false">' + user + ':</span><div class="comment-text" contenteditable="true" spellcheck=false></div></li>');
                setSelection($(this).parent().children("li:last").children(".comment-text")[0])
            } else {}
        }
    }, ".comment-reply");
    $(document).on({
        click: function() {
            $("#page-container").scrollTo("#svg-container ." + $(this).attr("class"), 0, {
                offset: -25
            });
            $(".tool").prop("checked", false);
            switch ($("." + $(this).attr("class") + " > #anno_type > b")[0].innerHTML) {
                case "Strike":
                    $("#strike").prop("checked", true);
                    check_value("strike");
                    break;
                case "Highlight":
                    $("#highlight").prop("checked", true);
                    check_value("highlight");
                    break;
                case "Draw":
                    $("#draw").prop("checked", true);
                    check_value("draw");
                    break;
                case "Text box":
                    $("#textbox").prop("checked", true);
                    check_value("textbox");
                    break;
                case "Pin comment":
                    $("#drop-comment").prop("checked", true);
                    check_value("drop-comment");
                    break;
                case "Text comment":
                    $("#drag-comment").prop("checked", true);
                    check_value("drag-comment");
                    break
            }
        }
    }, "#history > li");
    $(document).on({
        mouseover: function() {
            if ($("#draw").is(":checked") == true) {
                $(this).css({
                    cursor: "url(../../images/right-click.cur),default"
                })
            } else {
                $(this).css({
                    cursor: "url(../../images/textbox.cur),default"
                })
            }
        }
    }, ".pathclass");

    function remove_textbox_styles(e) {
        $(document).off("mouseenter mouseleave mouseup mousedown click mouseover", ".handle");
        $(document).off("mouseenter mouseleave click ", ".box");
        $(document).off("mouseenter mouseleave click mouseover", ".delete-text-box");
        $(".handle").find(".delete-text-box").css({
            opacity: "0"
        });
        $(".handle").css("outline", "none");
        $(".handle").css("cursor", function() {
            return e
        });
        $(".handle").draggable();
        $(".handle").draggable("disable");
        $(".box").attr("contenteditable", "false");
        $(".handle").addClass("unselectable")
    }

    function textbox_events() {
        svg_cont_style("url(../../images/textbox.cur),default");
        $(".box").attr("contenteditable", "true");
        $(".handle").removeClass("unselectable");
        $(document).on({
            mouseenter: function() {
                $(this).css("outline", "1px solid #33CCFF");
                $(this).find(".delete-text-box").css({
                    opacity: "0.4"
                })
            },
            mouseleave: function() {
                $(this).find(".delete-text-box").css({
                    opacity: "0"
                });
                if ($(this).find(".box").is(":focus") == false) {
                    $(this).css("outline", "none")
                }
            },
            click: function() {},
            mousedown: function() {
                $(this).css("cursor", "url(../../images/closedhand.cur),auto")
            },
            mouseup: function() {
                $(this).css("cursor", "url(../../images/openhand.cur),auto")
            },
            mouseover: function() {
                $(this).css("cursor", "url(../../images/openhand.cur),auto");
                $(this).draggable({
                    containment: "parent",
                    stop: function() {
                        var e = $(this).offset();
                        var t = e.left;
                        var n = e.top - $("#svg-container").offset().top;
                        var r = Math.ceil(n / (page_height + 13)) > cnt ? cnt : Math.ceil(n / (page_height + 13));
                        update_history($(this).attr("class").split(" ")[2], undefined, r)
                    }
                })
            }
        }, ".handle");
        $(document).on({
            mouseenter: function(e) {
                $(this).css({
                    opacity: "1"
                });
                $(this).siblings(".box").css({
                    opacity: "0.3"
                });
                $(this).parent().css("outline", "1px solid #33CCFF");
                e.stopPropagation()
            },
            mouseleave: function() {
                $(this).css({
                    opacity: "0.4"
                });
                $(this).siblings(".box").css({
                    opacity: "1"
                })
            },
            mouseover: function() {
                $(this).css({
                    cursor: "pointer"
                })
            },
            click: function(e) {
                e.stopPropagation();
                if ($.trim($("#svg-container div.box:last").text()).length === 0) {
                    $("#svg-container div.box:last").parent().remove();
                    fcs = 0
                } else {}
                fcs = 0;
                $("#history > ." + $(this).parent().attr("class").split(" ")[2]).remove();
                $(this).parent().remove()
            }
        }, ".delete-text-box");
        $(document).on({
            mouseenter: function() {
                $(this).css("cursor", "text");
                $(this).parent().draggable("disable")
            },
            mouseleave: function() {
                $(this).parent().draggable("enable")
            },
            click: function() {
                $(".handle").css("outline", "none");
                $(this).parent().css("outline", "1px solid #33CCFF");
                $(".delete-text-box").css("opacity", "0");
                $(this).siblings(".delete-text-box").css("opacity", "0.4")
            }
        }, ".box")
    }

    function call_handle_jquery() {
        $(".handle").css("outline", "none");
        $(".delete-text-box").css("opacity", "0");
        $(".handle").draggable({
            containment: "parent"
        });
        $(".handle").mouseenter(function() {
            $(this).css("outline", "1px solid #33CCFF");
            $(this).find(".delete-text-box").css({
                opacity: "0.4"
            })
        });
        $(".handle").mouseleave(function() {
            $(this).find(".delete-text-box").css({
                opacity: "0"
            });
            if ($(this).find(".box").is(":focus") == false) {
                $(this).css("outline", "none")
            }
        });
        $(".delete-text-box").mouseenter(function() {
            event.stopPropagation();
            $(this).css({
                opacity: "1"
            });
            $(this).siblings(".box").css({
                opacity: "0.3"
            });
            $(this).parent().css("outline", "1px solid #33CCFF")
        });
        $(".delete-text-box").mouseleave(function() {
            $(this).css({
                opacity: "0.4"
            });
            $(this).siblings(".box").css({
                opacity: "1"
            })
        });
        $(".box").mouseenter(function() {
            $(this).css("cursor", "text");
            $(this).parent().draggable("disable")
        });
        $(".box").mouseleave(function() {
            $(this).parent().draggable("enable")
        });
        $(".box").click(function() {
            $(".handle").css("outline", "none");
            $(this).parent().css("outline", "1px solid #33CCFF");
            $(".delete-text-box").css("opacity", "0");
            $(this).siblings(".delete-text-box").css("opacity", "0.4")
        });
        $(".handle").click(function() {});
        $(".delete-text-box").click(function() {
            event.stopPropagation();
            if ($.trim($("#svg-container div.box:last").text()).length === 0) {
                $("#svg-container div.box:last").parent().remove();
                fcs = 0
            } else {}
            fcs = 0;
            $(this).parent().remove()
        })
    }

    function dis() {
        console.log("1");
        document.getElementById("save-button").innerHTML = "Updating";
        console.log("2");
        $("#save-button").prop("disabled", "disabled");
        console.log("3")
    }
    $(document).ready(function() {
        window.original_aligned_y = [];
        all_click_y_positions = [];
        window.click_counter = -1;
        var e = 1;
        var t = $(".pf").length;
        window.page_height = $(".pf").height();
        window.comment_div_id_cnt = -1;
        $("#display-history").click(function() {
            if ($("#history").children().length > 0) {
                $("#history").toggle("fast", function() {
                    if ($("#history").css("display") == "block") {
                        $("#up-pull").css("display", "block");
                        $("#down-drop").css("display", "none")
                    } else if ($("#history").css("display") == "none") {
                        $("#up-pull").css("display", "none");
                        $("#down-drop").css("display", "block")
                    }
                })
            }
        });
        $("#history-container").perfectScrollbar();
        $("#history").bind("DOMNodeInserted", function() {
            if ($("#history").css("display") == "block") {
                $("#up-pull").css("display", "block");
                $("#down-drop").css("display", "none")
            } else if ($("#history").css("display") == "none") {
                $("#up-pull").css("display", "none");
                $("#down-drop").css("display", "block")
            }
            $("#count-history").html($("#history").children().length)
        });
        $("#history").bind("DOMNodeRemoved", function() {
            if ($("#history").children().length - 1 == 0) {
                $("#count-history").html("0");
                $("#down-drop").css("display", "none");
                $("#up-pull").css("display", "none")
            } else {
                $("#count-history").html($("#history").children().length - 1)
            }
        });
        $("#page-up").click(function() {
            if (e > 1) {
                $("#page-container").scrollTo("#" + $("#svg-container > div:nth-child(" + (e - 1) + ")")[0].id)
            }
        });
        $("#page-down").click(function() {
            if (e < t) {
                $("#page-container").scrollTo("#" + $("#svg-container > div:nth-child(" + (e + 1) + ")")[0].id)
            }
        });
        $("#page-container").bind("scroll", function(t) {
            $(".pf").each(function() {
                if ($(this).offset().top < window.pageYOffset + $(window).height() / 2 && $(this).offset().top + $(this).height() > window.pageYOffset + $(window).height() / 2) {
                    $("#page_no")[0].value = $(this).index() + 1;
                    e = $(this).index() + 1
                }
            })
        });
        $("#page_no").keypress(function(n) {
            if (n.keyCode == 13) {
                var r = $(this)[0].value;
                if (r <= t && r > 0) {
                    $("#page-container").scrollTo("#" + $("#svg-container > div:nth-child(" + r + ")").attr("id"));
                    e = $("#page_no")[0].value
                } else if (r > t) {
                    $("#page-container").scrollTo("#" + $("#svg-container > div:nth-child(" + t + ")").attr("id"));
                    $("#page_no")[0].value = t;
                    e = t
                } else if (r == 0) {
                    $("#page-container").scrollTo("#" + $("#svg-container > div:nth-child(1)").attr("id"));
                    $("#page_no")[0].value = 1;
                    e = 1
                }
            }
        });
        var n = "#" + $("#svg-container:first-child").attr("id");
        $("#page-container").scrollTo("first_pg_id");
        $("#page_no")[0].value = "1";
        $(document).on({
            click: function() {
                if ($("#comment-container").children().length == 1) {
                    comm_del = 0
                }
                if ($("#strike").is(":checked") == true || $("#highlight").is(":checked") == true || $("#drag-comment").is(":checked") == true) {
                    var e = "." + $(this).parent().attr("class").split(" ")[1];
                    $("#svg-container").getHighlighter().removeHighlights("." + $(this).parent().attr("class").split(" ")[1], $(this).parent().attr("class").split(" ")[1]);
                    $("#svg_id > " + e).remove();
                    $("#connector-svg > " + e).remove();
                    $("#image-container > " + e).remove();
                    $("#history > " + e).remove();
                    delete_commentbox_update_arrays(this)
                } else {
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().removeHighlights("." + $(this).parent().attr("class").split(" ")[1], $(this).parent().attr("class").split(" ")[1]);
                    var e = "." + $(this).parent().attr("class").split(" ")[1];
                    $("#svg_id > " + e).remove();
                    $("#connector-svg > " + e).remove();
                    $("#image-container > " + e).remove();
                    $("#history > " + e).remove();
                    delete_commentbox_update_arrays(this);
                    $("#svg-container").getHighlighter().destroy()
                }
            }
        }, ".delete-comment");
        $(document).on({
            mouseenter: function(e) {
                e.stopPropagation();
                var t = $(this).css("background-color");
                var n = "rgba(" + t.substring(t.lastIndexOf("(") + 1, t.lastIndexOf(")")) + ", 0.6)";
                if ($("#strike").is(":checked") == true || $("#highlight").is(":checked") == true || $("#drag-comment").is(":checked") == true) {
                    $("#svg-container span." + $(this).attr("class").split(" ")[1]).css("background-color", n);
                    $("#comment-container ." + $(this).attr("class").split(" ")[1]).css("border-color", "rgba(255,255,255,0.5)");
                    $("#svg_id > ." + $(this).attr("class").split(" ")[1]).css("stroke", "rgba(127,255,255,0.4)");
                    $("#connector-svg > ." + $(this).attr("class").split(" ")[1]).css("stroke", "rgba(127,255,255,0.4)")
                } else {}
            },
            mouseleave: function(e) {
                e.stopPropagation();
                var t = $(this).css("background-color");
                var n = "rgba(" + t.substring(t.lastIndexOf("(") + 1, t.lastIndexOf(",")) + ",1)";
                if ($("#strike").is(":checked") == true || $("#highlight").is(":checked") == true || $("#drag-comment").is(":checked") == true) {
                    $("#svg-container span." + $(this).attr("class").split(" ")[1]).css("background-color", n);
                    $("#comment-container ." + $(this).attr("class").split(" ")[1]).css("border-color", "rgba(255,255,255,1)");
                    $("#svg_id > ." + $(this).attr("class").split(" ")[1]).css("stroke", "#99CCFF");
                    $("#connector-svg > ." + $(this).attr("class").split(" ")[1]).css("stroke", "#99CCFF")
                } else {}
            }
        }, ".highlighted");
        $(document).on({
            mouseenter: function(e) {
                e.stopPropagation();
                var t = $("#svg-container ." + $(this).attr("class").split(" ")[1]).css("background-color");
                var n = "rgba(" + t.substring(t.lastIndexOf("(") + 1, t.lastIndexOf(")")) + ", 0.6)";
                $("#svg-container span." + $(this).attr("class").split(" ")[1]).css("background-color", n);
                $(this).css("border-color", "rgba(255,255,255,0.5)");
                $("#svg_id > ." + $(this).attr("class").split(" ")[1]).css("stroke", "rgba(127,255,255,0.4)");
                $("#connector-svg > ." + $(this).attr("class").split(" ")[1]).css("stroke", "rgba(127,255,255,0.4)")
            },
            mouseleave: function(e) {
                e.stopPropagation();
                var t = $("#svg-container ." + $(this).attr("class").split(" ")[1]).css("background-color");
                var n = "rgba(" + t.substring(t.lastIndexOf("(") + 1, t.lastIndexOf(",")) + ",1)";
                $("#svg-container span." + $(this).attr("class").split(" ")[1]).css("background-color", n);
                $(this).css("border-color", "rgba(255,255,255,1)");
                $("#svg_id > ." + $(this).attr("class").split(" ")[1]).css("stroke", "#99CCFF");
                $("#connector-svg > ." + $(this).attr("class").split(" ")[1]).css("stroke", "#99CCFF")
            }
        }, ".comment-box");
        window.cnt = $(".pf").length;
        for (var r = 0; r < cnt; r++) {
            document.getElementsByClassName("pc")[r].setAttribute("id", "button" + r);
            if (document.getElementById("button" + r).getElementsByTagName("img")[0] != undefined) {
                document.getElementById("button" + r).getElementsByTagName("img")[0].setAttribute("draggable", "false")
            }
        }
        var i = $("#page-container").width();
        var s = $("#svg-container").height();
        var o = $(".pf").width();
        var u = (i - 17 - o) / 2 + "px";
        var a = (i - 17 - (o + 27 + 185)) / 2 + o + "px";
        var f = (i - 17 - (o + 27 + 185)) / 2 + o + 27 + "px";
        var l = "sketchpad";
        var c = o + "px";
        var h = s + "px";
        $("#connector-container").css("height", h);
        window.sketchpad = Raphael.sketchpad("svg-container", {
            width: o,
            height: s,
            editing: true
        });
        sketchpad.change(function() {
            var e = $("#svg_id").children("path:last");
            var t = "http://www.w3.org/2000/svg";
            var n = document.createElementNS(t, "path");
            n.setAttributeNS(null, "fill", "none");
            n.setAttributeNS(null, "stroke", "#bbb000");
            n.setAttributeNS(null, "d", e.attr("d"));
            n.setAttributeNS(null, "stroke-opacity", "0");
            n.setAttributeNS(null, "stroke-width", "20");
            n.setAttributeNS(null, "stroke-linecap", "round");
            n.setAttributeNS(null, "stroke-linejoin", "round");
            n.setAttributeNS(null, "class", e.attr("class"));
            document.getElementById("svg_id").appendChild(n);
            var r = $("#svg_id :last-child")[0].pathSegList.getItem(0).y;
            var i = Math.ceil(r / (page_height + 13)) > cnt ? cnt : Math.ceil(r / (page_height + 13));
            add_history(e.attr("class").split(" ")[1], "[Draw]", i, "Draw")
        });
        document.getElementById("svg-container").children[0].setAttribute("id", "svg_id");
        $("#svg-container").append($("#svg_id"));
        $("#svg_id").css({
            position: "absolute",
            top: "0px"
        });
        sketchpad.editing(false);
        window.draw_state = 0;
       
     
       
     
        var p;
        if (window.XMLHttpRequest) {
            p = new XMLHttpRequest
        } else {
            p = new ActiveXObject("Microsoft.XMLHTTP")
        }
        p.onreadystatechange = function() {
            if (p.readyState == 4 && p.status == 200) {
		
                if (p.responseText != "") {
                   var e = p.responseText;
		   
                    for (var t = 0; t < cnt; t++) {
                        var n = document.getElementById("button" + t).getElementsByTagName("div");
                        for (index = n.length - 1; index >= 0; index--) {
                            n[index].parentNode.removeChild(n[index])
                        }
                        $("#button" + t).append(JSON.parse(e)[t][1])
                    }
                    document.getElementById("svg_id").innerHTML = "<svg id='retrieved-svg'>" + JSON.parse(e)[0][0] + "</svg>";
                    $("#svg-container").append(JSON.parse(e)[0][2]);
                    document.getElementById("history").innerHTML = JSON.parse(e)[0][3];
                    document.getElementById("connector-svg").innerHTML = "<svg id='retrieved-connector'>" + JSON.parse(e)[0][4] + "</svg>";
                    document.getElementById("comment-container").innerHTML = JSON.parse(e)[0][5];
                    window.sum_of_initial_span_and_paths = document.getElementsByTagName("path").length + document.getElementsByTagName("span").length;
                    original_aligned_y = JSON.parse(JSON.parse(e)[0][6]);
                    all_click_y_positions = JSON.parse(JSON.parse(e)[0][7]);
                    click_counter = JSON.parse(e)[0][8];
                    comment_div_id_cnt = JSON.parse(e)[0][9];
                    document.getElementById("image-container").innerHTML = JSON.parse(e)[0][10];
	

		    
                } else {
                    window.sum_of_initial_span_and_paths = document.getElementsByTagName("path").length + document.getElementsByTagName("span").length
                }
            }
        };
        p.open("POST", json, true);
        p.send();
	
	
	
        if ($("#retrieved-svg").children().length == 0) {
            $("#retrieved-svg").remove()
        } else {
            $("#retrieved-svg").children().first().unwrap()
        }
        if ($("#retrieved-connector").children().length == 0) {
            $("#retrieved-connector").remove()
        } else {
            $("#retrieved-connector").children().first().unwrap()
        }
        $(".comment-box").resize(function() {
            height_change_align_comment_boxes($(this).parent().children().index(this))
        });
        $("#svg-container").css({
            position: "absolute",
            height: "auto",
            left: svg_left("after"),
            cursor: "url(../../images/drag.cur),default"
        });
        $("#connector-container").css({
            position: "absolute",
            left: a,
            top: "0px",
            width: "27"
        });
        $("#comment-container").css({
            position: "absolute",
            left: f,
            top: "0px",
            width: "185",
            height: "100%",
            "z-index": "10",
            display: "block"
        })
    });

    function svg_left(e) {
        var t = $("#page-container").width();
        var n = $(".pf").width();
        if (e == "before") {
            return (t - 17 - n) / 2 + "px"
        } else if (e == "after") {
            return (t - 17 - (n + 27 + 185)) / 2 + "px"
        }
    }

    function svg_left_no_px(e) {
        var t = $("#page-container").width();
        var n = $(".pf").width();
        if (e == "before") {
            return (t - 17 - n) / 2
        } else if (e == "after") {
            return (t - 17 - (n + 27 + 185)) / 2
        }
    }

    function change_sketchpads(e) {
        if (e == 1 && draw_state == 0) {
            document.getElementById("svg_id").style.pointerEvents = "visiblepainted";
            sketchpad.editing(true)
        } else if (e == 0 && draw_state == 1) {
            sketchpad.editing(false);
            document.getElementById("svg_id").style.pointerEvents = "none";
            draw_state = 0
        } else {}
    }

    function change_draw_color(e) {
        sketchpad.pen().color(e)
    }

    function check_value(e) {
        if (document.getElementById(e).checked) {
            switch (e) {
                case "textbox":
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().destroy();
                    $("#svg-container").unbind();
                    $.contextMenu("destroy");
                    window.focussed_class = "";
                    window.fcs = 0;
                    $(".clickable").bind("click", function(e) {
                        var t = Math.ceil((e.clientY - $(".clickable").offset().top) / ($(".pf").height() + 13)) > cnt ? cnt : Math.ceil((e.clientY - $(".clickable").offset().top) / ($(".pf").height() + 13));
                        if ($(".box").length > 0) {
                            if ($.trim($("#svg-container div.box:last").text()).length === 0) {
                                $("#history  li." + $("#svg-container div.handle:last").attr("class").split(" ")[2]).remove();
                                $("#svg-container div.box:last").parent().remove();
                                fcs = 0
                            } else {}
                        }
                        if ($(".box").is(":focus") == false && fcs != 1) {
                            var n = $(e.target);
                            var r = n.offset();
                            var i = e.clientX - r.left;
                            var s = e.clientY - r.top;
                            $(".handle").css("outline", "none");
                            var o = random_class_generator();
                            $("#svg-container").append('<div class="handle bar ' + o + '"' + ' style="margin:8px;z-index:3;cursor:url(../../images/openhand.cur) 7.5 7.5,default;height:auto; width:auto;overflow:visible;outline: 1px solid #33CCFF;color:red;text-shadow: -1px -1px 0 #FFF, 1px -1px 0 #FFF, -1px 1px 0 #FFF, 1px 1px 0 #FFF;' + "position:absolute;padding:6px;background:transparent;top:" + s + "px;left:" + i + 'px">' + '<div class="box lim" ' + 'style="vertical-align:baseline;background:transparent;float:left;border:1px;solid;padding:1px;outline:none"' + ' contenteditable="true" spellcheck="false">' + "</div>" + '<div class="delete-text-box" style="position:absolute;top:-9px;right:-9px;float:right;background-image:url(../../images/delete16x16.png);background-repeat:no-repeat;background-position:center center;' + 'border: none;cursor: default;height: 16px;width: 16px;outline: none;opacity:0.4"></div>' + "</div>");
                            $(".box").focus();
                            fcs = 1
                        } else {
                            if ($(".box").is(":focus") == true) {
                                fcs = 1;
                                if (focussed_class != "") {
                                    if ($.trim($("#svg-container ." + focussed_class).text()).length == 0) {
                                        $("#history  li." + focussed_class).remove();
                                        $("#svg-container ." + focussed_class).remove()
                                    }
                                    update_history(focussed_class, $("#svg-container ." + focussed_class + " > .box").text())
                                }
                                focussed_class = document.activeElement.parentElement.getAttribute("class").split(" ")[2];
                                var u = $("#svg-container div.handle:last").attr("class").split(" ")[2];
                                if ($("#history > li." + u).length == 0) {
                                    add_history(u, $("." + u).text(), t, "Text box")
                                }
                            } else {
                                fcs = 0;
                                $(".handle").css("outline", "none");
                                $(".delete-text-box").css("opacity", "0");
                                var u = $("#svg-container div.handle:last").attr("class").split(" ")[2];
                                if ($("#history > li." + u).length == 0) {
                                    add_history(u, $("." + u).text(), t, "Text box")
                                } else {
                                    if ($.trim($("#svg-container ." + focussed_class).text()).length === 0) {
                                        $("#history  li." + focussed_class).remove();
                                        $("#svg-container ." + focussed_class).remove()
                                    } else {
                                        update_history(focussed_class, $("#svg-container ." + focussed_class + " > .box").text())
                                    }
                                }
                            }
                        }
                    });
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().destroy();
                    $(".highlight_colors").css("display", "none");
                    $(".draw_colors").css("display", "none");
                    $("#draw, #strike, #highlight, #drop-comment,#drag-comment, #highlight_blue, #highlight_red, #highlight_green, #highlight_yellow, #draw_black, #draw_red, #draw_green, #draw_blue").prop("checked", false);
                    change_sketchpads(0);
                    document.getElementById("svg_id").style.pointerEvents = "visiblepainted";
                    textbox_events();
                    break;
                case "highlight":
                    remove_textbox_styles("");
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().destroy();
                    $("#draw, #strike,#textbox, #drop-comment,#drag-comment, #highlight_blue, #highlight_green, #highlight_yellow, #draw_black, #draw_red, #draw_green, #draw_blue").prop("checked", false);
                    document.getElementById("highlight_red").checked = true;
                    $(".highlight_colors").css("display", "block");
                    $(".draw_colors").css("display", "none");
                    change_sketchpads(0);
                    document.getElementById("svg_id").style.pointerEvents = "none";
                    $(".clickable").unbind();
                    svg_cont_style("url(../../images/red.cur),default");
                    $("#svg-container").textHighlighter({
                        onAfterHighlight: function(e, t) {
                            add_history($(e[0]).attr("class").split(" ")[1], t, $($(e[0]).closest(".pf")[0]).index() + 1, "Highlight")
                        }
                    });
                    $("#svg-container").getHighlighter().setStrike("");
                    $("#svg-container").getHighlighter().setColor("#ee7d7d");
                    contextmenu_activate();
                    break;
                case "strike":
                    remove_textbox_styles("text");
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().destroy();
                    $("#draw, #textbox, #highlight, #drop-comment,#drag-comment, #highlight_blue, #highlight_red, #highlight_green, #highlight_yellow, #draw_black, #draw_red, #draw_green, #draw_blue").prop("checked", false);
                    $(".highlight_colors").css("display", "none");
                    $(".draw_colors").css("display", "none");
                    change_sketchpads(0);
                    svg_cont_style("url(../../images/strike.cur),default");
                    document.getElementById("svg_id").style.pointerEvents = "none";
                    $(".clickable").unbind();
                    $("#svg-container").textHighlighter({
                        onAfterHighlight: function(e, t) {
                            add_history($(e[0]).attr("class").split(" ")[1], t, $($(e[0]).closest(".pf")[0]).index() + 1, "Strike")
                        }
                    });
                    $("#svg-container").getHighlighter().setStrike("line-through");
                    contextmenu_activate();
                    break;
                case "highlight_red":
                    $("#highlight_blue, #highlight_green, #highlight_yellow,").prop("checked", false);
                    $("#svg-container").css({
                        cursor: "url(../../images/red.cur),default"
                    });
                    change_sketchpads(0);
                    $("#svg-container").getHighlighter().setStrike("");
                    $("#svg-container").getHighlighter().setColor("#ee7d7d");
                    break;
                case "highlight_blue":
                    $("#highlight_red, #highlight_green, #highlight_yellow").prop("checked", false);
                    $("#svg-container").css({
                        cursor: "url(../../images/blue.cur),default"
                    });
                    change_sketchpads(0);
                    $("#svg-container").getHighlighter().setStrike("");
                    $("#svg-container").getHighlighter().setColor("#80E6FF");
                    break;
                case "highlight_green":
                    $("#highlight_blue, #highlight_red,#highlight_yellow").prop("checked", false);
                    change_sketchpads(0);
                    $("#svg-container").css({
                        cursor: "url(../../images/green.cur),default"
                    });
                    $("#svg-container").getHighlighter().setStrike("");
                    $("#svg-container").getHighlighter().setColor("#99FF99");
                    break;
                case "highlight_yellow":
                    $("#highlight_blue, #highlight_red, #highlight_green").prop("checked", false);
                    change_sketchpads(0);
                    $("#svg-container").css({
                        cursor: "url(../../images/yellow.cur),default"
                    });
                    $("#svg-container").getHighlighter().setStrike("");
                    $("#svg-container").getHighlighter().setColor("#Fefe58");
                    break;
                case "draw":
                    remove_textbox_styles("");
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().destroy();
                    $(".highlight_colors").css("display", "none");
                    $(".draw_colors").css("display", "block");
                    $("#strike,#textbox, #highlight, #drop-comment,#drag-comment, #highlight_blue, #highlight_red, #highlight_green, #highlight_yellow,#draw_red, #draw_green, #draw_blue").prop("checked", false);
                    document.getElementById("draw_black").checked = true;
                    $(".clickable").unbind();
                    change_sketchpads(1);
                    change_draw_color("#000000");
                    draw_state = 1;
                    svg_cont_style("url(../../images/draw_black.cur),default");
                    draw_contextmenu();
                    break;
                case "draw_black":
                    $("#draw_red, #draw_green, #draw_blue").prop("checked", false);
                    $("#svg-container").css({
                        cursor: "url(../../images/draw_black.cur),default"
                    });
                    change_draw_color("#000000");
                    draw_state = 1;
                    break;
                case "draw_green":
                    $("#draw_black, #draw_red,#draw_blue").prop("checked", false);
                    $("#svg-container").css({
                        cursor: "url(../../images/draw_green.cur),default"
                    });
                    change_draw_color("#33CC33");
                    draw_state = 1;
                    break;
                case "draw_red":
                    $("#svg-container").css({
                        cursor: "url(../../images/draw_red.cur),default"
                    });
                    $("#draw_black,#draw_green, #draw_blue").prop("checked", false);
                    document.getElementById("highlight").checked = false;
                    document.getElementById("draw_black").checked = false;
                    document.getElementById("draw_blue").checked = false;
                    document.getElementById("draw_green").checked = false;
                    document.getElementById("textbox").checked = false;
                    change_draw_color("#FF0000");
                    draw_state = 1;
                    break;
                case "draw_blue":
                    $("#draw_black, #draw_red, #draw_green").prop("checked", false);
                    $("#svg-container").css({
                        cursor: "url(../../images/draw_blue.cur),default"
                    });
                    change_draw_color("#3366FF");
                    draw_state = 1;
                    break;
                case "drag-comment":
                    remove_textbox_styles("text");
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().destroy();
                    $("#svg-container").unbind();
                    $(".clickable").unbind();
                    contextmenu_activate();

                    function t() {
                        var e, t, n;
                        var r = rangy.getSelection().getBoundingDocumentRect();
                        if (!r) {
                            return
                        }
                        var i = rangy.getSelection().getRangeAt(0).getStartClientPos();
                        if ($.browser.mozilla) {
                            var s = $(rangy.getSelection().getRangeAt(0).startContainer.parentNode).closest(".t").offset().left - $("#svg-container").offset().left;
                            var o = (i.x - s - $("#svg-container").offset().left) / 3 + $("#svg-container").offset().left + s;
                            var u = i.y + 17;
                            return [o, u]
                        } else {
                            return [i.x, i.y]
                        }
                        var a = rangy.getSelection().getEndDocumentPos()
                    }
                    document.getElementById("svg_id").style.pointerEvents = "none";
                    $("#svg-container").textHighlighter({
                        onBeforeHighlight: function(e) {
                            var n = t();
                            window.y_pos_drag = n[1];
                            window.x_pos_drag = n[0];
                            return true
                        },
                        onAfterHighlight: function(e, t) {
                            var r = $(e[0]).attr("class").split(" ")[1];
                            n(y_pos_drag - $("#svg-container").offset().top, r);
                            var i = Math.ceil((y_pos_drag - $("#svg-container").offset().top) / (page_height + 13)) > cnt ? cnt : Math.ceil((y_pos_drag - $("#svg-container").offset().top) / (page_height + 13));
                            add_history(r, t, i, "Text comment")
                        }
                    });
                    $("#svg-container").getHighlighter().setStrike("");
                    $("#svg-container").getHighlighter().setColor("#FB8520");
                    $(".highlight_colors").css("display", "none");
                    $(".draw_colors").css("display", "none");
                    $("#draw, #strike, #highlight, #drop-comment, #highlight_blue, #highlight_red, #highlight_green, #highlight_yellow, #draw_black, #draw_red, #draw_green, #draw_blue, #textbox").prop("checked", false);
                    change_sketchpads(0);
                    svg_cont_style("url(../../images/drag.cur),default");

                    function n(e, t) {
                        function n(e) {
                            var t = e;
                            original_aligned_y.push([t]);
                            original_aligned_y.sort(function(e, t) {
                                return e - t
                            });
                            if ($(".comment-box").length == 0) {
                                all_click_y_positions.push([e, click_counter])
                            }
                            if ($(".comment-box").length > 0) {
                                window.col1 = all_click_y_positions.map(function(e, t) {
                                    return e[0]
                                });
                                window.col2 = all_click_y_positions.map(function(e, t) {
                                    return e[1]
                                });
                                all_click_y_positions.push([e, click_counter]);
                                var n = function(e, t) {
                                    var n, r, i;
                                    for (var s = 0; s < e.length; s++) {
                                        if (e[s] <= t && (n === undefined || n < e[s])) {
                                            n = e[s];
                                            i = col2[s]
                                        }
                                        if (e[s] >= t && (r === undefined || r > e[s])) r = e[s]
                                    }
                                    return [n, r, i]
                                };
                                window.result = n(col1, e);
                                $ts = $(".comment-box");
                                for (var r = 0; r < $ts.length; r++) {
                                    var i = $ts.eq(r);
                                    var s = [i.offset().top - i.parent().offset().top, i.offset().top + i.height() - i.parent().offset().top, i.attr("id")];
                                    if (t >= s[0] && t <= s[1]) {
                                        e = $("#" + result[2]).offset().top - $("#" + result[2]).parent().offset().top + $("#" + result[2]).height() + 10
                                    }
                                }
                            }
                            return e
                        }
                        click_counter++;
                        check_empty_commentbox("drag");
                        $("#comment-container").css("display", "block");
                        var r = $(this).offset();
                        var i = n(e);
                        comment_div_id_cnt++;
                        if ($("#comment-container").children().length == 0 && comm_del == 0) {
                            comment_lines(x_pos_drag - $("#svg-container").offset().left, y_pos_drag - $("#svg-container").offset().top, 800, y_pos_drag - $("#svg-container").offset().top, t);
                            connector_lines(y_pos_drag - $("#svg-container").offset().top, i, t)
                        } else {
                            comment_lines(x_pos_drag - $("#svg-container").offset().left, y_pos_drag - $("#svg-container").offset().top, 800, y_pos_drag - $("#svg-container").offset().top, t);
                            connector_lines(y_pos_drag - $("#svg-container").offset().top, i, t)
                        }
                        if ($(".comment-box").length == 0) {
                            $("#comment-container").append('<ul class="comment-box ' + t + '" id="' + comment_div_id_cnt + '"' + ' style="top:' + i + 'px;">' + "<li>" + '<span class="critic_name" contenteditable="false">' + user + ":</span>" + '<div class="comment-text" contenteditable="true" spellcheck=false></div>' + "</li>" + '<div class="delete-comment" contenteditable="false" ></div>' + '<div class="comment-reply">Reply</div>' + "</ul>")
                        } else if (result[2] == undefined) {
                            $("#comment-container").prepend('<ul class="comment-box ' + t + '" id="' + comment_div_id_cnt + '"' + ' style="top:' + i + 'px;">' + "<li>" + '<span class="critic_name" contenteditable="false">' + user + ":</span>" + '<div class="comment-text" contenteditable="true" spellcheck=false></div>' + "</li>" + '<div class="delete-comment" contenteditable="false" ></div>' + '<div class="comment-reply">Reply</div>' + "</ul>")
                        } else {
                            $("#comment-container #" + result[2]).after('<ul class="comment-box ' + t + '" id="' + comment_div_id_cnt + '"' + 'style="top:' + i + 'px;">' + "<li>" + '<span class="critic_name" contenteditable="false">' + user + ":</span>" + '<div class="comment-text" contenteditable="true" spellcheck=false></div>' + "</li>" + '<div class="delete-comment" contenteditable="false" ></div>' + '<div class="comment-reply">Reply</div>' + "</ul>")
                        }
                        var s = Math.max.apply(Math, $(".comment-box").map(function() {
                            return $(this).attr("id")
                        }).get());
                        $("#" + s).resize(function() {
                            height_change_align_comment_boxes($(this).parent().children().index(this))
                        });
                        new_box_entry_align_comment_boxes()
                    }
                    break;
                case "drop-comment":
                    remove_textbox_styles("url(../../images/drop_comment.cur),default");
                    $.contextMenu("destroy");
                    drop_contextmenu();
                    $("#svg-container").unbind();
                    $(".clickable").unbind();
                    $("#svg-container").textHighlighter();
                    $("#svg-container").getHighlighter().destroy();
                    $(".highlight_colors").css("display", "none");
                    $(".draw_colors").css("display", "none");
                    $("#draw, #strike, #highlight, #drag-comment, #highlight_blue, #highlight_red, #highlight_green, #highlight_yellow, #draw_black, #draw_red, #draw_green, #draw_blue, #textbox").prop("checked", false);
                    change_sketchpads(0);
                    svg_cont_style("url(../../images/drop_comment.cur),default");
                    document.getElementById("svg_id").style.pointerEvents = "none";
                    $("#svg-container").mousedown(function(e) {
                        if (e.which == 1) {
                            click_counter++;
                            check_empty_commentbox("drop");
                            $("#comment-container").css("display", "block");

                            function t(e) {
                                var t = e;
                                original_aligned_y.push([t]);
                                original_aligned_y.sort(function(e, t) {
                                    return e - t
                                });
                                if ($(".comment-box").length == 0) {
                                    all_click_y_positions.push([e, click_counter])
                                }
                                if ($(".comment-box").length > 0) {
                                    window.col1 = all_click_y_positions.map(function(e, t) {
                                        return e[0]
                                    });
                                    window.col2 = all_click_y_positions.map(function(e, t) {
                                        return e[1]
                                    });
                                    all_click_y_positions.push([e, click_counter]);
                                    var n = function(e, t) {
                                        var n, r, i;
                                        for (var s = 0; s < e.length; s++) {
                                            if (e[s] <= t && (n === undefined || n < e[s])) {
                                                n = e[s];
                                                i = col2[s]
                                            }
                                            if (e[s] >= t && (r === undefined || r > e[s])) r = e[s]
                                        }
                                        return [n, r, i]
                                    };
                                    window.result = n(col1, e);
                                    $ts = $(".comment-box");
                                    for (var r = 0; r < $ts.length; r++) {
                                        var i = $ts.eq(r);
                                        var s = [i.offset().top - i.parent().offset().top, i.offset().top + i.height() - i.parent().offset().top, i.attr("id")];
                                        if (t >= s[0] && t <= s[1]) {
                                            e = $("#" + result[2]).offset().top - $("#" + result[2]).parent().offset().top + $("#" + result[2]).height() + 10
                                        }
                                    }
                                }
                                return e
                            }
                            var n = $(this).offset();
                            var r = t(e.pageY - n.top);
                            comment_div_id_cnt++;
                            var i = random_class_generator();
                            if ($("#comment-container").children().length == 0 && comm_del == 0) {
                                $("#image-container").append("<img class='drop-comment " + i + "' style='z-index:100;position:absolute;top:" + (e.pageY - n.top - 24) + "px;left:" + (e.pageX - 200 - 19 + $("#page-container").scrollLeft()) + "px' src='../../images/drop_pin.cur'>");
                                comment_lines(e.pageX - n.left, e.pageY - n.top, 800, e.pageY - n.top, i);
                                connector_lines(e.pageY - n.top, r, i)
                            } else {
                                $("#image-container").append("<img class='drop-comment " + i + "' style='z-index:100;position:absolute;top:" + (e.pageY - n.top - 24) + "px;left:" + (e.pageX - 200 - 19 + $("#page-container").scrollLeft()) + "px' src='../../images/drop_pin.cur'>");
                                comment_lines(e.pageX - n.left, e.pageY - n.top, 800, e.pageY - n.top, i);
                                connector_lines(e.pageY - n.top, r, i)
                            }
                            if ($(".comment-box").length == 0) {
                                $("#comment-container").append('<ul class="comment-box ' + i + '" id="' + comment_div_id_cnt + '"' + ' style="top:' + r + 'px;">' + "<li>" + '<span class="critic_name" contenteditable="false">' + user + ":</span>" + '<div class="comment-text" contenteditable="true" spellcheck=false></div>' + "</li>" + '<div class="delete-comment" contenteditable="false"></div>' + '<div class="comment-reply">Reply</div>' + "</ul>")
                            } else if (result[2] == undefined) {
                                $("#comment-container").prepend('<ul class="comment-box ' + i + '" id="' + comment_div_id_cnt + '"' + ' style="top:' + r + 'px;">' + "<li>" + '<span class="critic_name" contenteditable="false">' + user + ":</span>" + '<div class="comment-text" contenteditable="true" spellcheck=false></div>' + "</li>" + '<div class="delete-comment" contenteditable="false"></div>' + '<div class="comment-reply">Reply</div>' + "</ul>")
                            } else {
                                $("#comment-container #" + result[2]).after('<ul class="comment-box ' + i + '" id="' + comment_div_id_cnt + '"' + 'style="top:' + r + 'px;">' + "<li>" + '<span class="critic_name" contenteditable="false">' + user + ":</span>" + '<div class="comment-text" contenteditable="true" spellcheck=false></div>' + "</li>" + '<div class="delete-comment" contenteditable="false"></div>' + '<div class="comment-reply">Reply</div>' + "</ul>")
                            }
                            var s = Math.ceil((e.pageY - n.top) / (page_height + 13)) > cnt ? cnt : Math.ceil((e.pageY - n.top) / (page_height + 13));
                            add_history(i, "[Pin comment]", s, "Pin comment");
                            var o = Math.max.apply(Math, $(".comment-box").map(function() {
                                return $(this).attr("id")
                            }).get());
                            $("#" + o).resize(function() {
                                height_change_align_comment_boxes($(this).parent().children().index(this))
                            });
                            new_box_entry_align_comment_boxes()
                        } else {}
                    });
                    break;
                default:
                    break
            }
        } else {
            $.contextMenu("destroy");
            $(".highlight_colors").css("display", "none");
            $(".draw_colors").css("display", "none");
            $("#svg-container").textHighlighter();
            $("#svg-container").getHighlighter().destroy();
            change_sketchpads(0);
            svg_cont_style("text");
            document.getElementById("svg_id").style.pointerEvents = "none";
            $(".clickable").unbind("click");
            $("#svg-container").unbind();
            $("#svg-container").css({
                cursor: "text"
            })
        }
    }

    function new_top_calculator(e) {
        return e + "px"
    }

    function new_box_entry_align_comment_boxes() {
        $("#comment-container > .comment-box").each(function() {
            if ($(this).parent().children().index(this) > 0) {
                if ($(this).offset().top - $(this).parent().offset().top - ($(this).prev().offset().top - $(this).parent().offset().top + $(this).prev().height()) < 10) {
                    window.new_top = $(this).prev().offset().top + $(this).prev().height() - $(this).parent().offset().top + 10;
                    $(this).css("top", new_top_calculator(new_top));
                    $("#connector-svg > ." + $(this).attr("class").split(" ")[1]).attr("y2", new_top_calculator(new_top))
                } else {}
            }
        })
    }

    function height_change_align_comment_boxes(e) {
        $("#comment-container > .comment-box").each(function() {
            if ($(this).parent().children().index(this) > e) {
                if ($(this).offset().top - $(this).parent().offset().top - ($(this).prev().offset().top - $(this).parent().offset().top + $(this).prev().height()) < 10) {
                    window.new_top_move_down = $(this).prev().offset().top + $(this).prev().height() - $(this).parent().offset().top + 10;
                    $(this).css("top", new_top_calculator(new_top_move_down));
                    $("#connector-svg > ." + $(this).attr("class").split(" ")[1]).attr("y2", new_top_calculator(new_top_move_down))
                } else if ($(this).offset().top - $(this).parent().offset().top - ($(this).prev().offset().top - $(this).parent().offset().top + $(this).prev().height()) > 10) {
                    var t = $(this).prev().offset().top + $(this).prev().height() - $(this).parent().offset().top + 10;
                    if (original_aligned_y[$(this).parent().children().index(this)] > t) {
                        t = original_aligned_y[$(this).parent().children().index(this)]
                    }
                    $(this).css("top", new_top_calculator(t));
                    $("#connector-svg > ." + $(this).attr("class").split(" ")[1]).attr("y2", new_top_calculator(t))
                } else {}
            } else {}
        })
    }
}