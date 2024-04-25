$(document).ready(function() {
  $('#workout-dropdown').change(function() {
      updateLeaderboard();
  });

  updateLeaderboard(); // Initial call to populate the table when the page loads
});

function updateLeaderboard() {
  var exercise = $('#workout-dropdown').val();
  var tbody = $('#leaderboard-table tbody');
  tbody.empty(); // Clear previous rows

  let entries = []; // Array to store generated entries

  for (let i = 0; i < 5; i++) { // Generate 5 random entries
      let username = `User${Math.floor(Math.random() * 100)}`; // Random username
      let weight = Math.floor(Math.random() * 300) + 100; // Random weight between 100 and 400
      entries.push({ username, weight });
  }

  // Sort entries by weight in descending order
  entries.sort((a, b) => b.weight - a.weight);

  // Append sorted entries to the table
  entries.forEach(item => {
      tbody.append(`<tr><td>${item.username}</td><td>${item.weight}</td></tr>`);
  });
}
