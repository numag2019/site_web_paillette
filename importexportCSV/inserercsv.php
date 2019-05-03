
<html>
<body>


<?php
 $link=mysqli_connect('localhost','root','','crabase');


$query ="LOAD DATA LOCAL INFILE 'csv/fichier.csv'
INTO TABLE test
    FIELDS
        TERMINATED BY ';'
        ENCLOSED BY '\"'
        ESCAPED BY '\"'
    LINES
        STARTING BY '/'
        TERMINATED BY '/'";

    if ($obs=mysqli_query($link,$query)) {
        echo "executed";
    } else {
        echo mysqli_error($link);
    }

?>
	
</body>

</html>

