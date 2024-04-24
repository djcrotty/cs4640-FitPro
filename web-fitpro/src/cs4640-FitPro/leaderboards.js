$(document).ready(function() {
  $('#workout-dropdown').change(function() {
      updateLeaderboard();
  });
});

function updateLeaderboard() {
  var exerciseId = $('#workout-dropdown').val();
  $.ajax({
      url: '?command=leaderboards-json', 
      type: 'GET',
      data: {exercise_id: exerciseId}, 
      dataType: 'json',
      success: function(data) {
          var tbody = $('#leaderboard-table tbody');
          tbody.empty(); 

          $.each(data, function(index, item) {
              tbody.append('<tr><td>' + item.username + '</td><td>' + item.weight + '</td></tr>');
          });
      },
      error: function(jqXHR, textStatus, errorThrown) {
          console.log("Error fetching data: " + textStatus + ", " + errorThrown);
          tbody.append('<tr><td colspan="2">Error loading data.</td></tr>');
      }
  });
}
