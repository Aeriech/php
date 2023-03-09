<?php

// Define the diary file path
$diary_file = "diary.txt";

// Check if the diary file exists, if not, create it
if (!file_exists($diary_file)) {
    $handle = fopen($diary_file, "w");
    fclose($handle);
}

// Check if the form has been submitted
if (isset($_POST["submit"])) {

    // Get the input values
    $date = $_POST["date"];
    $entry = $_POST["entry"];

    // Load the existing diary entries
    $entries = [];
    $file_lines = file($diary_file, FILE_IGNORE_NEW_LINES);
    foreach ($file_lines as $line) {
        $entry_date = substr($line, 0, 10);
        $entry_text = substr($line, 11);
        $entries[$entry_date] = $entry_text;
    }

    // Add the new entry to the existing entries
    $entries[$date] = $entry;

    // Write the entries to the diary file
    $handle = fopen($diary_file, "w");
    foreach ($entries as $entry_date => $entry_text) {
        fwrite($handle, $entry_date . " " . $entry_text . PHP_EOL);
    }
    fclose($handle);

    // Redirect to the same page to avoid resubmitting the form on refresh
    header("Location: ".$_SERVER['PHP_SELF']);
}

// Check if the delete form has been submitted
if (isset($_POST["delete"])) {

    // Get the input value
    $date = $_POST["date"];

    // Load the existing diary entries
    $entries = [];
    $file_lines = file($diary_file, FILE_IGNORE_NEW_LINES);
    foreach ($file_lines as $line) {
        $entry_date = substr($line, 0, 10);
        $entry_text = substr($line, 11);
        $entries[$entry_date] = $entry_text;
    }

    // Remove the entry for the specified date
    unset($entries[$date]);

    // Write the entries to the diary file
    $handle = fopen($diary_file, "w");
    foreach ($entries as $entry_date => $entry_text) {
        fwrite($handle, $entry_date . " " . $entry_text . PHP_EOL);
    }
    fclose($handle);

    // Redirect to the same page to avoid resubmitting the form on refresh
    header("Location: ".$_SERVER['PHP_SELF']);
}

?>

<!-- HTML form to add an entry -->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
    <br>
    <label for="entry">Entry:</label>
    <textarea id="entry" name="entry" required></textarea>
    <br>
    <input type="submit" name="submit" value="Add Entry">
</form>

<!-- HTML form to delete an entry -->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="delete-date">Delete Entry for Date:</label>
    <input type="date" id="delete-date" name="date" required>
    <br>
    <input type="submit" name="delete" value="Delete Entry">
</form>

<?php

// Load the existing diary entries
