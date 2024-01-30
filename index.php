<?php
function compareFiles($file1, $file2) {
    $lines1 = file($file1);
    $lines2 = file($file2);

    $result = [];

    $maxLines = max(count($lines1), count($lines2));

    for ($i = 0; $i < $maxLines; $i++) {
        $line1 = $lines1[$i] ?? '';
        $line2 = $lines2[$i] ?? '';

        if ($line1 === $line2) {
            $result[] = $i + 1 . "\t\t" . " | \t" . $line1;
        } elseif ($line1 !== '' && $line2 !== '') {
            $result[] = $i + 1 . "\t*\t" . $line1 . " | " . $line2;
        } elseif ($line1 !== '') {
            $result[] = $i + 1 . "\t-\t" . $line1;
        } elseif ($line2 !== '') {
            $result[] = $i + 1 . "\t+\t" . $line2;
        }
    }

    return $result;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Compare</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="antialiased">
<div class="min-h-screen flex flex-col justify-center items-center max-w-7xl mx-auto">
    <form action="" method="post"
          class="w-full grid grid-cols-2 justify-center gap-4 border rounded-xl shadow-lg bg-gray-200 px-24 py-12">
        <div>
            <label for="file1">File 1:</label>
            <input type="file" name="file1" id="file1" required>
            <br>
        </div>
        <div>
            <label for="file2">File 2:</label>
            <input type="file" name="file2" id="file2" required>
            <br>
        </div>git commit -m "first commit"

        <div class="col-span-2 w-full flex justify-center mt-8">
            <button class="bg-black text-white rounded-xl border-2 px-8 py-3 mx-auto hover:border-white hover:font-bold duration-200"
                    type="submit">Submit
            </button>
        </div>
    </form>
    <div class="w-full mt-6 border rounded-xl shadow-lg bg-gray-200 px-24 py-12">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $file1 = $_POST['file1'];
            $file2 = $_POST['file2'];

            $result = compareFiles($file1, $file2);

            echo '<h2>Result:</h2>';

            foreach ($result as $line) {
                echo '<li>' . $line . '</li>';
            }
        }
        ?>
    </div>
</div>
</body>
</html>
