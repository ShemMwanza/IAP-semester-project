document.getElementById("logo").onclick = function () {
      location.href = "/";
    };
    

  function checkProfile(userId) {
    console.log(userId);
    location.href="viewArtist/"+userId;
  }

  $(document).ready(function(){
		$("#search_text").keyup(function(event){
      console.log("called");
		var search = $(this).val();
    console.log(search);
    $.get("searchArtist", { search: search }, function (data) {
                 $("#search_results").html(data);
                 if(data.length != 0){
                     $("#search_results").html(data);
                 }else{
                    $("#search_results").html("No Results Found");
                 }
                 
            });
    
	});
});


  