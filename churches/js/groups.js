//Groups design
//Sorting and searching
$(function() {
    altair_contact_list.init()
}),
altair_contact_list = {
    init: function() {
        var t = $("#contact_list")
          , i = [];
        t.children().each(function() {
            var t = $(this).attr("data-uk-filter").split(",")
              , n = t.length;
            for ($i = 0; $i < n; $i++)
                -1 == $.inArray(t[$i], i) && i.push(t[$i])
        });
        var n = i.length
          , r = UIkit.grid(t, {
            controls: "#contact_list_filter",
            gutter: 20
        });
        $("#contact_list_search").keyup(function() {
            var t = $(this).val().toLowerCase();
            if (t.length > 2) {
                var a = "";
                for ($i = 0; $i < n; $i++)
                    -1 !== i[$i].indexOf(t) && (a += (a.length > 1 ? "," : "") + i[$i]);
                a ? r.filter(a) : r.filter("all")
            } else
                t.length > 0 && r.filter()
        }),
        r.on("afterupdate.uk.grid", function(t, i) {
            i.length > 0 ? $(".grid_no_results").fadeOut() : $(".grid_no_results").fadeIn()
        })
    }
};


//Map
var google;
function initMap() {
    var kigali = {lat:-1.991019, lng:30.096819};
    var map = new google.maps.Map(document.getElementById('group_map'), {
      zoom: 10,
      center: kigali
    });
    var marker = new google.maps.Marker({
      position: kigali,
      map: map
    });

    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('loctest1'));
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        alert(0)
        var place = autocomplete.getPlace();
        placename = place.name;
        lat = place.geometry.location.lat();
        lng = place.geometry.location.lng();
        log(placename)
    });

    //Allowing the load of group maps
    load_group_maps();
};

function load_group_maps(){
    var load_maps = $(".group_map");

    log($(".group_map").attr('data-group-id'))

    // Getting group id, and data
    for(var n=0; n<load_maps.length; n++){
        map_elem = load_maps[n];
        map_loc = $(map_elem).attr('data-location');
        mloc = map_loc.split(',')
        group_location = {lat:parseFloat(mloc[0]), lng:parseFloat(mloc[1])};
        log(group_location)
        
        var map = new google.maps.Map((map_elem), {
            zoom: 17,
            // center: {map_loc}
            center: group_location
        });
        var marker = new google.maps.Marker({
          position: group_location,
          map: map
        });
    }
}; 

//When the group's going to be created
$("#launch_group_create").on('click', function(){
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('loctestF'));
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        alert(0)
        var place = autocomplete.getPlace();
        placename = place.name;
        lat = place.geometry.location.lat();
        lng = place.geometry.location.lng();
        log(placename)
    });
});


$(".grp_remove").on('click', function(){
    //When the remove button is clicked, for group removal
    groupId = $(this).attr('data-grp');

    //Asking for confirmation
    alert("TODO: Ask for confirmation")
});

//Adding person to group
$("#grp_add_member").on('click', function(){
    //Showing the add member modal
    var modal = UIkit.modal("#group_add_member");
    modal.show();
});

//Checkall enables the checking of all other members
$(".checkall").on('change', function(){
    //getting all members to be checked
    // checkbox_elem
    elems = $(this).parents("table").find(".checkbox_elem");

    log($(this).prop('checked'))

    $(elems).prop('checked', $(this).prop('checked'));
    
});

//Checking when members are checked to be added
$("#group_add_member input[type=checkbox]").on('change', function(){
    //Checking the number of checked people
    num = $("#group_add_member input[type=checkbox]:checked").length;

    $("#add_member_num").html("("+num+")");
});

//Group addition
$("#members_add_submit").on('click', function(){
    //handling group addition
    add = $("#group_add_member input[type=checkbox]:checked");

    num = add.length;
    users = [];
    for(n=0; n<add.length; n++){
        ///Looping through checked members to submit
        elem = add[n];
        user = $(elem).attr('data-member');
        if(user){
            users.push(user)
        };
    }

    //Getting group ID
    group_id = $(".group_map").attr('data-group-id');

    $.post('api/index.php', {action:'addmembers', members:users, group:group_id, function(data){
        //here going to check who was added or not
        try{
            ret = JSON.parse(data);
            log(data);
        }
    }})
});
//Removing peope on click from group
$(".removemember").on('click', function(){
    // elem = $(this).parents('tr').remove();

    
    delete_confirm = confirm("Are you sure you want to remove user(s) from group");
    if(delete_confirm){
        //finding userid
        mem_id = $(this).parents('tr').attr('data-member');

        //Getting group ID
        group_id = $(".group_map").attr('data-group-id');

        //issuing delete request
        $.post('api/index.php', {action:'remove_users', members:mem_id, group:group_id})
    }
})


$("#group_add_submit").on('click', function(e){
    e.preventDefault();
    //when the group is to be created

    //getting values
    grouptype = $("#group_type_select").val();
    groupname = $("#group_name").val();
    grouplocation = $("#group_location").val();
    rep = $("#group_rep").val();
    file = _("input-fgroup-pic").files[0];

    if(grouptype && groupname && grouplocation && rep){
        fields = {action:'create_group', name:groupname, type:grouptype, location:grouplocation, profile_picture:file, rep:rep, church:<?php echo $churchID; ?>};

        var file = _("input-fgroup-pic").files[0];
        var formdata = new FormData();

        for (var prop in fields) {
            formdata.append(prop, fields[prop]);
        }
        formdata.append("action", 'create_group');
        var ajax = new XMLHttpRequest();
        // ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", function(status, data){
            response = this.responseText;
            try{
                data = JSON.parse(response);
                if(data.status){
                    $(".group_create_status").html("<p class='uk-text-success'><i class='material-icons'>done</i>Group created successfully</p>");

                    //Closing current modal
                    cmodal = UIkit.modal("#modal_default");
                    cmodal.hide();

                    //Opening the success modal
                    var nmodal = UIkit.modal("#group_created_modal");
                    nmodal.show();
                }else{
                    $(".group_create_status").html("<p class='uk-text-danger'>Group cant be successfully<br />"+data.msg+"</p>");
                }
            }catch(err){
                log(err);

            }
        }, false);
        // ajax.addEventListener("error", errorHandler, false);
        // ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "api/index.php");
        ajax.send(formdata);

        console.log("Submitted")
    }else{
        //He should filin everythin
        alert("Please fill in all the details to create group");
        return 0;
    }
});
$("#input-fgroup-pic").dropify();

//Beautifying the representative pick-up
$(function() {
    $('#group_rep').selectize();
});