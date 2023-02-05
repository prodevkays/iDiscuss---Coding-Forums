<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #maincontainer{
            min-height: 87vh;
        }
    </style>
    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include 'partial/_header.php'  ?>
    <?php include 'partial/_dbconnect.php' ?>
    
    <!-- Search Result -->
    <div class="container my-3" id="maincontainer">
        <h1 class="py-2">Search results for " <?php echo $_GET['search'];?>"</h1>
        <?php
            $noresults = true;
            $quary = $_GET["search"];
            $sql = "SELECT * FROM `threads` WHERE MATCH(thread_title, thread_desc) against('$quary')";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadid=" . $thread_id ;
                $noresults = false;
                //display the search result
                echo '<div class="results">
                        <h3><a href=" '. $url .'" class="text-dark"> '. $title .'</a></h3>
                        <p>'. $desc .'</p>
                    </div>';
            }
            if($noresults){
                echo '
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <p class="display-4">No Results Found</p>
                            <p class="lead"> 
                                did not match any documents.

                                Suggestions:
                                <ul>
                                    <ul>Make sure that all words are spelled correctly.</ul>
                                    <ul>Try different keywords.</ul>
                                    <ul>Try more general keywords.</ul>
                                    <ul>Try fewer keywords.</ul>
                                </ul>
                            </p>
                        </div>
                    </div>';
            }
        ?>

       
    </div>

    <?php include 'partial/_footer.php'  ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>