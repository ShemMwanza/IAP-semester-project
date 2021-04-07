document.getElementById("logo").onclick = function () {
      location.href = "index.html";
    };
    
document.getElementById("button_search").onclick=function() {
    let search= document.querySelector("input[name = 'search']").value;
    if (search!="") {
      location.href="findArtist.php?search="+search;
    }else{
      location.href="findArtist.php?search=all";
    }
  }
  function checkProfile(userId) {
    window.location.href="artistProfile.php?profile_id="+userId;
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


  