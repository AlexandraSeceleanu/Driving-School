<?php
    include('config.php') ;
    session_start();

    // 1
    $student1 = 0;
    $int1= mysqli_query($conn,"SELECT i.lastname, i.firstname, COUNT(s.studentID) as Nr_Stud
                                    FROM instructor i INNER JOIN student s
                                    ON i.instructorID = s.instructorID
                                    GROUP BY i.lastname, i.firstname
                                    HAVING COUNT(s.studentID) <= $student1");

    if(isset($_POST['show_int1'])){
        
        $student1 = mysqli_real_escape_string($conn, $_POST['student1']);
        $int1= mysqli_query($conn,"SELECT i.lastname, i.firstname, COUNT(s.studentID) as Nr_Stud
                                        FROM instructor i INNER JOIN student s
                                        ON i.instructorID = s.instructorID
                                        GROUP BY i.lastname, i.firstname
                                        HAVING COUNT(s.studentID) <= $sudent1t");
    }

    //2
    $student_lname = '';
    $student_fname = '';
    $int2= mysqli_query($conn,"SELECT s.lastname, s.firstname, SUM(l.km) AS Nr_km
                                    FROM student s INNER JOIN lesson l
                                    ON s.studentID = l.studentID
                                    WHERE s.lastname = '$student_lname' AND s.firstname = '$student_fname'");

    if(isset($_POST['show_int2'])){
        
        $student_lname = mysqli_real_escape_string($conn, $_POST['student_lname']);
        $student_fname = mysqli_real_escape_string($conn, $_POST['student_fname']);
        $int2= mysqli_query($conn,"SELECT s.lastname, s.firstname, SUM(l.km) AS Nr_km
                                    FROM student s INNER JOIN lesson l
                                    ON s.studentID = l.studentID
                                    WHERE s.lastname = '$student_lname' AND s.firstname = '$student_fname'");}

    //3
    $model = '';
    $int3= mysqli_query($conn,"SELECT i.lastname, i.firstname, c.model FROM instructor i 
                                JOIN allocation a ON a.instructorID = i.instructorID
                                JOIN car c ON a.carID = c.carID
                                WHERE c.model = '$model'");

    if(isset($_POST['show_int3'])){
        
        $model = mysqli_real_escape_string($conn, $_POST['model']);
        $int3= mysqli_query($conn,"SELECT i.lastname, i.firstname, c.model FROM instructor i 
                                JOIN allocation a ON a.instructorID = i.instructorID
                                JOIN car c ON a.carID = c.carID
                                WHERE c.model = '$model'");}

    //4
    $date1 = 0;
    $date2 = 0;
    $int4= mysqli_query($conn,"SELECT s.lastname, s.firstname, SUM(p.amount) AS Sum 
                                FROM student s 
                                LEFT JOIN payment p ON s.studentID = p.studentID
                                WHERE p.data BETWEEN '$date1' AND '$date2'
                                GROUP BY s.lastname, s.firstname
                                ORDER BY Sum DESC
                                LIMIT 1");

    if(isset($_POST['show_int4'])){
        
        $date1 = mysqli_real_escape_string($conn, $_POST['date1']);
        $date2 = mysqli_real_escape_string($conn, $_POST['date2']);
        $int4= mysqli_query($conn,"SELECT s.lastname, s.firstname, SUM(p.amount) AS Sum 
                                FROM student s 
                                LEFT JOIN payment p ON s.studentID = p.studentID
                                WHERE p.data BETWEEN '$date1' AND '$date2'
                                GROUP BY s.lastname, s.firstname
                                ORDER BY Sum DESC
                                LIMIT 1");}

    //5
    $suma = 0;
    $int5= mysqli_query($conn,"SELECT i.lastname AS ilastname, i.firstname AS ifirstname, s.lastname, s.firstname, p.amount FROM instructor i 
                                    INNER JOIN student s ON i.instructorID = s.instructorID
                                    INNER JOIN payment p ON p.studentID = s.studentID
                                     WHERE p.amount >= $suma");
    
    if(isset($_POST['show_int5'])){
        
        $suma = mysqli_real_escape_string($conn, $_POST['suma']);
        $int5= mysqli_query($conn,"SELECT i.lastname AS ilastname, i.firstname AS ifirstname, s.lastname, s.firstname, p.amount FROM instructor i 
                                    INNER JOIN student s ON i.instructorID = s.instructorID
                                    INNER JOIN payment p ON p.studentID = s.studentID
                                     WHERE p.amount >= $suma");}

    //6
    $int6= mysqli_query($conn,"SELECT s.lastname, s.firstname,  TIMEDIFF(l.stop_time, l.start_time) AS Timp
                                FROM student s 
                                INNER JOIN lesson l ON s.studentID = l.studentID
                                WHERE TIMEDIFF(l.stop_time, l.start_time) > '03:00:00'");
    
    //7
    $int7= mysqli_query($conn,"SELECT s.lastname, s.firstname, s.instructorID, s.birthday
                                FROM student s
                                WHERE (s.birthday) IN
                                        (SELECT max(s2.birthday) FROM student s2
                                        WHERE s2.instructorID = s.instructorID
                                        GROUP BY s.instructorID)
                                        ORDER BY s.birthday");

    //8
    $int8= mysqli_query($conn,"SELECT s.lastname, s.firstname
                                FROM student s
                                WHERE s.studentID NOT IN
                                        (SELECT p.studentID
                                        FROM payment p JOIN student s1 ON p.studentID = s1.studentID)");
    
    //9
    $int9= mysqli_query($conn,"SELECT s.lastname, s.firstname, (
		                        SELECT COUNT(*) FROM lesson l
		                        WHERE s.studentID = l.studentID) AS Nr_lectii 
		                        FROM student s;");

    //10
    $student_lname10 = '';
    $int10= mysqli_query($conn,"SELECT i.lastname, i.firstname
                                FROM instructor i
                                WHERE EXISTS(SELECT * FROM student s WHERE s.instructorID = i.instructorID AND s.lastname = '$student_lname10')");

    if(isset($_POST['show_int10'])){
        
        $student_lname10 = mysqli_real_escape_string($conn, $_POST['student_lname10']);
        $int10= mysqli_query($conn,"SELECT i.lastname, i.firstname
                                    FROM instructor i
                                    WHERE EXISTS(SELECT * FROM student s WHERE s.instructorID = i.instructorID AND s.lastname = '$student_lname10')");
    }
    
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Statistic</title>
</head>
<body>
  
    <div class="container mt-4">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Driving school statistic
                        <a href="admin_page.php" class="btn btn-danger float-end">Back</a>       
                    </div>
                    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
    <!-- 1 -->
                    <p> Instructorii care au mai mult de 
                        <input type="text" name="student1" class="form-control1"> studenti
                        <input type="submit" value="Show" name="show_int1" class="btn btn-info"></p>
                        <p>Instructorii care au mai mult de <b><?php echo $student1?></b> studenti sunt: </p>
                        
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Nume instructor</th>
                        <th>Prenume instructor</th>
                        <th>Nr studenti</th>
                    </tr>
        
                <?php
                    if (mysqli_num_rows($int1) > 0){
                        while ($row_int1 = mysqli_fetch_assoc($int1))
                        {   
                        echo "
                            <tr>
                            <td>".$row_int1['lastname']."</td>
                            <td>".$row_int1['firstname']."</td>
                            <td>".$row_int1['Nr_Stud']."</td>
                            </tr>
                            ";
                        }
                    } 
                ?>   
                    </table>
                    <br><hr size="4" width="100%" color="black"><br>
    <!-- 2 -->

                    <p>  Numarul total de km pentru studentul cu numele
                        <input type="text" name="student_lname" class="form-control1"> si prenumele
                        <input type="text" name="student_fname" class="form-control1">
                        <input type="submit" value="Show" name="show_int2" class="btn btn-info"></p>
                        <p>Numar total de km pentru studentul cu numele <b><?php echo $student_lname?></b> si prenumele <b><?php echo $student_fname?></b></p>
  
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Nume student</th>
                        <th>Prenume student</th>
                        <th>Nr total km</th>
                    </tr>
        
                <?php
                    if (mysqli_num_rows($int2) > 0){
                        while ($row_int2 = mysqli_fetch_assoc($int2))
                        {   
                        echo "
                            <tr>
                            <td>".$row_int2['lastname']."</td>
                            <td>".$row_int2['firstname']."</td>
                            <td>".$row_int2['Nr_km']."</td>
                            </tr>
                            ";
                        }
                    } 
                ?>   
                    </table>
                    <br><hr size="4" width="100%" color="black"><br>
<!-- 3 -->
                    <p> Instructorii care folosesc masina
                        <input type="text" name="model" class="form-control1">
                        <input type="submit" value="Show" name="show_int3" class="btn btn-info"></p>
                        <p>Instructorii care folosesc masina <b><?php echo $model?></b></p>
                        
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Nume instructor</th>
                        <th>Prenume instructor</th>
                        <th>Model masina</th>
                    </tr>
        
                <?php
                    if (mysqli_num_rows($int3) > 0){
                        while ($row_int3 = mysqli_fetch_assoc($int3))
                        {   
                        echo "
                            <tr>
                            <td>".$row_int3['lastname']."</td>
                            <td>".$row_int3['firstname']."</td>
                            <td>".$row_int3['model']."</td>
                            </tr>
                            ";
                        }
                    } 
                ?>   
                    </table>
                    <br><hr size="4" width="100%" color="black"><br>
<!-- 4 -->

                    <p>  Studentul care a platit cel mai mult de la data
                        <input type="date" name="date1" class="form-control1"> la data 
                        <input type="date" name="date2" class="form-control1">
                        <input type="submit" value="Show" name="show_int4" class="btn btn-info"></p>
                        <p>Studentul care a platit cel mai mult de la data <b><?php echo $date1?></b> la data <b><?php echo $date2?></b></p>
  
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Nume student</th>
                        <th>Prenume student</th>
                        <th>Suma</th>
                    </tr>
        
                <?php
                    if (mysqli_num_rows($int4) > 0){
                        while ($row_int4 = mysqli_fetch_assoc($int4))
                        {   
                        echo "
                            <tr>
                            <td>".$row_int4['lastname']."</td>
                            <td>".$row_int4['firstname']."</td>
                            <td>".$row_int4['Sum']."</td>
                            </tr>
                            ";
                        }
                    } 
                ?>   
                    </table>
                    <br><hr size="4" width="100%" color="black"><br>
    
    <!-- 5 -->
                    <p> Instructorii ai caror studenti au platit cel putin
                        <input type="text" name="suma" class="form-control1"> lei
                        <input type="submit" value="Show" name="show_int5" class="btn btn-info"></p>
                        <p>Instructorii ai caror studenti au platit cel putin <b><?php echo $suma?></b> lei</p>
                        
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Nume instructor</th>
                        <th>Prenume instructor</th>
                        <th>Nume student</th>
                        <th>Prenume student</th>
                        <th>Suma</th>
                    </tr>
        
                <?php
                    if (mysqli_num_rows($int5) > 0){
                        while ($row_int5 = mysqli_fetch_assoc($int5))
                        {   
                        echo "
                            <tr>
                            <td>".$row_int5['ilastname']."</td>
                            <td>".$row_int5['ifirstname']."</td>
                            <td>".$row_int5['lastname']."</td>
                            <td>".$row_int5['firstname']."</td>
                            <td>".$row_int5['amount']."</td>
                            </tr>
                            ";
                        }
                    } 
                ?>   
                    </table>
                    <br><hr size="4" width="100%" color="black"><br>
    
    <!-- 6 -->
                    <p> Studentii care au avut un timp de lectii mai mare de 3 ore
                        
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Nume student</th>
                        <th>Prenume student</th>
                        <th>Timp</th>
                    </tr>
        
                <?php
                    if (mysqli_num_rows($int6) > 0){
                        while ($row_int6 = mysqli_fetch_assoc($int6))
                        {   
                        echo "
                            <tr>
                            <td>".$row_int6['lastname']."</td>
                            <td>".$row_int6['firstname']."</td>
                            <td>".$row_int6['Timp']."</td>
                            </tr>
                            ";
                        }
                    } 
                ?>   
                    </table>
                    <br><hr size="4" width="100%" color="black"><br>
    
    <!-- 7 -->
    <p> Cei mai tineri studenti pentru fiecare instructor, ordonati dupa data nasterii
                        
                        <table class = "table table-bordered table-striped">
                        <tr>
                            <th>Nume student</th>
                            <th>Prenume student</th>
                            <th>Instructor ID</th>
                            <th>Data nasterii</th>
                        </tr>
            
                    <?php
                        if (mysqli_num_rows($int7) > 0){
                            while ($row_int7 = mysqli_fetch_assoc($int7))
                            {   
                            echo "
                                <tr>
                                <td>".$row_int7['lastname']."</td>
                                <td>".$row_int7['firstname']."</td>
                                <td>".$row_int7['instructorID']."</td>
                                <td>".$row_int7['birthday']."</td>
                                </tr>
                                ";
                            }
                        } 
                    ?>   
                        </table>
                        <br><hr size="4" width="100%" color="black"><br>
        
    <!-- 8 -->
    <p> Afisati toti studentii care nu au efectuat nicio plata.
                        
                        <table class = "table table-bordered table-striped">
                        <tr>
                            <th>Nume student</th>
                            <th>Prenume student</th>
                        </tr>
            
                    <?php
                        if (mysqli_num_rows($int8) > 0){
                            while ($row_int8 = mysqli_fetch_assoc($int8))
                            {   
                            echo "
                                <tr>
                                <td>".$row_int8['lastname']."</td>
                                <td>".$row_int8['firstname']."</td>
                                </tr>
                                ";
                            }
                        } 
                    ?>   
                        </table>
                        <br><hr size="4" width="100%" color="black"><br>

    <!-- 9 -->
    <p> Afisati numarul de lectii pe care le are fiecare student.
                        
                        <table class = "table table-bordered table-striped">
                        <tr>
                            <th>Nume student</th>
                            <th>Prenume student</th>
                            <th>Nr lectii</th>
                        </tr>
            
                    <?php
                        if (mysqli_num_rows($int9) > 0){
                            while ($row_int9 = mysqli_fetch_assoc($int9))
                            {   
                            echo "
                                <tr>
                                <td>".$row_int9['lastname']."</td>
                                <td>".$row_int9['firstname']."</td>
                                <td>".$row_int9['Nr_lectii']."</td>
                                </tr>
                                ";
                            }
                        } 
                    ?>   
                        </table>
                        <br><hr size="4" width="100%" color="black"><br>
    <!-- 10 -->

    <p> Afisati numele si prenumele instructorilor care au studenti cu numele 
                        <input type="text" name="student_lname10" class="form-control1">
                        <input type="submit" value="Show" name="show_int10" class="btn btn-info"></p>
                        <p>Numele si prenumele instructorilor care au studenti cu numele  <b><?php echo $student_lname10?></b></p>
  
                    <table class = "table table-bordered table-striped">
                    <tr>
                        <th>Nume instructor</th>
                        <th>Prenume instructor</th>
                    </tr>
        
                <?php
                    if (mysqli_num_rows($int10) > 0){
                        while ($row_int10 = mysqli_fetch_assoc($int10))
                        {   
                        echo "
                            <tr>
                            <td>".$row_int10['lastname']."</td>
                            <td>".$row_int10['firstname']."</td>
                            </tr>
                            ";
                        }
                    } 
                ?>   
                    </table>
                    
                </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>