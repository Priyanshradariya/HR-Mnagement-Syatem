<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Date Picker</title>
    <style>
        .date-picker {
            padding: 10px;
            margin: 20px;
            font-size: 16px;
        }
        .selected-dates {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h2>Select Multiple Dates</h2>
    
    <input type="date" id="datePicker" class="date-picker" multiple>

    <div class="selected-dates">
        <h3>Selected Dates:</h3>
        <ul id="dateList"></ul>
    </div>

    <script>
        // Function to add selected dates to the list
        document.getElementById("datePicker").addEventListener("change", function() {
            var selectedDates = document.getElementById("datePicker").value;
            var dateList = document.getElementById("dateList");

            // Clear the previous list
            dateList.innerHTML = '';

            // If multiple dates are selected, they will be separated by a comma
            if (selectedDates) {
                var dates = selectedDates.split(',');
                dates.forEach(function(date) {
                    var listItem = document.createElement("li");
                    listItem.textContent = date;
                    dateList.appendChild(listItem);
                });
            }
        });
    </script>
    
</body>
</html>
