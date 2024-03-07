    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title>Meine ersten Schritte hier mit dem süßen kleinen Elefanten</title>

        <style>
            .footer{
                padding:100px;
                text-algin: center;
                background-color:black;
                color:white;
                margin-top: 300px;
            }

            body{
                font-family: "Inter", sans-serif;
                margin:0;
                background-color:#EAEDF8;
            }

            .unnötig{
                display:flex;
            }

            .menu{
                width:20%;
                background-color: blue;
                margin-right:2rem;
                padding-top:150px;
                height:100vh;
            }
            .menu a{
                display:block;
                text-decoration: none;
                color:white;
                padding: 8px;
            }

            .menu a:hover{
                background-color: red;

            }

            .content{
                width:80%;
            }

            .baby-change .oral

            .card{
                background-color: rgba(0,0,0,0.05);
                margin-bottom: 16px;
                border-radius: 8px;
                padding: 8px 64px;
                display:flex;

            }
            .profil-bild{
                width: 48px;
                height:48px;
                border-radius:50%;
                border:2px solid white;
                  display:flex;
                justify-content:center;
                align-items:center;
            }
            .phone-btn{
                background-color: forestgreen;
                border-radius: 4px;
                text-decoration: none;
                padding:4px;
                color: white;
            }
            .phone-btn a{
                text-decoration: none;
            }
            .phone-btn:hover{
                background-color: #CCCC00;
            }
            .delete-btn{
                background-color: rgb(255,000,000);
                border-radius: 4px;
                padding:4px;
                color:white;
            }
        </style>
    </head>
    <body>
        <div class="unnötig">
            <div class="menu">
                <a href="index.php?page=start"><span class="material-symbols-outlined baby-change">
    baby_changing_station
    </span>Start</a>
                <a href="index.php?page=kontakt"><span class="material-symbols-outlined oral">
    oral_disease
    </span>Kontakt</a> 
                <a href="index.php?page=kontakthinzufügen"><span class="material-symbols-outlined oral">
    oral_disease
    </span>Kontakt Hinzufügen</a> 
                <a href="index.php?page=Impressum"><span class="material-symbols-outlined toy">
    toys_fan
    </span>Impressum</a> 
                <a href="index.php?page=datenschutz"> <span class="material-symbols-outlined breast">
    breastfeeding
    </span>Datenschutz</a>
                <a href="index.php?page=about"><span class="material-symbols-outlined child">
    child_care
    </span>About</a> 
            </div>
            <div class="content">
            <?php
                $headline = 'herzlichwillkommen';
                $contacts = [];
                $nameRegex = '/^[a-zA-ZäöüÄÖÜß\s-]+$/u';

                if(file_exists('contacts.txt')){
                    $text = file_get_contents('contacts.txt', true);
                    $contacts = json_decode($text, true);
                }

                if (isset($_POST['name']) &&  preg_match($nameRegex, $_POST['name'])){ 
                    echo 'kontakt <b>'.$_POST['name'].'</b> wurde Hinzugefügt';
                    $newContact = [    
                        'name' => $_POST['name'],
                        'phone' => $_POST['phone']
                    ];
                    array_push($contacts, $newContact);

                    file_put_contents('contacts.txt', json_encode($contacts, JSON_PRETTY_PRINT));
                } else{
                    echo 'sorry ich glaube die von dir Eingegeben Namen ist eine Zahl und kein buchstaben.';
                }

                if (isset($_GET['delete'])) {
                    $deleteIndex = $_GET['delete'];
                    if (isset($contacts[$deleteIndex])) {
                        unset($contacts[$deleteIndex]);
                        file_put_contents('contacts.txt', json_encode(array_values($contacts), JSON_PRETTY_PRINT));
                    }
                }

                if($_GET['page'] == 'kontakt'){
                    $headline = 'Deine Freunde und Familie';
                }

                foreach($contacts as $index => $row){
                    $name = $row['name'];
                    $phone = $row['phone'];
                    echo "
                    <div class ='card'>
                        <img class='profil-bild' src='https://placebeard.it/640x360'>
                        <b>$name</b> <br>
                        $phone

                        <a class='phone-btn' href='tel:$phone'>anrufen</a>

                        <a class='delete-btn' href='?page=kontakt&delete=$index'>Delete</a>
                    </div>";
                }

                    if ($_GET['page'] == 'kontakt'){
                        echo "<p>Auf dieser Seite hast du den Überblick über deine <b>Kontakte</b>.</p>";
                    } else if($_GET['page'] == 'kontakthinzufügen'){
                        echo "
                        <div>
                        Auf dieser Seite kannst du einen weiteren Kontakt hinzufügen
                        </div>

                        <form action='?page=kontakt' method='POST'> 
                            <input placeholder='namen eingeben bitte' name='name'>

                            <input placeholder='Telefonnummer eingeben bitte' name='phone'>

                            <div>
                            <button type='submit'>Abseden</button>
                            </div>
                        
                        </form>
                        
                        ";
                    } else if($_GET['page'] == 'Impressum'){
                        echo "<p>Du befindest dich auf der AGB-Seite.</p>";
                    } else if($_GET['page'] == 'datenschutz'){
                        echo "<p>Du befindest dich auf der Datenschutz-Seite.</p>";
                    }  else if($_GET['page'] == 'about'){
                        echo "<p>Du befindest dich auf der about-Seite.</p>";
                    } else{
                        echo 'Du bist auf der Startseite.';
                    }
                ?>

            </div>

        </div>

        

        <div class="footer">
            Developer Akademie
        </div>
    </body>
    </html>
