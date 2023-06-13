function filterdata() {
    var users = $("#users").val();
    var meal_type = $("#meal_type").val();
    
    var category = $("#category").val();

    var date = $("#date").val();
    if(date == '') {
        date = "all";
    }

    window.location.href = base_url + "access_details/" + users + "/" + meal_type + "/" + category + "/" + date;
}