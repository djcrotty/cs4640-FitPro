$(document).ready(function() {
  function loadLeaderboards() {
      $.ajax({
          url: 'leaderboards.php?json=true',  
          type: 'GET',
          dataType: 'json',
          success: function(data) {
              if (data) {
                  Object.keys(data).forEach(function(workout) {
                      updateLeaderboard(workout.toLowerCase(), data[workout]);
                  });
              }
          },
          error: function() {
              console.error('Failed to fetch leaderboard data');
          }
      });
  }

  function updateLeaderboard(workout, leaders) {
      const tableBody = $(`#${workout}-leaderboard tbody`);
      tableBody.empty(); 

      leaders.forEach(function(leader) {
          const row = `<tr><td>${leader.name}</td><td>${leader.weight} lbs</td></tr>`;
          tableBody.append(row);
      });
  }

  loadLeaderboards();
});
