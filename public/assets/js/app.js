/*
Author       : Dreamguys
Template Name: CRMS - Bootstrap Admin Template
Version      : 1.0
*/
$(document).ready(function() {    
    // Variables declarations
    //initializeMap();
    var $wrapper = $('.main-wrapper');
    var $pageWrapper = $('.page-wrapper');
    var $slimScrolls = $('.slimscroll');

    // Sidebar

    var Sidemenu = function() {
        this.$menuItem = $('#sidebar-menu a');
    };

    function init() {
        var $this = Sidemenu;
        $('#sidebar-menu a').on('click', function(e) {
            if ($(this).parent().hasClass('submenu')) {
                e.preventDefault();
            }
            if (!$(this).hasClass('subdrop')) {
                $('.sub-menus', $(this).parents('.sub-menus:first')).slideUp(350);
                $('a', $(this).parents('.sub-menus:first')).removeClass('subdrop');
                $(this).next('.sub-menus').slideDown(350);
                $(this).addClass('subdrop');
            } else if ($(this).hasClass('subdrop')) {
                $(this).removeClass('subdrop');
                $(this).next('.sub-menus').slideUp(350);
            }
        });
        $('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
    }

    // Sidebar Initiate
    init();

    // Mobile menu sidebar overlay

    $('body').append('<div class="sidebar-overlay"></div>');
    $(document).on('click', '#mobile_btn', function() {
        $wrapper.toggleClass('slide-nav');
        $('.sidebar-overlay').toggleClass('opened');
        $('html').addClass('menu-opened');
        $('#task_window').removeClass('opened');
        return false;
    });

    $(".sidebar-overlay").on("click", function() {
        $('html').removeClass('menu-opened');
        $(this).removeClass('opened');
        $wrapper.removeClass('slide-nav');
        $('.sidebar-overlay').removeClass('opened');
        $('#task_window').removeClass('opened');
    });

    // Chat sidebar overlay

    $(document).on('click', '#task_chat', function() {
        $('.sidebar-overlay').toggleClass('opened');
        $('#task_window').addClass('opened');
        return false;
    });

    // Select 2

    // if ($('.select').length > 0) {
    //     $('.select').select2({
    //         minimumResultsForSearch: -1,
    //         width: '100%'
    //     });
    // }

    // Modal Popup hide show

    if ($('.modal').length > 0) {
        var modalUniqueClass = ".modal";
        $('.modal').on('show.bs.modal', function(e) {
            var $element = $(this);
            var $uniques = $(modalUniqueClass + ':visible').not($(this));
            if ($uniques.length) {
                $uniques.modal('hide');
                $uniques.one('hidden.bs.modal', function(e) {
                    $element.modal('show');
                });
                return false;
            }
        });
    }

    // Floating Label

    if ($('.floating').length > 0) {
        $('.floating').on('focus blur', function(e) {
            $(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
        }).trigger('blur');
    }

    // Sidebar Slimscroll

    if ($slimScrolls.length > 0) {
        $slimScrolls.slimScroll({
            height: 'auto',
            width: '100%',
            position: 'right',
            size: '7px',
            color: '#ccc',
            wheelStep: 10,
            touchScrollStep: 100
        });
        var wHeight = $(window).height() - 60;
        $slimScrolls.height(wHeight);
        $('.sidebar .slimScrollDiv').height(wHeight);
        $(window).resize(function() {
            var rHeight = $(window).height() - 60;
            $slimScrolls.height(rHeight);
            $('.sidebar .slimScrollDiv').height(rHeight);
        });
    }

    // Page Content Height

    var pHeight = $(window).height();
    $pageWrapper.css('min-height', pHeight);
    $(window).resize(function() {
        var prHeight = $(window).height();
        $pageWrapper.css('min-height', prHeight);
    });

    // Date Time Picker

    if ($('.datetimepicker').length > 0) {
        $('.datetimepicker').datetimepicker({
            format: 'DD/MM/YYYY',
            icons: {
                up: "fa fa-angle-up",
                down: "fa fa-angle-down",
                next: 'fa fa-angle-right',
                previous: 'fa fa-angle-left'
            }
        });
    }

    // Datatable

    // if ($('.datatable').length > 0) {
    //     $('.datatable').DataTable({
    //         "bFilter": false,
    //     });
    // }

    // Tooltip

    if ($('[data-toggle="tooltip"]').length > 0) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // Email Inbox

    if ($('.clickable-row').length > 0) {
        $('.clickable-row').on('click', function() {
            window.location = $(this).data("href");
        });
    }


    if ($('.clickable-row').length > 0) {
        $('.clickable-row').on('click', function() {
            window.location = $(this).data("href");
        });
    }
    // Check all email

    $(document).on('click', '#check_all', function() {
        $('.checkmail').click();
        return false;
    });
    if ($('.checkmail').length > 0) {
        $('.checkmail').each(function() {
            $(this).on('click', function() {
                if ($(this).closest('tr').hasClass('checked')) {
                    $(this).closest('tr').removeClass('checked');
                } else {
                    $(this).closest('tr').addClass('checked');
                }
            });
        });
    }

    // Mail important

    $(document).on('click', '.mail-important', function() {
        $(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');
    });

    // Summernote

    if ($('.summernote').length > 0) {
        $('.summernote').summernote({
            height: 200, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
    }

    // Task Complete

    $(document).on('click', '#task_complete', function() {
        $(this).toggleClass('task-completed');
        return false;
    });

    // Multiselect

    if ($('#customleave_select').length > 0) {
        $('#customleave_select').multiselect();
    }
    if ($('#edit_customleave_select').length > 0) {
        $('#edit_customleave_select').multiselect();
    }

    // Leave Settings button show

    $(document).on('click', '.leave-edit-btn', function() {
        $(this).removeClass('leave-edit-btn').addClass('btn btn-white leave-cancel-btn').text('Cancel');
        $(this).closest("div.leave-right").append('<button class="btn btn-primary leave-save-btn" type="submit">Save</button>');
        $(this).parent().parent().find("input").prop('disabled', false);
        return false;
    });
    $(document).on('click', '.leave-cancel-btn', function() {
        $(this).removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
        $(this).closest("div.leave-right").find(".leave-save-btn").remove();
        $(this).parent().parent().find("input").prop('disabled', true);
        return false;
    });

    $(document).on('change', '.leave-box .onoffswitch-checkbox', function() {
        var id = $(this).attr('id').split('_')[1];
        if ($(this).prop("checked") == true) {
            $("#leave_" + id + " .leave-edit-btn").prop('disabled', false);
            $("#leave_" + id + " .leave-action .btn").prop('disabled', false);
        } else {
            $("#leave_" + id + " .leave-action .btn").prop('disabled', true);
            $("#leave_" + id + " .leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
            $("#leave_" + id + " .leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
            $("#leave_" + id + " .leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
            $("#leave_" + id + " .leave-edit-btn").prop('disabled', true);
        }
    });

    $('.leave-box .onoffswitch-checkbox').each(function() {
        var id = $(this).attr('id').split('_')[1];
        if ($(this).prop("checked") == true) {
            $("#leave_" + id + " .leave-edit-btn").prop('disabled', false);
            $("#leave_" + id + " .leave-action .btn").prop('disabled', false);
        } else {
            $("#leave_" + id + " .leave-action .btn").prop('disabled', true);
            $("#leave_" + id + " .leave-cancel-btn").parent().parent().find("input").prop('disabled', true);
            $("#leave_" + id + " .leave-cancel-btn").closest("div.leave-right").find(".leave-save-btn").remove();
            $("#leave_" + id + " .leave-cancel-btn").removeClass('btn btn-white leave-cancel-btn').addClass('leave-edit-btn').text('Edit');
            $("#leave_" + id + " .leave-edit-btn").prop('disabled', true);
        }
    });

    // Placeholder Hide

    if ($('.otp-input, .zipcode-input input, .noborder-input input').length > 0) {
        $('.otp-input, .zipcode-input input, .noborder-input input').focus(function() {
            $(this).data('placeholder', $(this).attr('placeholder'))
                .attr('placeholder', '');
        }).blur(function() {
            $(this).attr('placeholder', $(this).data('placeholder'));
        });
    }

    // OTP Input

    if ($('.otp-input').length > 0) {
        $(".otp-input").keyup(function(e) {
            if ((e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)) {
                $(e.target).next('.otp-input').focus();
            } else if (e.which == 8) {
                $(e.target).prev('.otp-input').focus();
            }
        });
    }

    // Small Sidebar

    $(document).on('click', '#toggle_btn', function() {
        if ($('body').hasClass('mini-sidebar')) {
            $('body').removeClass('mini-sidebar');
            $('.subdrop + ul').slideDown();
        } else {
            $('body').addClass('mini-sidebar');
            $('.subdrop + ul').slideUp();
        }
        return false;
    });
    $(document).on('mouseover', function(e) {
        e.stopPropagation();
        if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
            var targ = $(e.target).closest('.sidebar').length;
            if (targ) {
                $('body').addClass('expand-menu');
                $('.subdrop + ul').slideDown();
            } else {
                $('body').removeClass('expand-menu');
                $('.subdrop + ul').slideUp();
            }
            return false;
        }
    });

    $(document).on('click', '.top-nav-search .responsive-search', function() {
        $('.top-nav-search').toggleClass('active');
    });

    $(document).on('click', '#file_sidebar_toggle', function() {
        $('.file-wrap').toggleClass('file-sidebar-toggle');
    });

    $(document).on('click', '.file-side-close', function() {
        $('.file-wrap').removeClass('file-sidebar-toggle');
    });

    if ($('.kanban-wrap').length > 0) {
        $(".kanban-wrap").sortable({
            connectWith: ".kanban-wrap",
            handle: ".kanban-box",
            placeholder: "drag-placeholder"
        });
    }

});

// Loader

$(window).on('load', function() {
    $('#loader').delay(100).fadeOut('slow');
    $('#loader-wrapper').delay(500).fadeOut('slow');
});



/*tabs*/
var accordion = (function() {

    var $accordion = $('.crms-tasks');
    var $accordion_header = $accordion.find('.js-accordion-header');
    var $accordion_item = $('.js-accordion-item');

    // default settings 
    var settings = {
        // animation speed
        speed: 400,

        // close all other accordion items if true
        oneOpen: false
    };

    return {
        // pass configurable object literal
        init: function($settings) {
            $accordion_header.on('click', function() {
                accordion.toggle($(this));
            });

            $.extend(settings, $settings);

            // ensure only one accordion is active if oneOpen is true
            if (settings.oneOpen && $('.crms-task-item.active').length > 1) {
                $('.crms-task-item.active:not(:first)').removeClass('active');
            }

            // reveal the active accordion bodies
            $('.crms-task-item.active').find('> .js-accordion-body').show();
        },
        toggle: function($this) {

            if (settings.oneOpen && $this[0] != $this.closest('.crms-tasks').find('> .crms-task-item.active > .js-accordion-header')[0]) {
                $this.closest('.crms-tasks')
                    .find('> .crms-task-item')
                    .removeClass('active')
                    .find('.js-accordion-body')
                    .slideUp()
            }

            // show/hide the clicked accordion item
            $this.closest('.crms-task-item').toggleClass('active');
            $this.next().stop().slideToggle(settings.speed);
        }
    }
})();

$(document).ready(function() {
    accordion.init({
        speed: 300,
        oneOpen: true
    });
});



/*kanban view*/
$(function() {

    draggableInit();

    $('.panel-heading').on('click', function() {
        var $panelBody = $(this).parent().children('.panel-body');
        $panelBody.slideToggle();
    });
});

function draggableInit() {
    var sourceId;

    $('[draggable=true]').bind('dragstart', function(event) {
        sourceId = $(this).parent().attr('id');
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });

    $('.panel-body').bind('dragover', function(event) {
        event.preventDefault();
    });

    $('.panel-body').bind('drop', function(event) {
        var children = $(this).children();
        var targetId = children.attr('id');

        if (sourceId != targetId) {
            var elementId = event.originalEvent.dataTransfer.getData("text/plain");

            $('#processing-modal').modal('toggle'); //before post


            // Post data 
            setTimeout(function() {
                var element = document.getElementById(elementId);
                children.prepend(element);
                $('#processing-modal').modal('toggle'); // after post
            }, 1000);

        }

        event.preventDefault();
    });
}
/**   
@name initializeMap
@return map
*/
    
function initializeMap(){
    map = new google.maps.Map(document.getElementById('mapIn'), 
        { zoom: 17, 
            center: new google.maps.LatLng(32.409675, 74.135081)
        }),        
        shapes = [],
        selected_shape  = null,
        drawingManager = new google.maps.drawing.DrawingManager({map:map}),
        byId = function(elementIdAttribute){return document.getElementById(elementIdAttribute)},
        clearSelection  = function(){
                            if(selected_shape){
                              selected_shape.set((selected_shape.type === google.maps.drawing.OverlayType.MARKER
                                                 )?'draggable':'editable',false);
                              selected_shape = null;
                            }
                          },
        setSelection = function(shape){
                            clearSelection();
                            selected_shape=shape;
      selected_shape.set((selected_shape.type === google.maps.drawing.OverlayType.MARKER)?'draggable':'editable',true);
                          },
        clearShapes = function(){
                            for(var i=0;i<shapes.length;++i){
                              shapes[i].setMap(null);
                            }
                            shapes=[];
                          };    

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
    var shape  = e.overlay;
        shape.type = e.type;
        google.maps.event.addListener(shape, 'click', function() {
          setSelection(this);
        });
        setSelection(shape);
        shapes.push(shape);
    });

    google.maps.event.addListener(map, 'click',clearSelection);
    google.maps.event.addDomListener(byId('clear_shapes'), 'click', clearShapes);
  
    google.maps.event.addDomListener(byId('save_raw_map'), 'click', function(e){

    var data=MapFactory.InputMap(shapes,false);
    byId('MapData').value=JSON.stringify(data);
    var mapData = byId('MapData').value;
        
    var preventRunDefault = false;    
          
    });
    google.maps.event.addDomListener(byId('restore'), 'click', function(){
      if(this.shapes){
        for(var i=0;i<this.shapes.length;++i){
              this.shapes[i].setMap(null);
        }
      }
      this.shapes=MapFactory.OutputMap(JSON.parse(byId('MapData').value),map);
    });    
}

var MapFactory = {
  //returns array with storable google.maps.Overlay-definitions
  InputMap:function(arr,//array with google.maps.Overlays
              encoded//boolean indicating whether pathes should be stored encoded
              ){
      var shapes = [], shape, tmp;
      
      for(var i = 0; i < arr.length; i++)
      {   
        shape=arr[i];
        tmp={
          type:this.getShape(shape.type),
          id:shape.id||null
        };        
        
        switch(tmp.type){
           case 'CIRCLE':
              tmp.radius=shape.getRadius();
              tmp.geometry=this.getSeprateLatLng(shape.getCenter());
            break;
           case 'MARKER': 
              tmp.geometry=this.getSeprateLatLng(shape.getPosition());   
            break;  
           case 'RECTANGLE': 
              tmp.geometry=this.getSeprateLatLngBound(shape.getBounds()); 
             break;   
           case 'POLYLINE': 
              tmp.geometry=this.createPolylineParametersFromPathsIfEncoded(shape.getPath(),encoded);
             break;   
           case 'POLYGON': 
              tmp.geometry=this.createPolygonParametersFromPathsIfEncoded(shape.getPaths(),encoded);
              
             break;   
       }
       shapes.push(tmp);
    }

    return shapes;
  },
  //returns array with google.maps.Overlays
  OutputMap:function(arr,//array containg the stored shape-definitions
               map//map where to draw the shapes
               ){
    var shapes  = [], map=map||null, shape,tmp;
      
    for(var i = 0; i < arr.length; i++)
    {   
        shape=arr[i];       
        
        switch(shape.type){
           case 'CIRCLE':
              tmp=new google.maps.Circle({radius:Number(shape.radius),center:this.LatLngObj.apply(this,shape.geometry)});
            break;
           case 'MARKER': 
              tmp=new google.maps.Marker({
                position:this.LatLngObj.apply(this,shape.geometry)
              });
            break;  
           case 'RECTANGLE': 
              tmp=new google.maps.Rectangle({bounds:this.LatLngBoundsObj.apply(this,shape.geometry)});
             break;   
           case 'POLYLINE': 
              tmp=new google.maps.Polyline({path:this.createPolylineParametersFromPaths(shape.geometry)});
             break;   
           case 'POLYGON': 
              tmp=new google.maps.Polygon({paths:this.createPolygonParametersFromPaths(shape.geometry)});              
             break;   
       }
       tmp.setValues({map:map,id:shape.id})
       shapes.push(tmp);
    }
    return shapes;
  },
  createPolylineParametersFromPathsIfEncoded:function(path,e){
    path=(path.getArray)?path.getArray():path;
    if(e){
      return google.maps.geometry.encoding.encodePath(path);
    }else{
      var parameters=[];
      for(var i=0;i<path.length;++i){
        parameters.push(this.getSeprateLatLng(path[i]));
      }
      return parameters;
    }
  },
  createPolylineParametersFromPaths:function(path){
    if(typeof path==='string'){
      return google.maps.geometry.encoding.decodePath(path);
    }
    else{
      var parameters=[];
      for(var i=0;i<path.length;++i){
        parameters.push(this.LatLngObj.apply(this,path[i]));
      }
      return parameters;
    }
  },

  createPolygonParametersFromPathsIfEncoded:function(paths,e){
    var parameters=[];
    paths=(paths.getArray)?paths.getArray():paths;
    for(var i=0;i<paths.length;++i){
        parameters.push(this.createPolylineParametersFromPathsIfEncoded(paths[i],e));
      }
     return parameters;
  },
  createPolygonParametersFromPaths:function(paths){
    var parameters=[];
    for(var i=0;i<paths.length;++i){
        parameters.push(this.createPolylineParametersFromPaths.call(this,paths[i]));
        
      }
     return parameters;
  },
  getSeprateLatLng:function(latLng){
    return([latLng.lat(),latLng.lng()]);
  },
  LatLngObj:function(lat,lng){
    return new google.maps.LatLng(lat,lng);
  },
  getSeprateLatLngBound:function(bounds){
    return([this.getSeprateLatLng(bounds.getSouthWest()), this.getSeprateLatLng(bounds.getNorthEast())]);
  },
  LatLngBoundsObj:function(southWest,northEast){
    return new google.maps.LatLngBounds(this.LatLngObj.apply(this,southWest), this.LatLngObj.apply(this,northEast));
  },
  getShape:function(s){
    var allShapes=['CIRCLE','MARKER','RECTANGLE','POLYLINE','POLYGON'];
    for(var i=0;i<allShapes.length;++i){
       if(s===google.maps.drawing.OverlayType[allShapes[i]]){
         return allShapes[i];
       }
    }
  }
  
}

let placeSearch;
      let autocomplete;
      const componentForm = {
       // street_number: "short_name",
       // route: "long_name",
        locality: "long_name",
        administrative_area_level_1: "short_name",
       // country: "long_name",
      //  postal_code: "short_name",
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
          document.getElementById("autocomplete"),
          { types: ["geocode"] }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();

        for (const component in componentForm) {
          document.getElementById(component).value = "";
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
          const addressType = component.types[0];

          if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }